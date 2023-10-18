<?php

namespace app\modules\users\controllers;

use Yii;
use yii\web\Controller;

class LogoutController extends Controller
{

    /**
     * Handles the application login functionality
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/');
        // return $this->goHome();
    }

}
