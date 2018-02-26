<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $country_flag
 * @property string $country_code
 * @property string $country_name
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Country extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['country_flag', 'country_code', 'country_name'], 'required', 'on' => 'create'],
            [['country_code', 'country_name'], 'required', 'on' => 'update'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['country_flag', 'country_code'], 'string', 'max' => 100],
            [['country_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'country_flag' => 'Country Flag',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
