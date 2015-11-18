<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_product_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $created_user_id
 * @property string $modified
 * @property string $created
 * @property integer $level
 * @property integer $lft
 * @property integer $rgt
 * @property integer $root
 * @property integer $parent_id
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'string'],
            [['created_user_id', 'level', 'lft', 'rgt', 'root', 'parent_id'], 'integer'],
            [['modified', 'created'], 'safe'],
            [['name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'alias' => 'Alias',
            'created_user_id' => 'Created User ID',
            'modified' => 'Modified',
            'created' => 'Created',
            'level' => 'Level',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'root' => 'Root',
            'parent_id' => 'Parent ID',
        ];
    }
    
    public function getProduct() {
        return $this->hasMany(Product::className(), ['product_category_id' => 'id']);
    }
}
