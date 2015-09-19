<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%acca_roles}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_allow_login
 */
class Roles extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%acca_roles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['is_allow_login'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_allow_login' => 'Is Allow Login',
        ];
    }

}
