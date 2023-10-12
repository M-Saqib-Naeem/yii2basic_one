<?php 
// use Yii\helpers\Html;
use yii\helpers\Html;

?>

<h1><?= Html::encode($title); ?></h1>
<h3><?=$title; ?></h3>
<ul>
    <?php
    if( isset( $products ) ) :

        foreach( $products as $key => $product ) :
            echo "<b>$key</b> $product";
            echo '<br/>';
        endforeach;
    endif;
    ?>
</ul>