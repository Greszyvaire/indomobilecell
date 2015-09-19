<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface {
//    const STATUS_DELETED = 0;

    const STATUS_ACTIVE = 1;

    public $status;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'acca_user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
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
    public function attributeLabels() {
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

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'enabled' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'enabled' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === sha1($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

}
