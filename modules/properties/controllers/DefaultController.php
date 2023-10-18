<?php

namespace app\modules\properties\controllers;

use Yii;
use yii\web\Controller;
use app\modules\properties\models\Property;
use Ramsey\Uuid\Uuid;
use yii\helpers\Url;


/**
 * Default controller for the `properties` module
 */
class DefaultController extends Controller
{
    /**
     * 
     */
    public function actionIndex()
    {
        $properties = Property::find()->all();
        return $this->render('/default/list', [
            'properties' => $properties
        ]);
    }


    public function actionCreate()
    {
        $property = new Property();

        if( $property->load( Yii::$app->request->post() ) ) {
            $property->property_id = Uuid::uuid4()->toString();
            $property->save();
            Yii::$app->session->setFlash( 'success', 'Your property has been added successfully.' );

            $properties = Property::find()->all();
            return $this->render('/default/list', [
                'properties' => $properties,
            ]);    
        }
        return $this->render('/default/create', [
            'property' => $property,
            'button_title' => 'Add new Property'
        ]);
    }

    public function actionEdit( $id )
    {
        $property = Property::findOne( [ 'property_id' => $id ] );

        if( $property->load( Yii::$app->request->post() ) && $property->save() ) {
            Yii::$app->session->setFlash( 'success', 'Property information updated Successfully' );
        }

        return $this->render('/default/create', [
            'property' => $property,
            'button_title' => 'Update Property'
        ]);
    }

}
