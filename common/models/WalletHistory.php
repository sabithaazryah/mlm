<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wallet_history".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $match_bv
 * @property string $previous_wallet_amount
 * @property string $current_wallet_amount
 * @property string $date
 */
class WalletHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id'], 'integer'],
            [['match_bv', 'previous_wallet_amount', 'current_wallet_amount'], 'number'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'match_bv' => 'Match Bv',
            'previous_wallet_amount' => 'Previous Wallet Amount',
            'current_wallet_amount' => 'Current Wallet Amount',
            'date' => 'Date',
        ];
    }
}
