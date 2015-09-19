<?php

use yii\widgets\LinkPager;

$this->title = 'Pesanan Anda';
?>
<style>
    .titleBar {
        background: #d9d9d9;
        padding: 8px 20px 8px 10px;
    }
    .b-account__title {
        font-size: 14px;
        color: #4c4c4c;
        font-weight: bold;
    }
</style>
<section id="cart-page">

    <div class="container">
        <br>
        <div class='well'>
            <div class="titleBar">
                <div class="strong b-account__title">
                    Status Order
                </div>

            </div>
            <table width="100%" class="table table-hover">
                <tr>
                    <th>Nomor Order</th>
                    <th style='width:10%'>Tanggal</th>
                    <th>Status</th>
                    <th style='width: 40%;'>Alamat Lengkap</th>
                    <th>Jumlah</th>
                    <th></th>
                </tr>
                <?php
                $conf = '';
                $status = '';
                foreach ($pesanan as $data) {
                    if (isset($data->info->status)) {
                        if ($data->info->status == 'pending' && $data->is_confirm == 1) {
                            $status = '<span class="label label-warning">Pending</span>';
                            $conf = '<span class="badge label-warning" style="background-color:black">Menunggu Konfirmasi Admin</span><br>';
                        } elseif ($data->info->status == 'pending') {
                            $status = '<span class="label label-warning">Pending</span>';
                            $conf = '<a href="' . Yii::$app->urlManager->createUrl('konfirmasi-pembayaran/' . $data->id) . '"><span class="badge">Konfirmasi</span></a><br>';
                        } elseif ($data->info->status == 'confirm') {
                            $status = '<span class="label label-primary">Confirm</span>';
                            $conf = '';
                        } else {
                            $status = '<span class="label label-danger">Reject</span>';
                            $conf = '';
                        }

                        if ($data->info->status == 'pending' && $data->is_confirm == 1) {
                            $status = '<span class="label label-warning">Pending</span>';
                            $conf = '<span class="badge label-warning" style="background-color:black">Menunggu Konfirmasi Admin</span><br>';
                        } elseif ($data->info->status == 'pending') {
                            $status = '<span class="label label-warning">Pending</span>';
                            $conf = '<a href="' . Yii::$app->urlManager->createUrl('konfirmasi-pembayaran/' . $data->id) . '"><span class="badge">Konfirmasi</span></a><br>';
                        } elseif ($data->info->status == 'confirm') {
                            $status = '<span class="label label-primary">Confirm</span>';
                            $conf = '';
                        } else {
                            $status = '<span class="label label-danger">Reject</span>';
                            $conf = '';
                        }

                        echo'<tr>
                    <td>' . $data->code . '</td>
                    <td>' . date('d-m-Y', strtotime($data->created)) . '</td>
                    <td>' . $data->status . '</td>
                    <td>' . $data->address_full . '</td>
                    <td>' . $data->subtotal_rp . '</td>
                    <td align="center">' . $conf . '
                    <a href="' . Yii::$app->urlManager->createUrl('detail-pesanan/' . $data->id) . '"><span class="badge">Lihat Pesanan</span></a></td>
                    </tr>
                    ';
                    }
                }
                ?>
            </table>
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
            <div class="alert alert-info" role="alert">
                <h5>Info status pesanan</h5>
                <ol>
                    <li><span class="label label-warning"> PENDING </span>  &nbsp;&nbsp;Transaksi telah direview oleh Admin. Dan sedang menunggu proses konfirmasi pembayaran dari User</li>
                    <li><span class="label label-primary"> CONFIRM </span> &nbsp;&nbsp;Transaksi telah dibayarkan oleh User dan sendang dilakukan pengiriman</li>
                    <li><span class="label label-danger">REJECT</span>&nbsp;&nbsp; Jika transaksi udah kadalaursa atau lama tidak ada konfirmasi pembayaran</li>
                </ol>
            </div>
        </div>
    </div>
</section>
