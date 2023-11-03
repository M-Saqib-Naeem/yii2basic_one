<?php

namespace app\modules\dashboard\controllers;

use yii\web\Controller;
use app\modules\properties\models\Property;
use app\modules\users\models\User;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends Controller
{
    public $layout = '/backend';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $users = User::find()->all();
        $properties = Property::find()->all();

        $propertiesPublished = Property::find()
            ->where([ 'status' => 1 ])
            ->all();

        $propertiesUnpublished = Property::find()
            ->where( 'status != 1'  )
            ->all();

        return $this->render('index', [
            'usersCount' => count( $users ),
            'propertiesCount' => count( $properties ),
            'propertiesPublished' => count( $propertiesPublished ),
            'propertiesUnpublished' => count( $propertiesUnpublished )
        ]);
    }
}
