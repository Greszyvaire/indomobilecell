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
class City extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'city';
    }
    public function getProvince() {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['province_id', 'name', 'charge'], 'required'],
            [['province_id', 'charge'], 'integer'],
            [['name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'name' => 'Name',
            'charge' => 'Charge',
        ];
    }

}
