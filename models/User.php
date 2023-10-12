<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $email_address
 * @property string $password
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
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
        if ( parent::beforeSave($insert) ) {

            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);

            return true;
        }
        // return true;
    }

    public function fields()
    {
        return [
    
            // field name is "name", its value is defined by a PHP callback
            'password' => function () {
                return Yii::$app->getSecurity()->generatePasswordHash($this->password);
            },
        ];
    }
}
