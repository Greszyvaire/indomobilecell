<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SellSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sell-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'sell_order_id') ?>

    <?= $form->field($model, 'departement_id') ?>

    <?= $form->field($model, 'customer_user_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created_user_id') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'ppn') ?>

    <?php // echo $form->field($model, 'other') ?>

    <?php // echo $form->field($model, 'term') ?>

    <?php // echo $form->field($model, 'dp') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'resi')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
