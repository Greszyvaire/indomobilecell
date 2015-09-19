<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_subscribe".
 *
 * @property integer $id
 * @property string $email
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acca_subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
        ];
    }
}
