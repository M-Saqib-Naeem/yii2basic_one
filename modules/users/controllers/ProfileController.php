<?php

namespace app\modules\users\controllers;

use Yii;
use yii\web\Controller;
use app\modules\users\models\User;
use yii\web\UploadedFile;

class ProfileController extends Controller
{

    public function actionIndex()
    {
        $this->view->title = 'Profile page';
        $this->view->registerMetaTag( [
            'name' => 'description',
            'content' => 'This page is used to update the user profile. Only authenticated users can access it.'
        ] );

        $user = User::findOne( ['email_address' => Yii::$app->user->identity->email_address] );

        if( $user->load( Yii::$app->request->post() ) )  {

            $user->profile_image_val = UploadedFile::getInstance($user, 'profile_image');
            
            if ( ! $user->upload() ) {
                Yii::$app->session->setFlash( 'error', 'File upload error occurred.' );
                
                return $this->render('/default/profile', [
                    'user' => $user
                ]);
            }
            
            $user->profile_image = "{$user->profile_image_val->baseName}.{$user->profile_image_val->extension}";

            $user->save();
            
            Yii::$app->session->setFlash( 'success', 'Profile Updated Successfully' );
        }
        
        return $this->render('/default/profile', [
            'user' => $user
        ]);
    }


}
