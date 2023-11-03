<?php
use app\widgets\ContactForm;
use yii\bootstrap5\Alert;
?>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <h4 class="mb-0">For any information & query</h4>
            <h1>Contact us</h1>

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

            <?= ContactForm::widget([]); ?>
        </div>
    </div>
</div>