<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_city".
 *
 * @property integer $id
 * @property integer $province_id
 * @property string $name
 * @property integer $charge
 */
class Satuan extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product_measure';
    }
    

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description'
        ];
    }

}
