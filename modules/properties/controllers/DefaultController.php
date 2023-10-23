<?php

namespace app\modules\properties\controllers;

use Yii;
use yii\web\Controller;
use app\modules\properties\models\Property;
use Ramsey\Uuid\Uuid;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\data\Pagination;
// use yii\data\ActiveDataProvider;
use app\models\UploadForm;
use yii\web\UploadedFile;



/**
 * Default controller for the `properties` module
 */
class DefaultController extends Controller
{
    public $layout = '/backend';

    public $btnTitle = [
        'create' => 'Add New Property',
        'edit' => 'Update Property'
    ];

    public $pageTitle = [
        'create' => 'Create New Property',
        'edit' => 'Edit Property'
    ];

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

        if( $property->load( Yii::$app->request->post() ) ) 
        {
            $property->property_id = Uuid::uuid4()->toString();
            $property->user_id = Yii::$app->user->identity->id;

            $property->property_images_val = UploadedFile::getInstances( $property, 'property_images' );

            if ( ! $property->upload() ) 
            {
                Yii::$app->session->setFlash( 'error', 'File upload error occurred.' );
                
                return $this->render('/default/create', [
                    'property' => $property,
                    'page_title' => $this->pageTitle['create'],
                    'button_title' => $this->btnTitle['create'],
                ]);
            }

            $property_images = [];
            if( is_array( $property->property_images_val ) ) {
                foreach( $property->property_images_val as $each ) {
                    $property_images[] = "{$each->baseName}.{$each->extension}";
                }
                $property->property_images = serialize( $property_images );
            }


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
            'page_title' => $this->pageTitle['create'],
            'button_title' => $this->btnTitle['create'],
        ]);
    }

    public function actionEdit( $id )
    {
        $property = Property::findOne( [ 'property_id' => $id ] );

        if( $property->load( Yii::$app->request->post() ) && $property->save() ) {
            Yii::$app->session->setFlash( 'success', 'Property information updated Successfully' );
        }

        return $this->render('/default/edit', [
            'property' => $property,
            'page_title' => $this->pageTitle['edit'],
            'button_title' => $this->btnTitle['edit'],
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
            $properties = Property::find()
                ->orderBy(['id' => SORT_DESC]);
        }else{
            $properties = Property::find()->where(['user_id' => $user_id])
            ->orderBy(['id' => SORT_DESC]);
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

    /**
     * Delete a record
     */

    public function actionDestroy() {
        
        if( ! Yii::$app->request->isPost ) 
            return $this->redirect( BaseUrl::base() ."/properties/list");
        
        $pid = (int) Yii::$app->request->post('pid');

        if( ! is_numeric( $pid ) ) 
            return $this->redirect( BaseUrl::base() ."/properties/list");
        
        $property = Property::findOne($pid);
        $property->delete();

        Yii::$app->session->setFlash( 'success', 'Record Deleted Successfully' );
        return $this->redirect( BaseUrl::base() ."/properties/list");

    }
}
