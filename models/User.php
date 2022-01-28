<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Friends[] $friends
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Friends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFriends()
    {
        return $this->hasMany(Friends::className(), ['user_id' => 'id']);
    }

    //Implementation of IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($this->password, $password);
    }

    public function login()
    {
        $db_user = $this->findByEmail($this->email); //user databse record
        if($db_user && $this->validatePassword($db_user->password))
        {
            return Yii::$app->user->login($db_user);

        }else
        {
            return "Email or password incorrect";
            exit();
        }
        
    }
}
