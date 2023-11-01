<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseUrl;
?>
<div class="user-profile-update">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-6">
            <?= $form->field( $user, 'full_name' ); ?>
        </div>
        <div class="col-6">
            <?= $form->field( $user, 'email_address' )->input( 'email', [
                'disabled' => true,
                'class' => 'form-control disabled'
            ] ); ?>
        </div>
    </div>            
    
    <div class="row">
        <div class="col-6">
            <?= $form->field( $user, 'gender' )->radioList([
                '1' => 'Male',
                '0' => 'Female',
            ]); ?>
        </div>
        <div class="col-6">
            <?php
            $age = [];
            for( $i = 18; $i <= 45; $i++ ){
                $age[$i] = $i;
            }
            ?>
            <?= $form->field( $user, 'age')->dropDownList( $age ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="hidden" name="User[profile_image_old]" value="<?= $user->profile_image; ?>">
            <?= $form->field( $user, 'profile_image' )->fileInput(); ?>

            <?php if( ! empty( $user->profile_image ) ): ?>
                <img src="<?= BaseUrl::base()."/".$user->dir."/".$user->profile_image; ?>" alt="" class="w-25 mb-5">
            <?php endif; ?>

        </div>
    </div>

    <?php // $form->field( $user, 'password' )->passwordInput(); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Update Profile', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>