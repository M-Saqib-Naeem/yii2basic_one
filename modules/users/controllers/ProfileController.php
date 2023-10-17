<?php

namespace app\modules\users\controllers;

use Yii;
use yii\web\Controller;
use app\modules\users\models\User;

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

        if( $user->load( Yii::$app->request->post() ) && $user->save() )  {
            Yii::$app->session->setFlash( 'success', 'Profile Updated Successfully' );
        }
        
        return $this->render('/default/profile', [
            'user' => $user
        ]);
    }


}
