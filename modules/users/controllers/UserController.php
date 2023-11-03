<?php

namespace app\modules\users\controllers;

use yii\web\Controller;
use app\modules\users\models\User;

/**
 * Default controller for the `user` module
 */
class UserController extends Controller
{
    public $layout = '/backend';
    
    public function actionIndex() {
        $users = User::find()->where(['trash' => 0])->all();

        return $this->render('/default/list', [
            'users' => $users
        ]);
    }
}
