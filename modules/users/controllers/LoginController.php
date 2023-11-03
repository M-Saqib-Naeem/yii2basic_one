<?php

namespace app\modules\users\controllers;

use Yii;
use yii\web\Controller;
use app\modules\users\models\User;

class LoginController extends Controller
{

    /**
     * Handles the application login functionality
     */
    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = new User();

        // echo "<pre>";
        // print_r(Yii::$app->request->post());
        // echo "</pre>";die;
        if ($user->load(Yii::$app->request->post()) && $user->login()) {
            return $this->redirect(['/site/index']);
        }
        return $this->render('/default/login', ['user' => $user]);    
    }

}
