<?php

namespace frontend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use common\models\ProductPhoto;
use common\models\ProductCategory;
use common\models\Sell;
use common\models\SellDet;
use common\models\SellInfo;
use common\models\City;
use common\models\User;
use common\models\Email;
use common\models\Province;
use yii\data\Pagination;
use yii\data\widgets\Select2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\QueryTrait;
use yii\filters\AccessControl;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['destination'],
                'rules' => [
                    [
                        'actions' => ['destination'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionAddcart() {
//        $value = array();
        $session = Yii::$app->session;
        $id = $_POST['id'];
        $isi = array();
        $isi = $session['cart'];
        if (isset($isi[$id])) {
            $isi[$id] +=1;
        } else {
            $isi[$id] = 1;
        }
        $session['cart'] = $isi;
        return 'sukses';
    }

    public function actionCart() {
        $this->layout = 'mainSingle';
        if (isset($_POST['update'])) {
            $session = Yii::$app->session;
            $cart = $session['cart'];
            foreach ($cart as $key => $value) {
                $cart[$key] = $_POST['qty'][$key];
            }
            $session['cart'] = $cart;
            return $this->render('cart');
        }

        return $this->render('cart');
    }

    public function actionDelcart() {
        $session = Yii::$app->session;
//        $value = array();
        $id = $_POST['id'];
        $value = $session['cart'];
        unset($value[$id]);
        $session['cart'] = $value;
        return 'dada';
    }

    public function actionGetcity() {
        $search = $_GET['search'];
        $city = array("1" => "Malang", "2" => "Surabaya");
//        $city = City::find()->where(['name LIKE :query'])->addParams([':query' => '%"' . $search . '"%'])->all();
        $sql = 'select province_id, id, name from acca_city where name like "%' . $search . '%"';
        $city = City::findBySql($sql)->all();
        $return = array();
        if (empty($city) or ! isset($city)) {
            $return[] = array('id' => 0, 'text' => 'No Data Found...');
        } else {
            foreach ($city as $key) {
                $return[] = array('id' => $key->id, 'text' => $key->name . ' - ' . $key->province->name);
            }
        }
        echo json_encode($return);
    }

    public function actionCity() {
//        $id = $_POST['id'];
        $city = City::find(['province_id' => $_POST['province_id']])->all();
        foreach ($city as $as) {
            $data = '<option value=="' . $as->id . '">' . $as->name . '</option>';
        }

        return $data;
    }

    public function actionDestination() {
        $this->layout = 'mainSingle';
        if (!empty($_POST['city_id'])) {
            $session = Yii::$app->session;
            $city = City::findOne($_POST['city_id']);


            $model = new Sell;

            $model->departement_id = 1;
            $model->customer_user_id = Yii::$app->user->identity->id;
            $model->subtotal = 0;
            $model->created = date('Y-m-d H:i:s');

//            $model->save();


            $value = $session['cart'];
            if (!empty($value)) {
                if ($model->save()) {

                    // save to SellDetail
                    $id = $model->id;
                    $subtotal = 0;
                    $ongkir = 0;
                    $ongkrm = 0;
                    $asuransi = 0;
                    $chekasuransi = '';
                    $is_asuransi = '';

                    foreach ($value as $product_id => $qty) {
                        $product = Product::findOne($product_id);
                        $modelDet = new SellDet();
                        $modelDet->sell_id = $model->id;
                        $modelDet->product_id = $product_id;
                        $modelDet->qty = $qty;
                        $modelDet->price = $product->price_sell;
                        $modelDet->save();
                        $subtotal = $subtotal + ($product->price_sell * $qty);


                        $ceil = ceil($product->weight); //pembulatan 0
                        if ($ceil == '0') {
                            $numb = '1';
                        } else {
                            $numb = $ceil;
                        }
                        $asuransi += 0.02 * $product->price_sell * $qty;
                        $ongkir = $ongkir + ($qty * $numb); // jumlah barang dikali pembulatan berat
                    }
                    $ongkrm = $ongkir * $city->charge;
                    if (isset($_POST['asuransi'])) {
                        $chekasuransi = $asuransi;
                        $is_asuransi = 1;
                    } else {
                        $chekasuransi = 0;
                        $is_asuransi = 0;
                    }
                    $modleTot = Sell::findOne($model->id);
                    $modleTot->subtotal = $subtotal;
                    $modleTot->code = 'SELL/' . date('d') . '/' . date('my') . '/000' . $model->id;
                    $modleTot->ongkir = $ongkrm;
                    $modleTot->other = $chekasuransi + 5000;
                    $modleTot->is_asuransi = $is_asuransi;

                    $modleTot->save();

                    //save to Sell Info

                    $modelInfo = new SellInfo();
                    $modelInfo->sell_id = $model->id;
                    $modelInfo->status = 'pending';
                    $modelInfo->address = $_POST['alamat'];
                    $modelInfo->phone = $_POST['phone'];
                    $modelInfo->postcode = $_POST['postcode'];
                    $modelInfo->name = $_POST['name'];
                    $modelInfo->city_id = $_POST['city_id'];
                    $modelInfo->save();

                    //send email

                    $sellDet = SellDet::find()->where(['sell_id' => $model->id])->all();
                    $sellInfo = SellInfo::find()->where(['sell_id' => $model->id])->one();
                    $sell = Sell::findOne($model->id);
                    $user = User::findOne(Yii::$app->user->identity->id);
                    $detailProduct = '<div style="width:650px">
                                    <div style="border:1px solid #ccc;margin:0 5px">
                                        <div style="background-color:#e1ecf9;color:#35689f;font-weight:bold;margin:2px">                        
                                            <div style="float:left;padding:7px 5px;text-align:left;width:310px">Product Name</div>
                                            <div style="float:left;padding:7px 5px;text-align:right;width:100px">Price</div>
                                            <div style="float:left;padding:7px 5px;text-align:center;width:80px">Qty</div>                                
                                            <div style="float:left;padding:7px 5px;text-align:right;width:100px">Total</div>
                                            <div style="clear:both"></div>
                                        </div>
                                        <div style="clear:both"></div>';

                    $total = 0;
                    foreach ($sellDet as $detail) {
                        $product = Product::findOne($detail->product_id);
                        $subTot = $detail->price * $detail->qty;
                        $detailProduct .=
                                '<div>                        
                                            <div style="float:left;padding:7px 5px;text-align:left;width:310px"><a href="' . $product->url . ' target="_blank">' . $product->name . '</a></div>
                                            <div style="float:left;padding:7px 5px;text-align:right;width:100px">' . Yii::$app->landa->rp($detail->price) . '</div>
                                            <div style="float:left;padding:7px 5px;text-align:center;width:80px">' . $detail->qty . '</div>                                
                                            <div style="float:right;padding:7px 5px;text-align:right;width:100px">' . Yii::$app->landa->rp($subTot) . '</div>
                                            <div style="clear:both"></div>
                                        </div>';
                        $total = $total + ($detail->price * $detail->qty);
                    }

                    $detailProduct .=
                            '<div style="border:1px solid #ccc;margin:0 5px"></div>
                                        <div style="float:left;padding:7px 5px;text-align:left;width:510px">Biaya Pengiriman *</div>                          
                                        <div style="float:left;padding:7px 5px;text-align:right;width:100px"> ' . Yii::$app->landa->rp($sell->ongkir) . '</div>
                                        <div style="clear:both"></div>
                                        <div style="float:left;padding:7px 5px;text-align:left;width:510px">Lain-lain **</div>                          
                                        <div style="float:left;padding:7px 5px;text-align:right;width:100px">' . Yii::$app->landa->rp($sell->other) . ' </div>
                                        <div style="clear:both"></div>

                                        <div style="border:1px solid #ccc;margin:0 5px"></div>
                                        <div style="float:left;padding:7px 5px;text-align:left;width:450px"><b>Grand Total</b></div>                          
                                        <div style="float:left;padding:7px 5px;text-align:right;width:160px"><b>' . Yii::$app->landa->rp($sell->other + $sell->ongkir + $total) . '</b></div>
                                        <div style="clear:both"></div>
                                        
                                        
                                        <div style="float:left;padding:7px 5px;text-align:left;width:610px;font-size:12px">
                                         <i style="font-size: 11px">* kita menggunakan type pengiriman REG dari JNE</i><br>
                        <i style="font-size: 11px">** lain lain meliputi biaya asuransi per item (optional) dan biaya administrasi sebesar Rp 5.000,-</i>
                                        </div>                          
                                        
                                        <div style="clear:both"></div>
                                    </div>
                                </div>';
                    $content = '<table border="0" cellpadding="0" cellspacing="0" style="font-size: 13px" width="650px">
                    <tbody>
                            <tr>
                                    <td style="text-align: center">
                                    <div style="background-color:#e1ecf9;margin: 3px;border:1px solid #bfd7ff;width: 642;padding: 10px 0;">
                                    <h2 style="margin: 0px">INDOMOBILECELL MALANG</h2>
                                    <em style="font-size:11px">Jl. Brigjend S.Riadi 10, kota malang, jawa timur. (0341) 355 333 - Mail : info@indomobilecell.com</em><br />
                                    <br />
                                    <b>INVOICE #' . $sell->code . '</b></div>

                                    <table style="font-size: 13px" width="650px">
                                            <tbody>
                                                    <tr valign="top">
                                                            <td width="50%">
                                                            <table cellpadding="4" style="font-size: 13px" width="100%">
                                                                    <tbody>
                                                                            <tr valign="top">
                                                                                    <td style="text-align: left;">Status</td>
                                                                                    <td style="text-align: left;">:</td>
                                                                                    <td style="text-align: left;">' . $sellInfo->status . '</td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                    <td style="text-align: left;">Name</td>
                                                                                    <td style="text-align: left;">:</td>
                                                                                    <td style="text-align: left;">' . $sellInfo->name . '</td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                    <td style="text-align: left;">Phone</td>
                                                                                    <td style="text-align: left;">:</td>
                                                                                    <td style="text-align: left;">' . $sellInfo->phone . '</td>
                                                                            </tr>
                                                                    </tbody>
                                                            </table>
                                                            </td>
                                                            <td width="50%">
                                                            <table cellpadding="4" style="font-size: 13px" width="100%">
                                                                    <tbody>
                                                                            <tr valign="top">
                                                                                    <td style="text-align: left;">Provinsi</td>
                                                                                    <td style="text-align: left;">:</td>
                                                                                    <td style="text-align: left;">' . $sellInfo->city->province->name . '</td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                    <td style="text-align: left;">Kota</td>
                                                                                    <td style="text-align: left;">:</td>
                                                                                    <td style="text-align: left;">' . $sellInfo->city->name . '</td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                    <td style="text-align: left;">Alamat</td>
                                                                                    <td style="text-align: left;">:</td>
                                                                                    <td style="text-align: left;">' . $sellInfo->address . '</td>
                                                                            </tr>
                                                                    </tbody>
                                                            </table>
                                                            </td>
                                                    </tr>
                                            </tbody>
                                    </table>
                                    <br />
                                    ' . $detailProduct . '
                                    <div style="padding:15px 5px 0px 5px;text-align: left">Kepada Yth. <b>Bapak/Ibu ' . $sellInfo->name . '</b>,<br />
                                    Terima kasih atas kepercayaan Anda berbelanja di INDO MOBILE CELL MALANG. Berikut kami kirimkan e-Invoice yang berlaku sebagai nota pembelian Anda.</div>

                                    <div style="padding:15px 5px 20px 5px;text-align: left">Nota Pembelian ini bukan sebagai bukti pembelian dan <b>hanya sah</b> apabila Anda telah melakukan pembayaran ke nomor rekening resmi kami yang tertera di bawah.</div>

                                    <div style="padding:0 5px 0px 5px;text-align: left">
                                    <div style="margin:10px 15px 0px 0px;padding:0px;border-top:1px solid #ddd;border-left:1px solid #ddd;width:630px">
                                    <div style="height:50px;  width:304px;border-right:1px solid #ddd;border-bottom:1px solid #ddd;float:left;padding:5px"><img alt="BCA" src="https://ci4.googleusercontent.com/proxy/eypCxgDHMhGuYx2-ZQr_kW1ZcQdMgH4BlVrW3eC20SnPccJieNsUxhcOjUk0lxUcdYUjzGuq-Nw6o4VRBbV9BeYVDdL-YioJr14NKkwxunJCMg=s0-d-e1-ft#http://www.jakartanotebook.com/images/front/cart-bank_01.png" style="float:left" /> <b>0113161202</b>&nbsp;a/n Jimmy Etmada<br />
                                    Cab. Kab. Malang</div>

                                    <div style="height:50px;width:304px;border-right:1px solid #ddd;border-bottom:1px solid #ddd;float:left;padding:5px"><br />
                                    &nbsp;</div>
                                    </div>
                                    </div>

                                    <div style="padding:15px 5px 0px 5px;text-align: left"><strong>JANGAN LUPA!&nbsp;</strong>Setelah melakukan pembayaran, jangan lupa <strong>KONFIRMASIKAN PEMBAYARAN</strong>&nbsp;anda kepada kami melalui link berikut atau bisa langsung mengakses melalui website resmi kami.<br />
                                    <a href="' . Yii::$app->urlManager->createUrl('konfirmasi-pembayaran/' . $sell->id) . '" target="_blank">Klik disini untuk mengkonfirmasi pembayaran</a></div>

                                    <div style="padding:15px 5px 20px 5px;text-align: left;float:right"><b>Dan berikut informasi jenis-jenis status transaksi pada toko kami :</b><br />
                                    <div class="alert"> 
                                    ~ <span style="font-weight: bold"> PENDING </span> : Transaksi telah direview. Silahkan lakukan pembayaran dan konfirmasi kepada kami.<br />
                                    ~ <span style="font-weight: bold"> CONFIRM </span> : Transaksi telah dibayarkan oleh user dan sendang dilakukan pengiriman<br />
                                    ~ <span style="font-weight: bold"> REJECT </span> : Transaksi dibatalkan oleh admin karena hal-hal tertentu. Seperti stok tidak mencukupi, dll.<br />
                                    
                                    &nbsp;</div>
                                    </div>
                                    </td>
                            </tr>
                    </tbody>
            </table>

            <div style="border-top:1px solid #ccc;margin:15px 2px 0px 2px;width: 650px; line-height:10px">&nbsp;</div>';
                    //action send  to konsumen
                    $email = $user->email;
                    $subjec = 'KONFIRMASI PEMBELIAN INDOMOBILECELL INVOICE #' . $sell->code;
//                    $content = 'Klik <a href="' . Yii::$app->urlManager->createUrl('reset-password/' . md5($user->id)) . '">disini</a> unruk melakukan reset password';
                    $to = $user->email;
                    $from = "info@indomobilecell.com";

                    $name = '=?UTF-8?B?' . base64_encode($email) . '?=';
                    $subject = '=?UTF-8?B?' . base64_encode($subjec) . '?=';
                    $headers = "From: Indomobilecell.com <{$from}>\r\n" .
                            "Reply-To: {$from}\r\n" .
                            "MIME-Version: 1.0\r\n" .
                            "Content-type: text/html; charset: utf8\r\n";

                    mail($to, $subject, $content, $headers);


                    //action send  to info@indomobilecell.com
                    $email = $user->email;
                    $subjec = 'KONFIRMASI PEMBELIAN INDOMOBILECELL INVOICE #' . $sell->code;
//                    $content = 'Klik <a href="' . Yii::$app->urlManager->createUrl('reset-password/' . md5($user->id)) . '">disini</a> unruk melakukan reset password';
                    $from = "info@indomobilecell.com";
                    $to = "info@indomobilecell.com";

                    $name = '=?UTF-8?B?' . base64_encode($email) . '?=';
                    $subject = '=?UTF-8?B?' . base64_encode($subjec) . '?=';
                    $headers = "From: $email <{$from}>\r\n" .
                            "Reply-To: {$from}\r\n" .
                            "MIME-Version: 1.0\r\n" .
                            "Content-type: text/html; charset: utf8\r\n";

                    mail($to, $subject, $content, $headers);

                    $mEmail = new Email;
                    $mEmail->email_from = 'indomobilecell@yahoo.co.id';
                    $mEmail->email_to = $user->email;
                    $mEmail->title = 'KONFIRMASI PEMBELIAN INDOMOBILECELL INVOICE #' . $model->code;
                    $mEmail->content = $content;
                    $mEmail->client = 'INDOMOBILECELL';
                    $mEmail->is_send = 1;
                    $mEmail->save();



                    unset($session['cart']);
                    return $this->redirect('detail-pesanan/' . $id . '.html');
                }
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Pastikan anda mengisi Kabupaten /  Kota untuk biaya ongkos kirim.');
            return $this->render('destination');
        }
        if (!\Yii::$app->user->isGuest) {
            return $this->render('destination');
        } else {
            return $this->redirect(Yii::$app->urlManager->createUrl('login'));
        }
    }

    public function actionInvoice($id) {
        $this->layout = 'mainSingle';
        if (!\Yii::$app->user->isGuest) {
            $ryRandom = rand(11111, 99999);
            $session = Yii::$app->session;

            $model = Sell::findOne($id);
            $modelDet = SellDet::find()->where(['sell_id' => $id])->all();
            $modelInfo = SellInfo::findOne(['sell_id' => $id]);

            return $this->render('invoice', [
                        'model' => $model,
                        'modelDet' => $modelDet,
                        'modelInfo' => $modelInfo
            ]);
        } else {
            return $this->redirect(Yii::$app->urlManager->createUrl('login'));
        }
    }

    public function actionListorder() {
        $this->layout = 'mainSingle';
        if (!\Yii::$app->user->isGuest) {
            $pesanan = Sell::find()->with(['info'])->where(['customer_user_id' => Yii::$app->user->identity->id])->orderBy('id desc');
            $pagination = new Pagination([
                'defaultPageSize' => 8,
                'totalCount' => $pesanan->count(),
            ]);
            $pesanan = $pesanan->offset($pagination->offset)->limit($pagination->limit)->all();
            return $this->render('order', ['pesanan' => $pesanan, 'pagination' => $pagination]);
        } else {
            return $this->redirect(Yii::$app->urlManager->createUrl('login'));
        }
        ;
    }

    public function actionView() {
        

        $this->layout = 'mainSingle';
        $model = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->where(['alias' => $_GET['alias']])->one();


        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            $modelProductPhoto = ProductPhoto::findAll(['product_id' => $model->id]);
            $this->addHits($model);
            return $this->render('view', [
                        'model' => $model,
                        'modelProductPhoto' => $modelProductPhoto
            ]);
        }
    }

    public function actionCategory() {
        $this->layout = 'mainSingle';
        $session = Yii::$app->session;
        if (isset($_GET['alias'])) {
            $sid = array();
            $alias = $_GET['alias'];
            $model = ProductCategory::findOne(['alias' => $alias]);
            $modelCat = ProductCategory::find()->with('product')->where(['root' => $model->root, 'level' => 2])->orderBy('name')->all();
            foreach ($modelCat as $a) {
                $sid[] = $a->id;
            }

            $modelProduct = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->where(['product_category_id' => $sid]);
            $featured = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->limit(5)->orderBy('RAND()')->all();
            if (isset($session['showing'])) {
                if ($session['showing'] == 'show18') {
                    $show = 18;
                } elseif ($session['showing'] == 'show24') {
                    $show = 24;
                } else {
                    $show = 32;
                }
            } else {
                $show = 18;
            }

            $pagination = new Pagination([
                'defaultPageSize' => $show,
                'totalCount' => $modelProduct->count(),
            ]);

//            cek sorting
            if (isset($session['sorting'])) {
                if ($session['sorting'] == 'nameAsc')
                    $modelProduct->orderBy('name');
                elseif ($session['sorting'] == 'nameDesc')
                    $modelProduct->orderBy('name DESC');
                elseif ($session['sorting'] == 'priceAsc')
                    $modelProduct->orderBy('price_sell ASC');
                elseif ($session['sorting'] == 'priceDesc')
                    $modelProduct->orderBy('price_sell DESC');
                elseif ($session['sorting'] == 'latest')
                    $modelProduct->orderBy('id DESC');
            }else {
                $modelProduct->orderBy('name');
            }

            $modelProduct = $modelProduct->offset($pagination->offset)->limit($pagination->limit)->all();
        }
        return $this->render('category', [
                    'modelProduct' => $modelProduct,
                    'featured' => $featured,
                    'modelCat' => $modelCat,
                    'pagination' => $pagination,
                    'model' => $model
        ]);
    }

    public function actionList($id) {
        $this->layout = 'mainSingle';
        $session = Yii::$app->session;
        $show = '';
        $model = ProductCategory::findOne(['id' => $id]);
        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            $modelProduct = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->where(['product_category_id' => $id]);
            $modelCat = ProductCategory::find()->with('product')->where(['root' => $model->root, 'level' => 2])->orderBy('name')->all();
            $featured = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->limit(5)->orderBy('RAND()')->all();

            //cek showing
            if (isset($session['showing'])) {
                if ($session['showing'] == 'show18') {
                    $show = 18;
                } elseif ($session['showing'] == 'show24') {
                    $show = 24;
                } else {
                    $show = 32;
                }
            } else {
                $show = 18;
            }

            $pagination = new Pagination([
                'defaultPageSize' => $show,
                'totalCount' => $modelProduct->count(),
            ]);

            //cek sorting
            if (isset($session['sorting'])) {
                if ($session['sorting'] == 'nameAsc')
                    $modelProduct->orderBy('name');
                elseif ($session['sorting'] == 'nameDesc')
                    $modelProduct->orderBy('name DESC');
                elseif ($session['sorting'] == 'priceAsc')
                    $modelProduct->orderBy('price_sell ASC');
                elseif ($session['sorting'] == 'priceDesc')
                    $modelProduct->orderBy('price_sell DESC');
                elseif ($session['sorting'] == 'latest')
                    $modelProduct->orderBy('id DESC');
            }else {
                $modelProduct->orderBy('name');
            }

            $modelProduct = $modelProduct->offset($pagination->offset)->limit($pagination->limit)->all();

            return $this->render('list', [
                        'modelProduct' => $modelProduct,
                        'featured' => $featured,
                        'modelCat' => $modelCat,
                        'pagination' => $pagination,
                        'id' => $id,
            ]);
        }
    }

    public function addHits($model) {
        $model->hits++;
        $model->save();
    }

    public function actionSearch() {
        $this->layout = 'mainSingle';
        $session = Yii::$app->session;
        $show = '';
        if (isset($_GET['cat_id'])) {
            $model = ProductCategory::findOne(['id' => $_GET['cat_id']]);
            $modelCat = ProductCategory::find()->with('product')->where(['root' => $model->root, 'level' => 2])->orderBy('name')->all();
        }
        $featured = Product::find()->with(['brand', 'productPhoto', 'productCategory'])->limit(5)->orderBy('RAND()')->all();
        $modelProduct = Product::find()->with(['brand', 'productPhoto', 'productCategory']);

        if (!empty($_GET['name'])) {
            $modelProduct->andFilterWhere(['like', 'name', $_GET['name']]);
        }
        if (!empty($_GET['brand'])) {
            $modelProduct->where(['product_category_id' => $_GET['brand']]);
        }
        if (!empty($_GET['price'])) {
            $price = explode(',', $_GET['price']);
            $min = $price[0];
            $max = $price[1];
//            $modelProduct->where(['price_sell' => '>='.$min]);
            $modelProduct->andFilterWhere(['>=', 'price_sell', $min]);
            $modelProduct->andFilterWhere(['<=', 'price_sell', $max]);
        }

        //cek showing
        if (isset($session['showing'])) {
            if ($session['showing'] == 'show18') {
                $show = 18;
            } elseif ($session['showing'] == 'show24') {
                $show = 24;
            } else {
                $show = 32;
            }
        } else {
            $show = 18;
        }

        $pagination = new Pagination([
            'defaultPageSize' => $show,
            'totalCount' => $modelProduct->count(),
        ]);

        //cek sorting
        if (isset($session['sorting'])) {
            if ($session['sorting'] == 'nameAsc')
                $modelProduct->orderBy('name');
            elseif ($session['sorting'] == 'nameDesc')
                $modelProduct->orderBy('name DESC');
            elseif ($session['sorting'] == 'priceAsc')
                $modelProduct->orderBy('price_sell ASC');
            elseif ($session['sorting'] == 'priceDesc')
                $modelProduct->orderBy('price_sell DESC');
            elseif ($session['sorting'] == 'latest')
                $modelProduct->orderBy('id DESC');
        }else {
            $modelProduct->orderBy('name');
        }

        $modelProduct = $modelProduct->offset($pagination->offset)->limit($pagination->limit)->all();

        if (isset($_GET['cat_id'])) {
            return $this->render('search', [
                        'modelProduct' => $modelProduct,
                        'featured' => $featured,
                        'modelCat' => $modelCat,
                        'pagination' => $pagination,
                        'cat_id' => $_GET['cat_id'],
            ]);
        } else {
            return $this->render('search', [
                        'modelProduct' => $modelProduct,
                        'featured' => $featured,
                        'pagination' => $pagination,
                        'cat_id' => '',
            ]);
        }
    }

    public function actionSorting() {
        $session = Yii::$app->session;
        $session['sorting'] = $_GET['sort'];
    }

    public function actionShowing() {
        $session = Yii::$app->session;
        $session['showing'] = $_GET['show'];
    }

    public function actionListsub() {
        if (!empty($_POST['text'])) {
            $model = City::find()->with(['province']);
            $model->andFilterWhere(['like', 'name', $_POST['text']])->all();
//            foreach ($model as $val) {
//                echo '<option value="' . $val->id . '">' . $val->name . ')</option>';
//            }
            echo print_r($model);
        }
    }

}
