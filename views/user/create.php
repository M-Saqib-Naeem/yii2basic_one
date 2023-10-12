<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Alert;

?>
<div class="row">
    <div class="col-md-4 mx-auto bg-secondary text-white p-5">

        <div class="mb-3 text-center">
            <h4 class="mb-0">Want to create a new account?</h4>
            <h1>Register Now</h1>
        </div>

        <?php 
        if( Yii::$app->session->hasFlash('success') ):
            echo Alert::widget([
                'options' => ['class' => 'alert-success'],
                'body' => Yii::$app->session->getFlash('success'),
            ]);
        endif;
        if( Yii::$app->session->hasFlash('error') ):
            echo Alert::widget([
                'options' => ['class' => 'alert-danger'],
                'body' => Yii::$app->session->getFlash('error'),
            ]);
        endif;
        ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($user, 'first_name'); ?>

        <?= $form->field($user, 'email_address')->input('email'); ?>

        <?= $form->field($user, 'password')->passwordInput(); ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            <a href="<?= yii\helpers\Url::base() ?>/login" class="text-white">Logn Now</a>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>