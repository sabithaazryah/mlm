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
                    //  [['left_child', 'right_child'], 'required'],
                    [['left_child', 'right_child'], 'safe'],
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
                ];
        }

}
