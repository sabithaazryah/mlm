<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_details".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $father_name
 * @property string $dob
 * @property int $gender
 * @property int $pincode
 * @property string $post_office
 * @property int $state
 * @property string $city
 * @property string $house_name
 * @property string $taluk
 * @property string $address
 * @property string $nominee_name
 * @property int $nominee_relation
 * @property string $ifsc_code
 * @property string $account_no
 * @property string $bank_name
 * @property string $branch
 * @property string $pan_number
 * @property int $prefered_dispatch
 * @property string $selected_price
 * @property int $terms_conditions
 * @property int $language_terms
 */
class EmployeeDetails extends \yii\db\ActiveRecord {

        /**
         * {@inheritdoc}
         */
        public static function tableName() {
                return 'employee_details';
        }

        /**
         * {@inheritdoc}
         */
        public function rules() {
                return [
                        [['employee_id', 'gender', 'pincode', 'state', 'nominee_relation', 'prefered_dispatch', 'terms_conditions', 'language_terms'], 'integer'],
                        [['dob'], 'safe'],
                        [['address'], 'string'],
                        [['selected_price'], 'number'],
                        [['pan_number'], 'unique'],
                        [['father_name', 'post_office', 'city', 'house_name', 'taluk', 'nominee_name', 'ifsc_code', 'account_no', 'bank_name', 'branch', 'pan_number'], 'string', 'max' => 200],
                        [['pincode', 'state', 'city', 'house_name'], 'required', 'on' => 'create']
                ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'employee_id' => 'Employee ID',
                    'father_name' => 'Father Name',
                    'dob' => 'Dob',
                    'gender' => 'Gender',
                    'pincode' => 'Pincode',
                    'post_office' => 'Post Office',
                    'state' => 'State',
                    'city' => 'City',
                    'house_name' => 'House Name',
                    'taluk' => 'Taluk',
                    'address' => 'Address',
                    'nominee_name' => 'Nominee Name',
                    'nominee_relation' => 'Nominee Relation',
                    'ifsc_code' => 'Ifsc Code',
                    'account_no' => 'Account No',
                    'bank_name' => 'Bank Name',
                    'branch' => 'Branch',
                    'pan_number' => 'Pan Number',
                    'prefered_dispatch' => 'Prefered Dispatch',
                    'selected_price' => 'Selected Price',
                    'terms_conditions' => 'Terms Conditions',
                    'language_terms' => 'Language Terms',
                ];
        }

}
