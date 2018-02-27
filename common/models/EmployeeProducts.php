<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_products".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $product_id
 * @property string $price
 * @property int $qty
 * @property string $total_amount
 * @property string $total_bv
 */
class EmployeeProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'product_id', 'qty'], 'integer'],
            [['price', 'total_amount', 'total_bv'], 'number'],
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
            'product_id' => 'Product ID',
            'price' => 'Price',
            'qty' => 'Qty',
            'total_amount' => 'Total Amount',
            'total_bv' => 'Total Bv',
        ];
    }
}
