<?php
//use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Sell */

$this->title = 'Lihat Pesanan';
?>
<style>
    .titleBar {
        background: #d9d9d9;
        padding: 8px 20px 18px 10px;
    }
    .b-account__title {
        font-size: 14px;
        color: #4c4c4c;
        font-weight: bold;
    }
</style>
<?php
$conf = '';
if ($model->is_confirm == 1 && $model->info->status == 'pending') {
    $conf = '<span class="label label-info pull-right" style="font-size:15px">Menunggu Konfirmasi Dari Admin</span>';
} elseif ($model->is_confirm == 1 && $model->info->status == 'confirm') {
    $conf = '<span class="label label-info pull-right" style="font-size:15px">Pembayaran Sudah Ter-konfirmasi</span>';
} elseif ($model->info->status == 'pending') {
    $conf = '<a href="' . Yii::$app->urlManager->createUrl('konfirmasi-pembayaran/' . $model->id) . '" class="btn btn-primary pull-right" style="margin-right:10px"><i class="glyphicon glyphicon-ok"></i> Konfirmasi Pembayaran</a>';
} elseif ($model->info->status == 'confirm') {
    $conf = '';
} else {
    $conf = '';
}

$usr_session_id = Yii::$app->user->identity->id;
//Yii::error($usr_session_id);
?>

<section id="cart-page">

    <div class="container">
        <br>
<?php
//echo $usr_session_id."-".$model->customer_user_id; 
if($usr_session_id == $model->customer_user_id){
        ?>
        <div class='well'>
                <div class="titleBar">
                    <div class="strong b-account__title">
                        Pesanan #<?= $model->code ?> dari <?= date('d-m-Y, H:i', strtotime($model->created)) ?>
    <?php echo $conf ?>
                    </div>
                </div>
                <table width='100%' class="table">                            
                    <tbody><tr>
                            <td class="span1">Status</td>
                            <td class="">:</td>
                            <td class="span5"> <?= $model->status ?></td>

                            <td class="span1" rowspan="3">Alamat</td>
                            <td class="" rowspan="3">:</td>
                            <td class="span5" style="width: 30%;" rowspan="3"><?= $modelInfo->address . ', ' . $modelInfo->Kota ?></td>
                        </tr>
                        <tr>
                            <td class="span1">Nama</td>
                            <td class="">:</td>
                            <td class="span5"><?= $modelInfo->name ?></td>
                        </tr>    
                        <tr>
                            <td class="span1">No. Telephone</td>
                            <td class="">:</td>
                            <td class="span5"><?= Yii::$app->landa->hp($modelInfo->phone) ?></td>
                        </tr>  
                        <tr>
                            <td class="span1">Kode Pos</td>
                            <td class="">:</td>
                            <td class="span5"><?= $modelInfo->postcode ?></td>

                            <td class="span1">Resi</td>
                            <td class="">:</td>
                            <td class="span5"><span style="text-transform:uppercase"><b><?= $model->resi ?></b></span></td>
                        </tr> 
                    </tbody></table>
            </div>
            <div class='well'>
                <div class="titleBar">
                    <div class="strong b-account__title">
                        Produk yang telah di pesan
                    </div>
                </div>
                <table width='100%' class="table"> 
                    <tr>
                        <th>Produk</th>
                        <th>Description</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
    <?php
    $subtotal = 0;
    $total = 0;

    foreach ($modelDet as $arr) {
        $product = Product::findOne($arr->product_id);
        $subtotal = $product->price_sell * $arr->qty;
        $total += $subtotal;
        echo'<tr>
                    <td><img src="' . $product->imgSmall . '" style="width:90px"></td>
                    <td><a href="' . $product->url . '">' . $product->name . '</a>
                        <ul class="unstyled">
                                        
                                        <li>Kode : ' . $product->code . '</li>
                                        <li>Merek : ' . $product->brand_name . '</li>
                                </ul>
                                </td>
                    <td align="center">' . $arr->qty . '</td>
                    <td>' . $product->price_sell_rp . '</td>
                    <td>' . Yii::$app->landa->rp($subtotal) . '</td>
                    </tr>';
//                    $ceil = ceil($product->weight); //pembulatan 0
//                    $ongkir = $ongkir + ($arr->qty * bulatkan($ceil)); // jumlah barang dikali pembulatan berat
    }
    ?>

                    <tr>
                        <td colspan="3"></td>
                        <td>Biaya Pengiriman *</td>
                        <td><div style="font-weight: bold;font-size: 16px;"><?= Yii::$app->landa->rp($model->ongkir) ?></div></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Lain-lain **</td>
                        <td><div style="font-weight: bold;font-size: 16px;"><?= Yii::$app->landa->rp($model->other) ?></div></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Total Belanja</td>
                        <td><div style="font-weight: bold;font-size: 16px;"><?= Yii::$app->landa->rp($model->subtotal + $model->ongkir + $model->other) ?></div></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <i style="font-size: 11px">* kita menggunakan type pengiriman REG dari JNE</i><br>
                            <i style="font-size: 11px">** lain lain meliputi biaya asuransi per item (optional) dan biaya administrasi sebesar Rp 5.000,-</i>
                        </td>                    

                    </tr>
                </table>
                <div class="alert alert-warning" role="alert">  
                    <h5>
                        Cara Pembayaran
                    </h5><br> <ol>          
                        <li> Pesanan Anda baru Kami kirim setelah Kami menerima pembayaran dari Anda.</li>
                        <li> Kirim ke Rekening IndoMobile Cell:Jimmy Etmada - (BCA 0113161202)<br></li>
                        <li> Setelah melakukan Transfer mohon konfirmasikan dengan cara mengklik tombol <span class="label label-info">Konfirmasi Pembayaran </span> yang berada di atas.</li>

                    </ol>
                </div>
            </div>
        <?php
}
else{
    echo '<div class="well">
       <img src="http://indomobilecell.com/app/img/cc.png" />
    </div>';
}

    ?>
 
    </div>
</section>

