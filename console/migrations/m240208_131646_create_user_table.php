<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m240208_131646_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(256)->unique(),
            'username' => $this->string(256)->unique(),
            'password' => $this->string(256),
            'authKey' => $this->string(32),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this->insert('user',[
            'id'=> 1,
            'email' => 'test@mail.ru',
            'username'=>'someUser',
            'password' => Yii::$app->security->generatePasswordHash('Password123'),
            'authKey' => Yii::$app->security->generateRandomString(32),
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
