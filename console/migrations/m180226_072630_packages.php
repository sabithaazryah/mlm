<?php

use yii\db\Migration;

/**
 * Class m180226_072630_packages
 */
class m180226_072630_packages extends Migration {

        /**
         * {@inheritdoc}
         */
        public function safeUp() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%packages}}', [
                    'id' => $this->primaryKey(),
                    'name' => $this->string(200),
                    'amount' => $this->decimal(10, 2),
                    'bv' => $this->decimal(10, 2),
                    'ceiling' => $this->decimal(10, 2),
                    'status' => $this->integer(),
                    'CB' => $this->integer(),
                    'UB' => $this->integer(),
                    'DOC' => $this->date(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown() {
                echo "m180226_072630_packages cannot be reverted.\n";

                return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m180226_072630_packages cannot be reverted.\n";

          return false;
          }
         */
}
