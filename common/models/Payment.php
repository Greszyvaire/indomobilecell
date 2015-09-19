<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_payment".
 *
 * @property integer $id
 * @property string $trans_number
 * @property string $bank_account
 * @property string $self_name
 * @property string $self_account_number
 * @property string $self_bank_account
 * @property string $description
 * @property string $status
 * @property integer $amount
 * @property string $created
 * @property string $date_trans
 * @property integer $created_user_id
 * @property string $modified
 * @property string $module
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acca_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['self_bank_account', 'date_trans'], 'required'],
            [['status', 'module'], 'string'],
            [['amount', 'created_user_id'], 'integer'],
            [['created', 'date_trans', 'modified'], 'safe'],
            [[ 'self_name', 'self_account_number'], 'string', 'max' => 45],
            [['bank_account', 'description'], 'string', 'max' => 255],
            [['trans_number','self_bank_account'], 'string', 'max' => 225]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_number' => 'Trans Number',
            'bank_account' => 'Bank Account',
            'self_name' => 'Self Name',
            'self_account_number' => 'Self Account Number',
            'self_bank_account' => 'Self Bank Account',
            'description' => 'Description',
            'status' => 'Status',
            'amount' => 'Amount',
            'created' => 'Created',
            'date_trans' => 'Date Trans',
            'created_user_id' => 'Created User ID',
            'modified' => 'Modified',
            'module' => 'Module',
        ];
    }
}
