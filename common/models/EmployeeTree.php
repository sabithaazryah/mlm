<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_tree".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $left_child
 * @property string $right_child
 * @property string $total_left_bv
 * @property string $current_left_bv
 * @property string $total_right_bv
 * @property string $current_right_bv
 * @property string $commission
 */
class EmployeeTree extends \yii\db\ActiveRecord {

        /**
         * {@inheritdoc}
         */
        public static function tableName() {
                return 'employee_tree';
        }

        /**
         * {@inheritdoc}
         */
        public function rules() {
                return [
                        [['employee_id'], 'integer'],
                        [['left_child', 'right_child'], 'safe'],
                        [['total_left_bv', 'current_left_bv', 'total_right_bv', 'current_right_bv', 'wallet'], 'number'],
                ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'employee_id' => 'Employee ID',
                    'left_child' => 'Left Child',
                    'right_child' => 'Right Child',
                    'total_left_bv' => 'Total Left Bv',
                    'current_left_bv' => 'Current Left Bv',
                    'total_right_bv' => 'Total Right Bv',
                    'current_right_bv' => 'Current Right Bv',
                    'wallet' => 'Wallet',
                ];
        }

}
