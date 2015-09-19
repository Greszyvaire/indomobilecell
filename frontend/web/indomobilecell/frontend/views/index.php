<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'trans_number',
            'bank_account',
            'self_name',
            'self_account_number',
            // 'self_bank_account',
            // 'description',
            // 'status',
            // 'amount',
            // 'created',
            // 'date_trans',
            // 'created_user_id',
            // 'modified',
            // 'module',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
