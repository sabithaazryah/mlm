<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $product_name
 * @property int $canonical_name
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
                        [['product_name', 'canonical_name', 'photo', 'price'], 'required'],
                        [['canonical_name', 'status', 'CB', 'UB'], 'integer'],
                        [['price', 'bv'], 'number'],
                        [['DOC', 'DOU'], 'safe'],
                        [['photo', 'field1', 'product_name',], 'string', 'max' => 100],
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
                    'bv' => 'BV',
                    'photo' => 'Product Image',
                    'field1' => 'Field1',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
