<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div id="admin-properties-list" class="d-flex justify-content-between gap-3 ">
    <p><?= Html::encode($model->id) ?></p>
    <p>
        <?= $model->name; ?> -
        <small><i><?= $model->type; ?></i></small>
        <br/>
        Bedrooms: <b><?= $model->beds; ?></b>
        |
        Bathrooms: <b><?= $model->baths; ?></b>
    </p>
    <p><?= Html::encode($model->address) ?></p>
    <p>
        <?= Html::encode($model->area) ?> <?= Html::encode($model->area_type) ?>
    </p>

    <p><?= Html::encode($model->price) ?> PKR</p>
</div>