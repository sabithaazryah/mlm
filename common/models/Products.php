<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $product_name
 * @property string $canonical_name
 * @property string $price
 * @property string $bv
 * @property string $photo
 * @property string $field1
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Products extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['product_name', 'canonical_name', 'photo', 'price'], 'required', 'on' => 'create'],
            [['product_name', 'canonical_name', 'price'], 'required', 'on' => 'update'],
            [['price', 'bv'], 'number'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['product_name', 'canonical_name', 'photo', 'field1'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'canonical_name' => 'Canonical Name',
            'price' => 'Price',
            'bv' => 'Bv',
            'photo' => 'Photo',
            'field1' => 'Field1',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
