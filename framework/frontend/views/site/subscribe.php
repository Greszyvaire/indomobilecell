<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
?>
<div class="container">
    <div class="col-xs-4" >
         
        <img class="img-responsive"style="border-radius: 100%;" src="<?= Yii::$app->homeUrl ?>images/cs.jpg" width="360px"/>
    </div>
    <div class="col-xs-6">
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {

            echo'<div class="alert alert-' . $key . ' alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>' . $message . '</strong>
</div>';
        }
        ?>
    </div></div>           


