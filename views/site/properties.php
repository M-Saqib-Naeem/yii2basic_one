<?php
use yii\helpers\BaseUrl;
use yii\widgets\LinkPager;
?>

<div class="row">
    
    <?php if( count( $properties ) > 0 ): ?>
        <?php foreach( $properties as $property ): ?>
            <div class="col-3 my-3">

                <div class="card" style="width: 18rem;">

                    <?php if( ! empty( $property->property_images ) && unserialize( $property->property_images ) ):
                        $property_images = unserialize( $property->property_images );
                        $first_image = $property_images[0];
                        $images_count = count( $property_images );
                    ?>
                        <img src="<?= BaseUrl::base()."/".$property->dir."/".$first_image; ?>" class="property-list-img card-img-top" alt="...">
                    <?php else: ?>
                        <img src="<?= BaseUrl::base()."/".$property->dir."/placeholder.png"; ?>" class="property-list-img card-img-top" alt="...">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= $property->name ?></h5>
                        <p class="card-text mb-0"><b>Bedrooms: </b><?=$property->beds ?></p>
                        <p class="card-text mb-0"><b>Bathrooms: </b><?=$property->baths ?></p>
                        <p class="card-text"><b>Area: </b><?=$property->area ?> <?=$property->area_type ?></p>
                        <a href="<?= BaseUrl::base()."/site/property/?".http_build_query(['id' => $property->id]); ?>" class="btn btn-success btn-sm">View Details</a>
                    </div>

                </div>  

            </div>
            <?php endforeach; ?>


            <nav class="Page navigation example">

                <?php
                echo LinkPager::widget([
                    'pagination' => $pagination,
                    // 'pageCssClass' => 'page-item',
                    'linkContainerOptions' => [
                        'class' => 'page-item'
                    ],
                    'linkOptions' => [
                        'class' => 'page-link'
                    ],
                    'disabledPageCssClass' => 'page-item',
                    'disabledListItemSubTagOptions' => [
                        'class' => 'page-link'
                    ]
                ]);
                ?>

            </nav>
        <?php endif; ?>
</div>