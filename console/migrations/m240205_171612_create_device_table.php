<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%device}}`.
 */
class m240205_171612_create_device_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%device}}', [
            'id' => $this->primaryKey(),
            'serial_number' => $this->string()->notNull()->unique(),
            'store_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
        ]);
        $this->addForeignKey('fk_device_store', 'device', 'store_id', 'store', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%device}}');
    }
}
