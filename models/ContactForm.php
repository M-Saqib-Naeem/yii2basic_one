<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends ActiveRecord
{
    // public $name;
    // public $email;
    // public $subject;
    // public $body;
    // public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name', 'email', 'subject', 'body'], 'string', 'max' => 255, 'min' => 5],
            ['email', 'email'],
        ];
    }

    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            // 'name' => 'Full Name *',
            // 'email' => 'Email Address *',
            // 'subject' => 'Subject *',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
