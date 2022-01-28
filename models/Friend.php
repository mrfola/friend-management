<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "friends".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Users $user
 */
class Friend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name', 'email', 'phone_number', 'type'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'phone_number'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'email' => 'Email',
            'type' => 'Type',
            'phone_number' => 'Phone Number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
