<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $email_address
 * @property string $password
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'email_address', 'password'], 'required'],
            [['first_name', 'email_address', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Full Name',
            'email_address' => 'Email Address',
            'password' => 'Password',
        ];
    }

    public function beforeSave($insert)
    {
        /**
         * parent::beforeSave($insert) means save method called
         * else update method called
         */
        if ( parent::beforeSave($insert) ) 
        {
            if( $this->isNewRecord ) {

                $user = static::findOne( ['email_address' => $this->email_address] );

                if( ! is_null( $user ) ) {
                    return Yii::$app->session->setFlash('error', 'User already exist.');
                }

                $this->password = $this->passwordEncryption( $this->password );
            }

            return true;
        }
        return false;
    }

    /**
     * adterSave event triggeres immidiately after a record
     * is saved to the database. So we use the returned
     * ActiveRecord to login the user.
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        if ($insert) {

            return Yii::$app->user->login($this);
        } 
    }

    public static function findIdentity( $id ) 
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {}

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function login( )
    {

        $user = static::findOne( ['email_address' => $this->email_address] );
        
        if( is_null( $user ) ) 
        {
            return Yii::$app->session->setFlash('userAccountErrors', 'User not found.');
            
        }

        if( ! Yii::$app->getSecurity()->validatePassword($this->password, $user->password) )
        {
            return Yii::$app->session->setFlash('userAccountErrors', 'Invalid User.');
        }
        Yii::$app->user->login($user);
    }   

    private function passwordEncryption( $password )
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
