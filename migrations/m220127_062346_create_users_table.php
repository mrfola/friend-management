<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220127_062346_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'password' => $this->string(100)->notNull(),
            'auth_key' => $this->text(),
            'created_at' => $this->datetime()->defaultValue(Date('Y-m-d H:i:s')),
            'updated_at' => $this->datetime()->defaultValue(Date('Y-m-d H:i:s'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
