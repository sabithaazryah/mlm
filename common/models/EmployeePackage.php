<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_package".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $package_id
 * @property string $package_date
 */
class EmployeePackage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_package';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'package_id'], 'integer'],
            [['package_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'package_id' => 'Package ID',
            'package_date' => 'Package Date',
        ];
    }
}
