<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends \yii\web\Controller
{

    /**
     * Handles the application login functionality
     */
    public function actionLogin() {
        

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = new User();

        if ($user->load(Yii::$app->request->post()) && $user->login()) {
            return $this->goHome();
        }
        return $this->render('login', ['user' => $user]);    
    }


    /**
     * Handle the user registration
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        
        $user = new User();
        
        if( $user->load( $request->post() ) && $user->validate() ) {
            if( ! $user->save() ) {
                return $this->redirect('register');
            }
            Yii::$app->session->setFlash('success', 'User created successfully!');
            return $this->goBack();
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
