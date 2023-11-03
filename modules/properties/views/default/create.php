<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Alert;
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-12">
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
        <div class=" mb-5">
            <h1>Create a new property </h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non eligendi fugiat adipisci voluptates ad rem quis maiores unde ipsum sequi.</p>
        </div>
    </div>
    <div class="col-8">

        <div class="row">

            <div class="col-4">
                <?= $form->field( $property, 'name' ); ?>
            </div>

            <div class="col-2">
                <?= 
                    $form->field( $property, 'type' )->dropdownList([
                        'House' => 'House', 
                        'Appartment' => 'Appartment',
                        'Shop' => 'Shop',
                    ],
                    ['prompt'=>'Select property type']
                    );
                ?>
            </div>

            <div class="col-6">
                <?= $form->field( $property, 'address' ); ?>
            </div>

        </div>

        <div class="row">

            <div class="col-6">
                <?= $form->field( $property, 'beds' )->input( 'number' ); ?>
            </div>

            <div class="col-6">
                <?= $form->field( $property, 'baths' )->input( 'number' ); ?>
            </div>

        </div>

        <div class="row">

            <div class="col-4">
                <?= $form->field( $property, 'area' )->input( 'number' ); ?>
            </div>

            <div class="col-4">
                <?= $form->field( $property, 'area_type' )->dropdownList([
                        'Kinal' => 'Kinal', 
                        'Marla' => 'Marla', 
                        'Sq.ft.' => 'Sq.ft.',
                    ],
                    ['prompt'=>'Select Area type']
                    );
                ?>
            </div>

            <div class="col-4">
                <?= $form->field( $property, 'purpose' )->DropdownList([
                    'Rent' => 'Rent',
                    'Sale' =>'Sale',
                ], [ 'prompt' => 'Select Purpose' ]) ?>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <?= $form->field( $property, 'price' )->input( 'number' ); ?>
                <?= $form->field( $property, 'description' )->textarea(); ?>
            </div>
        </div>

    </div>

    <div class="col-4">
        
        <div class="row">
            <div class="col-12">
                <?= $form->field( $property, 'property_images[]' )->fileInput( ['multiple' => true, 'accept' => 'image/*'] ); ?>
            </div>
        </div>

    </div>

    
    <div class="d-grid">
            <?= Html::submitButton( $button_title, [ 'class' => 'btn btn-primary btn-lg btn-block' ] ); ?>
    </div>
</div>

<?php ActiveForm::end(); ?>