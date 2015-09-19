<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acca_sell".
 *
 * @property integer $id
 * @property string $code
 * @property integer $sell_order_id
 * @property integer $departement_id
 * @property integer $customer_user_id
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 * @property string $description
 * @property integer $subtotal
 * @property integer $discount
 * @property integer $ppn
 * @property integer $other
 * @property string $term
 * @property integer $dp
 * @property integer $credit
 * @property integer $payment
 * @property integer $total
 * @property string $resi
 */
class Sell extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'acca_sell';
    }

    public function getInfo() {
        return $this->hasOne(SellInfo::className(), ['sell_id' => 'id']);
    }

    public function getDetail() {
        return $this->hasOne(SellDet::className(), ['sell_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sell_order_id', 'departement_id', 'customer_user_id', 'created_user_id', 'subtotal', 'discount', 'ppn', 'other', 'dp', 'credit', 'payment', 'total','ongkir','is_confirm'], 'integer'],
            [['created', 'modified', 'term'], 'safe'],
//            [['resi'], 'required'],
            [['code', 'description', 'resi'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'sell_order_id' => 'Sell Order ID',
            'departement_id' => 'Departement ID',
            'customer_user_id' => 'Customer User ID',
            'created' => 'Created',
            'created_user_id' => 'Created User ID',
            'modified' => 'Modified',
            'description' => 'Description',
            'subtotal' => 'Subtotal',
            'discount' => 'Discount',
            'ppn' => 'Ppn',
            'other' => 'Other',
            'term' => 'Term',
            'dp' => 'Dp',
            'credit' => 'Credit',
            'payment' => 'Payment',
            'total' => 'Total',
            'resi' => 'Resi',
        ];
    }

    public function getStatus() {
        $status = '';
       
        if ($this->info->status == 'pending') {
            $status = '<span class="label label-warning">Pending</span>';
            
        } elseif ($this->info->status == 'confirm') {
            $status = '<span class="label label-primary">Confirm</span>';
            
        } else {
            $status = '<span class="label label-danger">Reject</span>';
            
        }
        return $status;
    }

    public function getAddress_full() {
        $alamat = '';
        if (isset($this->info->address)) {
            $alamat = $this->info->address;
        } else {
            $alamat = '-';
        }
        return $alamat;
    }

    public function getSubtotal_rp() {
        return Yii::$app->landa->rp($this->subtotal + $this->ongkir);
    }

}
