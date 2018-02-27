<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $placement_name
 * @property string $placement_id
 * @property string $distributor_name
 * @property int $placement
 * @property int $epin
 * @property string $epin_number
 * @property string $pin_price
 * @property int $bv
 * @property int $referal_id
 * @property string $father_name
 * @property string $dob
 * @property int $gender
 * @property string $mobile_number
 * @property int $pincode
 * @property string $post_office
 * @property int $state
 * @property string $city
 * @property string $house_name
 * @property string $taluk
 * @property string $address
 * @property string $email
 * @property string $nominee_name
 * @property int $nominee_relation
 * @property string $ifsc_code
 * @property string $account_no
 * @property string $bank_name
 * @property string $branch
 * @property string $pan_number
 * @property string $password
 * @property string $user_name
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property int $DOC
 * @property int $DOU
 */
class Employee extends ActiveRecord implements IdentityInterface {

        private $_user;
        public $rememberMe = true;
        public $created_at;
        public $updated_at;

        /**
         * {@inheritdoc}
         */
        public static function tableName() {
                return 'employee';
        }

        /**
         * {@inheritdoc}
         */
        public function rules() {
                return [
                        [['placement', 'epin', 'bv', 'referal_id', 'gender', 'pincode', 'state', 'nominee_relation', 'status', 'CB', 'UB', 'prefered_dispatch', 'terms_conditions', 'language_terms'], 'integer'],
                        [['pin_price', 'selected_price'], 'number'],
                        [['dob'], 'safe'],
                        [['DOC', 'DOU'], 'safe'],
                        [['address'], 'string'],
                        [['placement_name', 'distributor_name', 'epin_number', 'father_name', 'post_office', 'taluk', 'email', 'nominee_name', 'ifsc_code', 'account_no', 'bank_name', 'branch', 'pan_number', 'user_name'], 'string', 'max' => 200],
                        [['placement_id', 'city', 'house_name'], 'string', 'max' => 100],
                        [['mobile_number'], 'string', 'max' => 15],
                        [['password'], 'string', 'max' => 300],
                        [['user_name', 'password'], 'required', 'on' => 'login'],
                        [['password'], 'validatePassword', 'on' => 'login'],
                        // [['distributor_name'], 'required'],
                ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'placement_name' => 'Placement Name',
                    'placement_id' => 'Placement ID',
                    'distributor_name' => 'Distributor Name',
                    'placement' => 'Placement',
                    'epin' => 'Epin',
                    'epin_number' => 'Epin Number',
                    'pin_price' => 'Pin Price',
                    'bv' => 'Bv',
                    'referal_id' => 'Referal ID',
                    'father_name' => 'Father Name',
                    'dob' => 'Dob',
                    'gender' => 'Gender',
                    'mobile_number' => 'Mobile Number',
                    'pincode' => 'Pincode',
                    'post_office' => 'Post Office',
                    'state' => 'State',
                    'city' => 'City',
                    'house_name' => 'House Name',
                    'taluk' => 'Taluk',
                    'address' => 'Address',
                    'email' => 'Email',
                    'nominee_name' => 'Nominee Name',
                    'nominee_relation' => 'Nominee Relation',
                    'ifsc_code' => 'IFSC Code',
                    'account_no' => 'Account No',
                    'bank_name' => 'Bank Name',
                    'branch' => 'Branch',
                    'pan_number' => 'Pan Number',
                    'password' => 'Password',
                    'user_name' => 'User Name',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public function validatePassword($attribute, $params) {

                if (!$this->hasErrors()) {

                        $user = $this->getUser();
                        if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password)) {
                                $this->addError($attribute, 'Incorrect username or password.');
                        }
                }
        }

        public function login() {
                if ($this->validate()) {
                        return Yii::$app->user->login($this->getUser(), /* $this->rememberMe ? 3600 * 24 * 30 : */ 0);
                } else {
                        return false;
                }
        }

        public function loginn() {

                //   $user = static::find()->where('post_id = :post and status = :stat', ['post' => 1, 'stat' => '1'])->one();

                $this->_user = static::find()->where('user_name = :uname and status = :stat', ['uname' => $user->user_name, 'stat' => '1'])->one();

                return Yii::$app->user->login($this->getUser(), /* $this->rememberMe ? 3600 * 24 * 30 : */ 0);
        }

        protected function getUser() {
                if ($this->_user === null) {
                        $this->_user = static::find()->where('user_name = :uname and status = :stat', ['uname' => $this->user_name, 'stat' => '1'])->one();
                }

                return $this->_user;
        }

        public function validatedata($data) {
                if ($data == '') {
                        $this->addError('password', 'Incorrect username or password');
                        return true;
                }
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
        public static function findByUsername($username) {
                return static::findOne(['user_name' => $username, 'status' => 1]);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentity($id) {
                return static::findOne(['id' => $id, 'status' => 1]);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentityByAccessToken($token, $type = null) {
                throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }

        public function getId() {
                return $this->getPrimaryKey();
        }

        /**
         * @inheritdoc
         */
        public function getAuthKey() {
                return $this->auth_key;
        }

        /**
         * @inheritdoc
         */
        public function validateAuthKey($authKey) {
                return $this->getAuthKey() === $authKey;
        }

        /**
         * @return \yii\db\ActiveQuery
         */
}
