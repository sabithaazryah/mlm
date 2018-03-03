<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "otp_request".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $otp
 * @property string $date
 */
class OtpRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otp_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['date'], 'safe'],
            [['otp'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'otp' => 'Otp',
            'date' => 'Date',
        ];
    }
}
