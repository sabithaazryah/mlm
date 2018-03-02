<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "epin_transfer".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $epin
 * @property string $member_id
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class EpinTransfer extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'epin_transfer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['epin', 'member_id'], 'required'],
            [['customer_id', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['epin', 'member_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'epin' => 'Epin',
            'member_id' => 'Member ID',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
