<?php

namespace app\modules\users\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
use yii\web\UploadedFile;
/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $full_name
 * @property string $email_address
 * @property string $gender
 * @property string $age
 * @property string $role
 * @property string $password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $profile_image_val;
    public $dir = 'uploads/avatars';
    /**
     * Registering a table name
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * Registering the validation rules
     */
    public function rules()
    {
        return [
            [['full_name', 'email_address', 'gender', 'age', 'password'], 'required'],
            [['full_name', 'email_address'], 'string', 'max' => 255],
            [['profile_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'email_address' => 'Email Address',
            'password' => 'Password',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $this->profile_image_val->saveAs("{$this->dir}/{$this->profile_image_val->baseName}.{$this->profile_image_val->extension}");

            return true;
        } else {
            return false;
        }
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
            Yii::$app->user->login($this);
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
        return Yii::$app->user->login($user);
    }

    private function passwordEncryption( $password )
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
