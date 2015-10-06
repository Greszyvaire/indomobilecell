<?php
use common\models\Sell;
use common\models\SellDet;
use common\models\SellInfo;
use common\models\User;
use common\models\Product;

$sellDet = SellDet::find()->where(['sell_id' => $sell_id])->all();
$sellInfo = SellInfo::find()->where(['sell_id' => $sell_id])->one();
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
?>