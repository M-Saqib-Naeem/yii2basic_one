<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Alert;
use yii\helpers\BaseUrl;

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
        ?>
        <div class=" mb-5">
            <h1><?= $page_title; ?></h1>
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

                <div class="d-flex gap-4 border p-3">
                    <?php
                    if( ! empty( $property->property_images ) ): 
                        $property_images = unserialize( $property->property_images );

                        foreach( $property_images as $image ) : ?>

                        <img src="<?= BaseUrl::base()."/{$property->dir}/{$image}"; ?>" class="object-fit-cover" style="width: 100px; height: 100px;">
                        
                    <?php endforeach; endif; ?>

                </div>
            </div>
        </div>

    </div>

    
    <div class="d-grid">
            <?= Html::submitButton( $button_title, [ 'class' => 'btn btn-primary btn-lg btn-block' ] ); ?>
    </div>
</div>

<?php ActiveForm::end(); ?>