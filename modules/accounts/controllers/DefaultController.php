<?php

namespace app\modules\accounts\controllers;

use yii\web\Controller;

/**
 * Default controller for the `accounts` module
 * Module name: Account 
 */
class AccountController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo "something";
        return $this->render('index');
    }

    public function actionUserAccounts()
    {
        echo 'helloworld';
    }
}
