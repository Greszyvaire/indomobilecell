<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Konfirmasi Pemabayaran '.$sell->code;
/* @var $this yii\web\View */
/* @var $model common\models\Sell */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sell-form">

    <?php $form = ActiveForm::begin(); ?>

    <section id="checkout-page">
        <div class="container">
            <div class="col-xs-12 no-margin">
                <div class="billing-address">
                    <h2 class="border h1" style="font-size: 20px;">Konfirmasi Pembayaran Nomor Order <b><?= $sell->code ?></b></h2>

                    <div class="current" style="display: block">

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label>Bank Tujuan</label>
                                <input class="le-input" maxlength="45" name="Payment[trans_number]" id="Payment_trans_number" value="<?php echo $sell->code ?>" type="hidden" >
                                
                                <select class="le-input" name="Payment[bank_account]" id="Payment_bank_account">
                                    <option value="Jimmy Etmada - (BCA 0111110335)">Jimmy Etmada - (BCA 0111110335)</option>
                                </select>

                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <label>Atas Nama Rekening</label>
                                <input class="le-input" maxlength="45" name="Payment[self_name]" id="Payment_self_name" type="text" required>
                                

                            </div>

                        </div><!-- /.field-row -->
                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                <label>No. Rekening</label>
                                 <input class="le-input" onkeyup="angka(this);"  name="Payment[self_account_number]" id="Payment_self_account_number" type="text" required>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <label>Jumlah transfer</label>
                                <input   name="Payment[amount]" type="hidden" value="<?= $sell->subtotal+$sell->other+$sell->ongkir ?>">
                                <input class="le-input" maxlength="45" name="amount" id="Payment_self_account_number" type="text" value="<?= Yii::$app->landa->rp($sell->subtotal+$sell->other+$sell->ongkir) ?>" readonly>
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12">
                                <label>Keterangan Tambahan</label>
                                <textarea name="Payment[description]" class="le-input"></textarea>
                                
                            </div>
                        </div><!-- /.field-row -->
                        <div class="row field-row">
                            <div class="col-xs-12">
                               <button type="submit" class="le-button">Konfirmasi Sekarang</button>
                            </div>
                        </div><!-- /.field-row -->

                    </div>


                </div><!-- /.billing-address -->

            </div>
        </div>
    </section>
    

    <?php ActiveForm::end(); ?>

</div>
<script>
function angka(e) {
            if (!/^[0-9,+,-]+$/.test(e.value)) {
                e.value = e.value.substring(0, e.value.length - 1);
            }
        }
</script>
