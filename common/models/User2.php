<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $code
 * @property string $name
 * @property integer $city_id
 * @property string $address
 * @property string $phone
 * @property string $description
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 * @property integer $enabled
 * @property string $avatar_img
 * @property integer $roles_id
 * @property integer $saldo
 * @property string $sex
 * @property string $nationality
 * @property string $birth
 * @property integer $referal_user_id
 * @property string $others
 * @property integer $modal
 * @property string $auth_key
 */
class User2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'created_user_id', 'enabled', 'roles_id', 'saldo', 'referal_user_id', 'modal'], 'integer'],
            [['created', 'modified', 'birth'], 'safe'],
            [['sex', 'others'], 'string'],
//            [['modal', 'auth_key'], 'required'],
            [['username', 'phone'], 'string', 'max' => 20],
            [['email', 'avatar_img'], 'string', 'max' => 100],
            [['password', 'name', 'address', 'description', 'nationality'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 25],
            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'code' => 'Code',
            'name' => 'Name',
            'city_id' => 'City ID',
            'address' => 'Address',
            'phone' => 'Phone',
            'description' => 'Description',
            'created' => 'Created',
            'created_user_id' => 'Created User ID',
            'modified' => 'Modified',
            'enabled' => 'Enabled',
            'avatar_img' => 'Avatar Img',
            'roles_id' => 'Roles ID',
            'saldo' => 'Saldo',
            'sex' => 'Sex',
            'nationality' => 'Nationality',
            'birth' => 'Birth',
            'referal_user_id' => 'Referal User ID',
            'others' => 'Others',
            'modal' => 'Modal',
            'auth_key' => 'Auth Key',
        ];
    }
}
