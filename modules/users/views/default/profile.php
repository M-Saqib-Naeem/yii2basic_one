<?php
use yii\bootstrap5\Alert;
?>

<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <h3>Saqib, you can update your profile here</h3>
            <h1>Edit Profile</h1>
        </div>

        <?php 
        if( Yii::$app->session->hasFlash('success') ):
            echo Alert::widget([
                'options' => ['class' => 'alert-success'],
                'body' => Yii::$app->session->getFlash('success'),
            ]);
        endif;
        ?>

        <?= $this->render( '_update-profile-form', [
            'user' => $user
        ] ) ?>
    </div>
</div>