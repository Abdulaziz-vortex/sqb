<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m220422_131229_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'valuteId' => $this->string(255),
            'numCode' => $this->string(100),
            'charCode' => $this->string(10),
            'name' => $this->string(100),
            'value' => $this->float(),
            'date' => $this->dateTime()
        ]);

        $this->createIndex('currency_idx','currency',['valuteId','date']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('currency_idx','currency');
        $this->dropTable('{{%currency}}');
    }
}
