<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Create new User</h1>


<div class="row">
    <div class="col-md-4 mx-auto bg-secondary text-white p-5">

        <h3 class="mb-3">Register your account</h3>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($user, 'first_name'); ?>

        <?= $form->field($user, 'email_address')->input('email'); ?>

        <?= $form->field($user, 'password')->passwordInput(); ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>