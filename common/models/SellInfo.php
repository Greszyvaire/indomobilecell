<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_sell_info".
 *
 * @property integer $id
 * @property integer $sell_id
 * @property string $status
 * @property integer $city_id
 * @property string $address
 * @property string $phone
 * @property string $name
 */
class SellInfo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'acca_sell_info';
    }
    public function getCity() {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sell_id', 'city_id', 'postcode'], 'integer'],
            [['status', 'address'], 'string'],
            [['phone', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'sell_id' => 'Sell ID',
            'status' => 'Status',
            'city_id' => 'City ID',
            'address' => 'Address',
            'phone' => 'Phone',
            'postcode' => 'Kode Pos',
            'name' => 'Name',
        ];
    }
    
    public function getKota(){
        $kota = (isset($this->city->name)) ? $this->city->name : '';
        $province = (isset($this->city->province->name)) ? $this->city->province->name : '';
        return $kota . ', ' . $province;
    }

}
