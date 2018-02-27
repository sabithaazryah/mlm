<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank_details".
 *
 * @property int $id
 * @property string $bank_name
 * @property string $branch_name
 * @property string $account_no
 * @property string $ifsc_code
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class BankDetails extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'bank_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['bank_name', 'branch_name', 'account_no', 'ifsc_code'], 'required'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['bank_name', 'branch_name', 'account_no', 'ifsc_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'bank_name' => 'Bank Name',
            'branch_name' => 'Branch Name',
            'account_no' => 'Account No',
            'ifsc_code' => 'Ifsc Code',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
