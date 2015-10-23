<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_product_photo".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $img
 */
class ProductPhoto extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['product_id'], 'integer'],
            [['img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'img' => 'Img',
        ];
    }

    public function getImgSmall() {
        return Yii::$app->params['urlImg'] . 'product/' . $this->id . '-150x150-' . Yii::$app->landa->urlParsing($this->img);
    }

    public function getImgMedium() {
        return Yii::$app->params['urlImg'] . 'product/' . $this->id . '-350x350-' . Yii::$app->landa->urlParsing($this->img);
    }

    public function getImgBig() {
        return Yii::$app->params['urlImg'] . 'product/' . $this->id . '-650x650-' . Yii::$app->landa->urlParsing($this->img);
    }

}
