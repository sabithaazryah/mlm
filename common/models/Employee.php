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
 * @property string $user_name
 * @property string $password
 * @property string $distributor_name
 * @property int $placement
 * @property int $epin
 * @property string $referal_id
 * @property string $mobile_number
 * @property string $email
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
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
                        [['placement', 'epin', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['placement_name', 'user_name', 'distributor_name', 'email', 'display_name'], 'string', 'max' => 200],
                        [['placement_id', 'referal_id'], 'string', 'max' => 100],
                        [['password'], 'string', 'max' => 300],
                        [['mobile_number'], 'string', 'max' => 15],
                        [['user_name', 'password'], 'required', 'on' => 'login'],
                        [['password'], 'validatePassword', 'on' => 'login'],
                        [['email'], 'email'],
                        [['distributor_name', 'password', 'placement_id', 'mobile_number', 'epin'], 'required', 'on' => 'create'],
                        [['distributor_name', 'mobile_number',], 'required', 'on' => 'update'],
                        [['epin', 'mobile_number'], 'unique', 'on' => 'create'],
                        [['mobile_number'], 'unique', 'on' => 'update'],
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
                    'user_name' => 'User Name',
                    'password' => 'Password',
                    'distributor_name' => 'Distributor Name',
                    'placement' => 'Placement',
                    'epin' => 'Epin',
                    'referal_id' => 'Referal ID',
                    'mobile_number' => 'Mobile Number',
                    'email' => 'Email',
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
        public function getEmpname() {
                return $this->distributor_name . '( ' . $this->user_name . ' )';
        }

}
