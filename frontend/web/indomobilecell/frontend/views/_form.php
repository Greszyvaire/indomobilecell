<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trans_number')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'bank_account')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'self_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'self_account_number')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'self_bank_account')->textInput(['maxlength' => 225]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'reject' => 'Reject', 'confirm' => 'Confirm', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'date_trans')->textInput() ?>

    <?= $form->field($model, 'created_user_id')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'module')->dropDownList([ 'deposit' => 'Deposit', 'roles' => 'Roles', 'sell' => 'Sell', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
