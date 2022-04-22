<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m220404_150605_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->integer(),
            'shop' => $this->integer(),
            'description' => $this->string(255),
            'created_at' => $this->dateTime()
        ]);

        $this->addForeignKey('shop_fk','products','shop','shops','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('shop_fk','products');

        $this->dropTable('products');

    }
}
