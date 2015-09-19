<?php

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
if ($model->info->status == 'pending') {
    $conf = '<a href="' . Yii::$app->urlManager->createUrl('konfirmasi-pembayaran/' . $model->id) . '" class="btn btn-primary pull-right" style="margin-right:10px"><i class="glyphicon glyphicon-ok"></i> Konfirmasi Pembayaran</a>';
} elseif ($model->info->status == 'confirm') {
    $conf = '';
} else {
    $conf = '';
}
?>
<section id="cart-page">

    <div class="container">
        <br>
        <div class='well'>
            <div class="titleBar">
                <div class="strong b-account__title">
                    Pesanan #<?= $model->code ?> dari <?= date('d/m/Y H:i', strtotime($model->created)) ?>
                    <?php echo $conf ?>
                </div>
            </div>
            <table width='100%' class="table">                            
                <tbody><tr>
                        <td class="span1">Status</td>
                        <td class="">:</td>
                        <td class="span5"> <?= $model->status ?></td>

                        <td class="span1">Province</td>
                        <td class="">:</td>
                        <td class="span5">d.i. Yogyakarta</td>
                    </tr>
                    <tr>
                        <td class="span1">Name</td>
                        <td class="">:</td>
                        <td class="span5"><?= $modelInfo->name ?></td>

                        <td class="span1">City</td>
                        <td class="">:</td>
                        <td class="span5">kab. Bantul</td>
                    </tr>    
                    <tr>
                        <td class="span1">Phone</td>
                        <td class="">:</td>
                        <td class="span5"></td>

                        <td class="span1">Address</td>
                        <td class="">:</td>
                        <td class="span5"></td>
                    </tr>  
                    <tr>
                        <td class="span1">Note</td>
                        <td class="">:</td>
                        <td class="span5"></td>

                        <td class="span1">Resi</td>
                        <td class="">:</td>
                        <td class="span5"><span style="text-transform:uppercase"><b></b></span></td>
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
                $ongkir = 0;

                function bulatkan($numb) {
                    if ($numb == '0') {
                        $num1 = '1';
                        return $num1;
                    } else {
                        return $numb;
                    }
                }

                foreach ($modelDet as $arr) {
                    $product = Product::findOne($arr->product_id);
                    $subtotal = $product->price_sell * $arr->qty;
                    $total += $subtotal;
                    echo'<tr>
                    <td><img src="' . $product->imgSmall . '" style="width:90px"></td>
                    <td><a href="' . $product->url . '">' . $product->name . '</a>
                        <ul class="unstyled">
                                        
                                        <li>Product Code : ' . $product->code . '</li>
                                        <li>Brand : ' . $product->brand_name . '</li>
                                </ul>
                                </td>
                    <td>' . $arr->qty . '</td>
                    <td>' . $product->price_sell_rp . '</td>
                    <td>' . Yii::$app->landa->rp($subtotal) . '</td>
                    </tr>';
                    $ceil = ceil($product->weight); //pembulatan 0
                    $ongkir = $ongkir + ($arr->qty * bulatkan($ceil)); // jumlah barang dikali pembulatan berat
                }

                $ongkrm = $ongkir * 12000;
                ?>
                <tr>
                    <td colspan="3"></td>
                    <td>Ongkos Kirim</td>
                    <td><?= Yii::$app->landa->rp($ongkrm) ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>Total Belanja</td>
                    <td><?= Yii::$app->landa->rp($total + $ongkrm) ?></td>
                </tr>
            </table>
        </div>
    </div>
</section>
