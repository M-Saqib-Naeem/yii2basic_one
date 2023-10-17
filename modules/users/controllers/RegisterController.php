<?php

namespace app\modules\users\controllers;

use Yii;
use yii\web\Controller;
use app\modules\users\models\User;

class RegisterController extends Controller
{
    /**
     * Handle the user registration
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        
        $user = new User();
        
        if( $user->load( $request->post() ) && $user->validate() ) {
            if( ! $user->save() ) {
                return $this->redirect('register');
            }
            Yii::$app->session->setFlash('success', 'User created successfully!');
            return $this->redirect('site/index');
        }

        return $this->render('/default/register', [
            'user' => $user
        ]);
    }
}