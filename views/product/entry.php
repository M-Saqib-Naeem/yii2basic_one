<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="row">
    <div class="col-6 mx-auto">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($products, 'product_name'); ?>

        <?= $form->field($products, 'product_sku'); ?>

        <?= $form->field($products, 'product_price'); ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
