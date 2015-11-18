<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Kontak Kami';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">

        <div class="col-md-8">
            
            <section class="section leave-a-message">
                <h2 class="bordered">Tinggalkan Pesan Kepada Kami</h2>
                <p>Mengenai lebih lanjut tentang kami silahkan kirim email kepada kami.</p>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row field-row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Nama*</label>
                        <input type="text" id="contactform-name" class="le-input" name="ContactForm[name]" required>

                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>Email*</label>
                        <input type="text" id="contactform-email" class="le-input" name="ContactForm[email]" required>

                    </div>
                </div><!-- /.field-row -->

                <div class="field-row">
                    <label>Judul</label>
                    <input type="text" id="contactform-subject" class="le-input" name="ContactForm[subject] required">

                </div><!-- /.field-row -->

                <div class="field-row">
                    <label>Pesan</label>
                    <textarea id="contactform-body" class="le-input" name="ContactForm[body]" rows="8" required></textarea>

                </div><!-- /.field-row -->
                <?=
                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])
                ?>
                <div class="buttons-holder">
                    <button type="submit" class="le-button huge" name="send"> Kirim Pesan</button>
                </div><!-- /.buttons-holder -->

                <?php ActiveForm::end(); ?>
            </section><!-- /.leave-a-message -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <section class="our-store section inner-left-xs">
                <h2 class="bordered">Toko Kami</h2>
                <address>
                    Jl. Brigjend S.Riadi 10<br/>
                    Malang, Jawa Timur <br/>

                </address>
                <h3>Jam Buka</h3>
                <ul class="list-unstyled operation-hours">
                    <li class="clearfix">
                        <span class="day">Senin:</span>
                        <span class="pull-right hours">09:30 - 17:00</span>
                    </li>
                    <li class="clearfix">
                        <span class="day">Selasa:</span>
                        <span class="pull-right hours">09:30 - 17:00</span>
                    </li>
                    <li class="clearfix">
                        <span class="day">Rabu:</span>
                        <span class="pull-right hours">09:30 - 17:00</span>
                    </li>
                    <li class="clearfix">
                        <span class="day">Kamis:</span>
                        <span class="pull-right hours">09:30 - 17:00</span>
                    </li>
                    <li class="clearfix">
                        <span class="day">Jumat:</span>
                        <span class="pull-right hours">09:30 - 17:00</span>
                    </li>
                    <li class="clearfix">
                        <span class="day">Sabtu:</span>
                        <span class="pull-right hours">09:30 - 17:00</span>
                    </li>
                    <li class="clearfix">
                        <span class="day">Minggu</span>
                        <span class="pull-right hours">09:30 - 17:00</span>
                    </li>
                </ul>
<!--                <h3>Career</h3>
                <p>If you're interested in employment opportunities at MediaCenter, please email us: <a href="mailto:contact@yourstore.com">contact@yourstore.com</a></p>-->
            </section><!-- /.our-store -->
        </div><!-- /.col -->

    </div><!-- /.row -->
</div><!-- /.container -->
