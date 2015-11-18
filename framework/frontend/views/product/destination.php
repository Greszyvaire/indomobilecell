<?php
$session = Yii::$app->session;

use common\models\Product;
use common\models\Province;
use common\models\City;
use common\models\User;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

$this->title = 'Alamat tujuan pengiriman';

$province = Province::find()->all();
$city = City::find()->all();
$user = User::findOne(Yii::$app->user->identity->id);
?>

<?php $form = ActiveForm::begin(['id' => 'cart-form']); ?>

<section id="checkout-page">
    <div class="container">
        <div class="col-xs-12 no-margin">

            <div class="billing-address">
                <h2 class="border h1">Alamat Pengiriman</h2>
                <?php
                if(Yii::$app->session->getAllFlashes()){
                     foreach (Yii::$app->session->getAllFlashes() as $key => $message) {

                    echo'<div class="alert alert-' . $key . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  ' . $message . '
</div>';
                }
                }
               
                ?>
                <!--                <div class="row field-row">
                                    <div class="col-xs-12">
                                        <input onclick="showCheckout(1)" class="le-checkbox big" id="addressDestination1" type="radio" name="alamat_tujuan" checked value="1"> 
                                        Gunakan alamat yang sudah terdaftar.<br>
                                        <input onclick="showCheckout(0)" class="le-checkbox big" id="addressDestination0" type="radio" name="alamat_tujuan" value="0"> Ingin menambahkan alamat baru.
                
                                    </div>
                                </div> /.field-row -->

                <!--                <div class="current" style="display: block">
                
                                    <div class="row field-row">
                                        <div class="col-xs-12 col-sm-6">
                                            <label>Nama</label>
                                            <input class="le-input" type="text" name="nameAsli" value="" required readonly="true">
                                        </div>
                
                                    </div> /.field-row 
                                    <div class="row field-row">
                                        <div class="col-xs-12 col-sm-6">
                                            <label>Provinsi</label>
                                            <select name="province_id_asli"class="le-input">
                <?php
//                                foreach ($province as $prov) {
//                                    echo'<option value="' . $prov->id . '">' . ucwords($prov->name) . '</option>';
//                                }
                ?>
                                            </select>
                
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <label>Kab / Kota</label>
                                            <input class="le-input" data-placeholder="town" required readonly="true" >
                                        </div>
                                    </div> /.field-row 
                
                                    <div class="row field-row">
                                        <div class="col-xs-12">
                                            <label>Alamat Tujuan</label>
                                            <input class="le-input" type="text" name="alamatAsli" value="" required readonly="true">
                                        </div>
                                    </div> /.field-row 
                
                
                
                                    <div class="row field-row">
                                        <div class="col-xs-12 col-sm-4">
                                            <label>Kode Pos</label>
                                            <input class="le-input"  >
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label>Email</label>
                                            <input class="le-input" >
                                        </div>
                
                                        <div class="col-xs-12 col-sm-4">
                                            <label>No Telp</label>
                                            <input class="le-input" >
                                        </div>
                                    </div> /.field-row 
                                </div>-->
                <div class="other">
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-6">
                            <label>Nama</label>
                            <input class="le-input" type="text" name="name" value="" required >
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Kecamatan</label>
                            <?php
                            $url = Yii::$app->urlManager->createUrl('product/getcity');

                            $mKec = array();
                            echo Select2::widget([
                                'id' => 'subdistrict_id',
                                'name' => 'city_id',
                                'value' => '',
//                                'data' => $mKec,
                                'options' => [
                                    'multiple' => true,
                                    'placeholder' => 'Pilih Kecamatan'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 3,
                                    'ajax' => [
                                        'url' => $url,
                                        'dataType' => 'json',
                                        'type' => 'get',
                                        'data' => new JsExpression('function(term,page) { return {search:term}; }'),
                                        'results' => new JsExpression('function(data,page) { return {results:data}; }'),
                                    ],
                                ],
                            ]);
                            ?>
                        </div>

                    </div><!-- /.field-row -->
                    <div class="row field-row">
                        <!--                        <div class="col-xs-12 col-sm-6">
                                                    <label>Kabupaten / Kota</label>-->
                        <?php
//                            $data = ArrayHelper::map(Province::find()->all(), 'id', 'name');
//                            echo Select2::widget([
//                                'id' => 'province_id',
////                                'model' => 'province_id',
//                                'name'=> 'province_id',
//                                'data' => $data,
//                                'options' => ['placeholder' => 'Pilih Kota / Kabupaten'],
//                                'pluginOptions' => [
//                                    'allowClear' => true
//                                ],
//                            ]);
                        ?>
                        <!--</div>-->
                        <div class="col-xs-12 col-sm-6">

                            <?php
