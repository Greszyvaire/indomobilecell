<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_product_stock".
 *
 * @property integer $id
 * @property string $product_id
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 * @property integer $departement_id
 * @property double $qty
 * @property integer $price
 */
class ProductStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'modified'], 'safe'],
            [['created_user_id', 'departement_id', 'price'], 'integer'],
            [['qty'], 'number'],
            [['product_id'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'created' => 'Created',
            'created_user_id' => 'Created User ID',
            'modified' => 'Modified',
            'departement_id' => 'Departement ID',
            'qty' => 'Qty',
            'price' => 'Price',
        ];
    }
    public function departement($stock, $departement_id){
        $stockDepartement = json_decode($stock);
        $stockDepartement = (empty($stockDepartement->$departement_id)) ? 0 : $stockDepartement->$departement_id;
        return $stockDepartement;
    }
}
