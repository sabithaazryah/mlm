<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "epin_request".
 *
 * @property int $id
 * @property string $amount_deposited
 * @property string $bank_name
 * @property int $type
 * @property string $transaction_id
 * @property string $name
 * @property string $phone_number
 * @property int $number_of_pin
 * @property string $package_for_each_pin
 * @property string $slip
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class EpinRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epin_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount_deposited','bank_name', 'transaction_id', 'name','slip','type', 'number_of_pin','phone_number'], 'required'],
            [['amount_deposited'], 'number'],
            [['type', 'number_of_pin', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['bank_name', 'transaction_id', 'name', 'package_for_each_pin', 'slip'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount_deposited' => 'Amount Deposited',
            'bank_name' => 'Bank Name',
            'type' => 'Type',
            'transaction_id' => 'Transaction ID',
            'name' => 'Name',
            'phone_number' => 'Phone Number',
            'number_of_pin' => 'Number Of Pin',
            'package_for_each_pin' => 'Package For Each Pin',
            'slip' => 'Slip',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