//                            $url = \yii\helpers\Url::to(['city-list']);
//
//
//                            $initScript = <<< SCRIPT
//function (element, callback) {
//var id=\$(element).val();
//if (id !== "") {
//\$.ajax("{$url}?id=" + id, {
//dataType: "json"
//}).done(function(data) { callback(data.results);});
//}
//}
//SCRIPT;
// The widget
//                            echo $form->field($model, 'city')->widget(Select2::classname(), [
//                                'options' => ['placeholder' => 'Search for a city ...'],
//                                'pluginOptions' => [
//                                    'allowClear' => true,
//                                    'minimumInputLength' => 3,
//                                    'ajax' => [
//                                        'url' => $url,
//                                        'dataType' => 'json',
//                                        'data' => new JsExpression('function(term,page) { return {search:term}; }'),
//                                        'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
//                                    ],
//                                    'initSelection' => new JsExpression($initScript)
//                                ],
//                            ]);
                            ?>

                        </div>
                    </div><!-- /.field-row -->

                    <div class="row field-row">
                        <div class="col-xs-12">
                            <label>Alamat Tujuan</label>
                            <input class="le-input" type="text" name="alamat" value="" required >
                        </div>
                    </div><!-- /.field-row -->



                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label>Kode Pos</label>
                            <input class="le-input" name="postcode" onkeyup="angka(this);"  required>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label>Email</label>
                            <input class="le-input" value="<?php echo $user->email ?>" readonly >
                        </div>

                        <div class="col-xs-12 col-sm-4">
                            <label>No Telp</label>
                            <input class="le-input" name="phone" onkeyup="angka(this);" required>
                        </div>
                    </div><!-- /.field-row -->
                    <div class="row field-row">
                        <div class="col-xs-12">
                            <input  class="le-checkbox big" id="addressDestination1" type="checkbox" name="asuransi"  value="0"> 
                            Gunakan asuransi pengiriman.<br>


                        </div>
                    </div>
                </div>

            </div><!-- /.billing-address -->





            <section id="your-order">
                <h2 class="border h1">Pesanan anda</h2>
                <?php
                $harga = 0;
                $totharga = 0;
                $count = 0;
                if (isset($session['cart'])) {
                    foreach ($session['cart'] as $key => $value) {
                        $product = Product::findOne($key);
                        $totharga += ($product->price_sell * $value);
                        $harga = ($product->price_sell * $value);
                        $count += $value;
                        echo'<div class="row no-margin order-item">
                    <div class="col-xs-12 col-sm-1 no-margin">
                        <img class="lazy" alt="" src="' . $product->imgSmall . '" style="width:70px" />
                    </div>
                    <div class="col-xs-12 col-sm-1 no-margin">
                        <a href="#" class="qty">' . $value . ' x</a>
                    </div>

                    <div class="col-xs-12 col-sm-8 ">
                        <div class="title"><a href="#">' . $product->name . '</a></div>
                        <div class="brand">' . $product->brand_name . '</div>
                    </div>

                    <div class="col-xs-12 col-sm-2 no-margin">
                        <div class="price">' . Yii::$app->landa->rp($harga) . '</div>
                    </div>
                </div>';
                    }
                }
                ?>



            </section><!-- /#your-order -->

            <div id="total-area" class="row no-margin">
                <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                    <div id="subtotal-holder">
                        <table width="100%">
                            <tr>
                                <td>
                                    Jumlah Pesanan
                                </td>
                                <td align="right">
                                    <div class="value" style="font-size: 25px;font-weight: 700;"><?php echo $count ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Total Pesanan
                                </td>
                                <td align="right">
                                    <div class="value" style="font-size: 25px;font-weight: 700;"><?php echo Yii::$app->landa->rp($totharga) ?></div>
                                </td>
                            </tr>
                        </table>

                    </div><!-- /#subtotal-holder -->
                </div><!-- /.col -->
            </div><!-- /#total-area -->

            <div class="place-order-button">
                <a href="<?= Yii::$app->urlManager->createUrl('cart') ?>" class="le-button big" type="submit">Keranjang Belanja</a>
                <a href="<?= Yii::$app->homeUrl ?>" class="le-button big" type="submit">Lanjut Belanja</a>
                <button class="le-button big" type="submit" name="checkout" >Checkout</button>

            </div><!-- /.place-order-button -->

        </div><!-- /.col -->
    </div><!-- /.container -->    
</section><!-- /#checkout-page -->
<?php ActiveForm::end(); ?>
<script>
                                function showCheckout(id) {
                                    if (id == 1) {
                                        $(".other").hide();
                                        $(".current").fadeIn();
                                        $(".addressDestination1").prop("checked", true);
                                    } else {
                                        $(".current").hide();
//            $(".current").css("display", "none");
                                        $(".other").fadeIn();
                                        $(".addressDestination0").prop("checked", true);
                                    }
                                }


//                                $('body').on('change', '#FormTour_paket', function() {
//                                    $.ajax({
//                                        type: 'POST',
//                                        url: "<?php // echo Yii::$app->urlManager->createUrl('product/addcart')                       ?>",
//                                            $('#FormTour_hotel').trigger('change');
//                                           
//                                        }, 'cache': false, 'data': jQuery(this).parents("form").serialize()});
//                                    return false;
//                                });
</script>
<script type="text/javascript">
    /*<![CDATA[*/
//    $(function($) {
//        $('body').popover({'selector': '[rel=popover]'});
//        $('body').on('change', '#province', function() {
//            $.ajax({'type': 'POST', 'url': '<?php // echo Yii::$app->urlManager->createUrl('product/city')                       ?>', 'success': function(data) {
//                    
//                    $("#city").html(data);
//                }, 'cache': false, 'data': jQuery(this).parents("form").serialize()});
//            alert(data);
//            return false;
//        });
//    });
    /*]]>*/

//    $("body").on("keyup", "#s2id_autogen1", function () {
//        var text = $(this).val();
//
//    });
    function angka(e) {
        if (!/^[0-9,+,-]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }
</script>
