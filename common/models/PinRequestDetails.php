<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pin_request_details".
 *
 * @property int $id
 * @property int $master_id
 * @property int $parent_id
 * @property int $package_id
 * @property string $epin
 * @property int $status 0->pending,1->approve,2->reject
 * @property int $epin_status 0->not used,1->used,
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class PinRequestDetails extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'pin_request_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['master_id', 'parent_id', 'package_id', 'status', 'epin_status', 'CB', 'UB', 'transer_id'], 'integer'],
            [['DOC', 'DOU','approved_date'], 'safe'],
            [['epin'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'parent_id' => 'Parent ID',
            'package_id' => 'Package Name',
            'epin' => 'Epin',
            'status' => 'Status',
            'epin_status' => 'Epin Status',
            'transer_id' => 'Transer ID',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'approved_date' => 'Approved Date',
        ];
    }

}
