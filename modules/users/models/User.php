<?php

namespace app\modules\users\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $full_name
 * @property string $email_address
 * @property string $password
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }


}
