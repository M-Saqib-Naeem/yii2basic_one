<?php

namespace app\modules\properties\controllers;

use Yii;
use yii\web\Controller;
use app\modules\properties\models\Property;
use Ramsey\Uuid\Uuid;
use yii\helpers\Url;
use yii\data\Pagination;
// use yii\data\ActiveDataProvider;



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
        $pagination_helper = $this->pagination_helper();
        return $this->render('/default/list', [
            'properties' => $pagination_helper['properties'],
            'pagination' => $pagination_helper['pagination'],
            'data' => [
                'count' => $pagination_helper['count'],
            ]
        ]);
    }


    public function actionCreate()
    {
        $property = new Property();

        if( $property->load( Yii::$app->request->post() ) ) {
            $property->property_id = Uuid::uuid4()->toString();
            $property->user_id = Yii::$app->user->identity->id;
            $property->save();
            Yii::$app->session->setFlash( 'success', 'Your property has been added successfully.' );

            $pagination_helper = $this->pagination_helper();

            return $this->render('/default/list', [
                'properties' => $pagination_helper['properties'],
                'pagination' => $pagination_helper['pagination'],
                'data' => [
                    'count' => $pagination_helper['count'],
                ]
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

    /**
     * 
     */
    private function pagination_helper()
    {
        $user_id = Yii::$app->user->identity->id;
        $role = Yii::$app->user->identity->role;
        if( $role == 1 ) {
            $properties = Property::find();
        }else{
            $properties = Property::find()->where(['user_id' => $user_id]);
        }
        
        $count = $properties->count();
        $pagination = new Pagination(['totalCount' => $count]);

        $properties = $properties->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return [
            'properties' =>  $properties,
            'pagination' => $pagination,
            'count' => $count
        ];
    }
}
