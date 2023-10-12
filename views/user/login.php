<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Alert;
?>

<section class="row">
    <div class="col-4 mx-auto  bg-secondary text-white p-5">
        <div class="mb-3 text-center">
            <h4 class="mb-0">Have an account?</h4>
            <h1>Login</h1>
        </div>

        <?php 
        if( Yii::$app->session->hasFlash('userAccountErrors') ):
            echo Alert::widget([
                'options' => ['class' => 'alert-danger'],
                'body' => Yii::$app->session->getFlash('userAccountErrors'),
            ]);
        endif;
        ?>

        <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field( $user, 'email_address' )->input('email');  ?>
        <?= $form->field( $user, 'password' )->passwordInput();  ?>
        
        <div class="form-group">
            <?= Html::submitButton( 'Login', [ 'class' => 'btn btn-primary' ] ); ?>
            <a href="<?= yii\helpers\Url::base() ?>/register" class="text-white">Register an account</a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>