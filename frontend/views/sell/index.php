<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SellSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sells';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sell-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sell', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'code',
            'sell_order_id',
            'departement_id',
            'customer_user_id',
            // 'created',
            // 'created_user_id',
            // 'modified',
            // 'description',
            // 'subtotal',
            // 'discount',
            // 'ppn',
            // 'other',
            // 'term',
            // 'dp',
            // 'credit',
            // 'payment',
            // 'total',
            // 'resi',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
