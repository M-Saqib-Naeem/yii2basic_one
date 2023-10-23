<?php

namespace app\modules\properties\models;

use Yii;
use \yii\db\ActiveRecord;
use Ramsey\Uuid\Uuid;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $property_id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property string $address
 * @property string $beds
 * @property string $baths
 * @property string $area
 * @property string $area_type
 * @property string $price
 * @property string $purpose
 * @property string $created_at
 */
class Property extends ActiveRecord
{

    public $property_images_val;
    public $dir = 'uploads/properties';
    /**
     * Registering a table name
     */
    public static function tableName()
    {
        return '{{%properties}}';
    }

    /**
     * Registering the validation rules
     */
    public function rules()
    {
        return [
            [['name', 'type', 'description', 'price' ], 'required'],
            [['address', 'beds', 'baths', 'area', 'area_type', 'purpose'], 'string', 'min' => 1, 'max' => 255],
            [['property_images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4 ]
        ];
    }

    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'name' => 'Name / Title of the property',
            'address' => 'Complete address',
            'baths' => 'Number of Bathrooms',
            'beds' => 'Number of Bedrooms',
        ];
    }

    public function upload()
    {
        if ($this->validate()) { 
            foreach ( $this->property_images_val as $file ) {
                $file->saveAs( "{$this->dir}/{$file->baseName}.$file->extension" );
            }
            return true;
        } else {
            return false;
        }
    }
    

}
