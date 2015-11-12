<?php
$session = Yii::$app->session;
$this->title = 'Keranjang Belanja';
use common\models\Product;
use common\models\ProductStock;
use yii\bootstrap\ActiveForm
?>
<section id="cart-page">

    <div class="container">

        <!-- ========================================= CONTENT ========================================= -->
        <?php $form = ActiveForm::begin(['id' => 'cart-form']); ?>
            <div class="col-xs-12 col-md-9 items-holder no-margin">
                <?php
                $harga = 0;
                $totharga = 0;
                $count = 0;
                $option = '';
                $selected = '';
                if (isset($session['cart'])) {
//                    print_r($session['cart']);
                    foreach ($session['cart'] as $key => $value) {
                        $product = Product::findOne($key);
                        $totharga += ($product->price_sell * $value);
                        $harga = ($product->price_sell * $value);
                        $count += $value;
                        

                        echo'<div class="row no-margin cart-item">
                <div class="col-xs-12 col-sm-2 no-margin">
                    <a href="#" class="thumb-holder">
                        <img class="lazy" alt="" src="' . $product->imgSmall . '" style="width:100px" />
                    </a>
                </div>

                <div class="col-xs-12 col-sm-5 ">
                    <div class="title">
                        <a href="' . $product->url . '">' . $product->name . '</a>
                    </div>
                    <div class="brand">' . $product->brand_name . '</div>
                </div> 

                <div class="col-xs-12 col-sm-3 no-margin">
                    <div class="quantity"  name="qty[]">
                        <select class = "le-quantity" name="qty['.$key.']" style="width: 70px;">';
                       for($no=1;$no<=$product->stock;$no++){
                            $selected = ($no == $value) ? 'selected' :'';
                           echo '<option '.$selected.' value="'.$no.'">'.$no.'</option>'; 
                        }
                       echo' </select>
                        
                            <input name="key[]"  type="hidden" value="' . $key . '" />

                    </div>
            </div> 

            <div class="col-xs-12 col-sm-2 no-margin">
                <div class="price">
                    ' . Yii::$app->landa->rp($harga) . '
                </div>
                <a class="close-btn hapus" id="' . $product->id . '" href="#"></a>
            </div>
        </div>';
        }
        } else {
        echo'<div class="row no-margin cart-item">
            <div class="col-xs-12 col-sm-12 no-margin">

                Keranjang belanja kosong
            </div>
        </div>';
        }
        ?>
        <br>
        <button class="le-button big" type="submit" name="update" >Update Cart</button>
        </div>

        <?php ActiveForm::end(); ?>
        <!-- ========================================= CONTENT : END ========================================= -->

        <!-- ========================================= SIDEBAR ========================================= -->

        <div class="col-xs-12 col-md-3 no-margin sidebar ">
            <div class="widget cart-summary">
                <h1 class="border">shopping cart</h1>
                <div class="body">

                    <table width="100%">
                        <tr>
                            <td>Jumlah Barang</td>
                            <td><center><span style="font-weight: 700;font-size: 20px;"><?php echo $count ?></span></center></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><span style="font-weight: 700;font-size: 20px;line-height: 60px;"><?php echo Yii::$app->landa->rp($totharga) ?></span></td>
                        </tr>
                    </table>
                    <div class="buttons-holder">
                        <a class="le-button big" href="<?= Yii::$app->urlManager->createUrl('destination') ?>" >Selesai Belanja</a>
                        <a class="simple-link block" href="<?= Yii::$app->homeUrl ?>" >Lanjutkan Belanja</a>
                    </div>
                </div>
            </div><!-- /.widget -->


        </div><!-- /.sidebar -->

        <!-- ========================================= SIDEBAR : END ========================================= -->
        </div>
        </section>	

        <script>
                                function numericFilter(txb) {
                                    tx.value = tx.value.replace(/[^\1-9]/ig, "");
                                }


                                $("body").on("click", ".hapus", function() {
                                    var id = $(this).attr("id");
        //        var terbeli  = $(this);
        //        var parent = $(this).parent().parent();
                                    $.ajax({
                                        type: 'POST',
                                        data: {id: id},
                                        url: "<?php echo Yii::$app->urlManager->createUrl('product/delcart') ?>",
                                success: function(data) {
                                    location.reload();
//                alert(data);
//                parent.remove();
//                $( "#del" ).fadeOut( "slow" );
                                },
                            });
                        });
</script>
