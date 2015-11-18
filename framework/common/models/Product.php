<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "acca_product".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $alias
 * @property integer $product_brand_id
 * @property integer $product_category_id
 * @property integer $product_measure_id
 * @property string $type
 * @property string $description
 * @property integer $price_sell
 * @property integer $price_buy
 * @property integer $discount
 * @property string $stock
 * @property double $stock_min
 * @property double $stock_max
 * @property integer $product_photo_id
 * @property double $weight
 * @property double $width
 * @property double $height
 * @property double $length
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 * @property integer $hits
 * @property string $assembly_product_id
 */
class Product extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    public function getBrand() {
        return $this->hasOne(ProductBrand::className(), ['id' => 'product_brand_id']);
    }

    public function getProductPhoto() {
        return $this->hasOne(ProductPhoto::className(), ['id' => 'product_photo_id']);
    }

    public function getProductCategory() {
        return $this->hasOne(ProductCategory::className(), ['id' => 'product_category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['product_brand_id', 'product_category_id', 'product_measure_id', 'price_sell', 'price_buy', 'discount', 'product_photo_id', 'created_user_id', 'hits'], 'integer'],
            [['type', 'description', 'assembly_product_id'], 'string'],
            [['stock_min', 'stock_max', 'weight', 'width', 'height', 'length'], 'number'],
            [['created', 'modified'], 'safe'],
            [['code'], 'string', 'max' => 45],
            [['name', 'alias', 'stock'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'alias' => 'Alias',
            'product_brand_id' => 'Product Brand ID',
            'product_category_id' => 'Product Category ID',
            'product_measure_id' => 'Product Measure ID',
            'type' => 'INV : Inventory
SRV : Service',
            'description' => 'Description',
            'price_sell' => 'Price Sell',
            'price_buy' => 'Price Buy',
            'discount' => 'Discount',
            'stock' => 'JSON [departement_id][stock]',
            'stock_min' => 'Stock Min',
            'stock_max' => 'Stock Max',
            'product_photo_id' => 'Product Photo ID',
            'weight' => 'Weight',
            'width' => 'Width',
            'height' => 'Height',
            'length' => 'Length',
            'created' => 'Created',
            'created_user_id' => 'Created User ID',
            'modified' => 'Modified',
            'hits' => 'Hits',
            'assembly_product_id' => 'JSON [product_id][qty]',
        ];
    }

    public function getPrice_sell_rp() {
        return Yii::$app->landa->rp($this->price_sell);
    }

    public function getDiscount_rp() {
        if (!empty($this->discount)) {
            $discount = Yii::$app->landa->rp($this->discount);
        } else {
            $discount = '';
        }
        return $discount;
    }

    public function getBrand_name() {
        if (isset($this->brand->name))
            return $this->brand->name;
        else
            return "";
    }

    public function getImgSmall() {
        if (empty($this->product_photo_id) || empty($this->productPhoto->img)) {
            return Yii::$app->params['urlImg'] . '150x150-noimage.jpg';
        } else {
            return Yii::$app->params['urlImg'] . 'product/' . $this->product_photo_id . '-150x150-' . Yii::$app->landa->urlParsing($this->productPhoto->img);
        }
    }

    public function getImgMedium() {
        if (empty($this->product_photo_id) || empty($this->productPhoto->img)) {
            return Yii::$app->params['urlImg'] . '350x350-noimage.jpg';
        } else {
            return Yii::$app->params['urlImg'] . 'product/' . $this->product_photo_id . '-350x350-' . Yii::$app->landa->urlParsing($this->productPhoto->img);
        }
    }

    public function getImgBig() {
        if (empty($this->product_photo_id) || empty($this->productPhoto->img)) {
            return Yii::$app->params['urlImg'] . '650x650-noimage.jpg';
        } else {
            return Yii::$app->params['urlImg'] . 'product/' . $this->product_photo_id . '-650x650-' . Yii::$app->landa->urlParsing($this->productPhoto->img);
        }
    }

    public function getUrl() {
        if (!isset($this->productCategory->alias)) {
            return '#';
        } else {
            return Yii::$app->urlManager->createUrl('detail/' . $this->productCategory->alias . '/' . $this->alias);
        }
    }

    public function getIsNew() {
        //jika tanggal lebih dari 30 hari dari sekarang, berarti barang baru
        if (strtotime($this->created) >= (time() - (86400 * 30)))
            return TRUE;
        else
            return false;
    }

    public function getRealStock() {
        $departement_id = 1;
        $stockDepartement = json_decode($this->stock);
        $stockDepartement = (empty($stockDepartement->$departement_id)) ? 0 : $stockDepartement->$departement_id;
        return $stockDepartement;
    }

    public function behaviors() {
        return [

            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'modified'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['modified'],
                ],
            ],
        ];
    }

}
