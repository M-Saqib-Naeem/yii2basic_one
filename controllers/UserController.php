<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $request = Yii::$app->request;
        
        $user = new User();
        
        if( $user->load( $request->post() && $user->validate() ) ) {
            $user->save();
            $user->login();
            return $this->goHome();
            // Yii::$app->session->setFlash('contactFormSubmitted');
            // return $this->render( 'create', [
            //     'user' => $user
            // ] );
        }

        return $this->render('create', [
            'user' => $user
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
