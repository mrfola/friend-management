<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%friends}}`.
 */
class m220127_062405_create_friends_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = 'friends';

        $this->createTable('friends', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'phone_number' => $this->string(100)->notNull(),
            'created_at' =>  $this->datetime()->defaultValue(Date('Y-m-d H:i:s')),
            'updated_at' =>  $this->datetime()->defaultValue(Date('Y-m-d H:i:s')),
        ]);

        //foreign key
        $this->addForeignKey ('FK_users_to_friend', $tableName, 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('friends');
    }
}
