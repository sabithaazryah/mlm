<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile_uploads".
 *
 * @property int $id
 * @property int $type 1->Photo,2->pancard,3->Bank Details,4->Kyc
 * @property int $proof_type 1>Aadhaar Card,2->License,3->voters id
 * @property string $photo
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class ProfileUploads extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'profile_uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['photo'], 'required', 'on' => 'create'],
            [['photo', 'proof_type'], 'required', 'on' => 'kycupload'],
            [['id', 'type', 'proof_type', 'status', 'CB', 'UB', 'customer_id'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['photo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'proof_type' => 'Proof Type',
            'photo' => 'Photo',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
