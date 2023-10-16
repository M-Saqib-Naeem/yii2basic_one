<?php

namespace app\modules\users\controllers;

use yii\web\Controller;
use app\modules\users\models\User;

/**
 * Default controller for the `user` module
 */
class UserController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('/default/index');
    }

    public function actionUsersList() {
        $users = User::find()->where(['trash' => 0])->all();

        return $this->render('/default/list', [
            'users' => $users
        ]);
    }
}
