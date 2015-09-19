<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_sell_det".
 *
 * @property integer $id
 * @property integer $sell_id
 * @property integer $product_id
 * @property double $qty
 * @property integer $price
 */
class SellDet extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'acca_sell_det';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sell_id', 'product_id', 'price'], 'integer'],
            [['qty'], 'number']
        ];
    }
    public function getProduct() {
        return $this->hasOne(Product::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'sell_id' => 'Sell ID',
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'price' => 'Price',
        ];
    }

}
