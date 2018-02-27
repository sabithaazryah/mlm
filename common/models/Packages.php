<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $name
 * @property string $amount
 * @property string $bv
 * @property string $ceiling
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Packages extends \yii\db\ActiveRecord {

        /**
         * {@inheritdoc}
         */
        public static function tableName() {
                return 'packages';
        }

        /**
         * {@inheritdoc}
         */
        public function rules() {
                return [
                        [['amount', 'bv', 'ceiling'], 'number'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['name'], 'string', 'max' => 200],
                        [['name', 'amount', 'bv', 'ceiling'], 'required']
                ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'name' => 'Name',
                    'amount' => 'Amount',
                    'bv' => 'Business Volume (BV)',
                    'ceiling' => 'Ceiling',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
