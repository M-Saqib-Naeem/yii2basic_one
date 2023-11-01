<?php
use yii\helpers\BaseUrl;
?>

<div class="row">
    <div class="col-8 offset-2">

        <!-- Image -->
        <div class="d-flex gap-2 flex-row property-detail-images-group">
            <?php if( ! empty( $property->property_images ) && unserialize( $property->property_images ) ){
                $property_images = unserialize( $property->property_images );
                $images_count = count( $property_images );
            ?>
                <?php if( $images_count === 3 ): ?>
                        <?php 
                            $property_images = array_reverse( $property_images );
                            $first_elem = array_pop( $property_images );
                        ?>
                        <img src="<?= BaseUrl::base()."/".$property->dir."/".$first_elem; ?>" class="property-detail-img card-img-top" alt="...">

                        <div class="d-flex gap-2 flex-column property-detail-imgs">
                            
                            <?php foreach( $property_images as $image ): ?> 
                                <img src="<?= BaseUrl::base()."/".$property->dir."/".$image; ?>" class="card-img-top" alt="...">
                            <?php endforeach; ?>

                        </div>
                    <?php  ?>

                <?php endif; ?>

                <?php if( $images_count === 2 ): ?>
                    <div class="container">
                        <div class="row">
                    <?php foreach( $property_images as $image ): ?> 
                        <div class="col-6">
                            <img src="<?= BaseUrl::base()."/".$property->dir."/".$image; ?>" class="card-img-top" style="height: 400px;" alt="...">
                        </div>
                    <?php endforeach; ?>
                        </div>
                    </div>

                <?php endif; ?>

            <?php }else{ ?>
                <img src="<?= BaseUrl::base()."/".$property->dir."/placeholder.png"; ?>" class="property-detail-img card-img-top" alt="...">
            <?php } ?>
        </div>

        <div class="my-3 mb-5">
            <h4 class="mb-5"><u><?= $property->name ?></u>&nbsp;  <i><small>(<?= $property->type ?>)</small></i> </h4>

            <div class="container">

                <div class="row">
                    <div class="col">
                        <p><b>Bedrooms: </b><?= $property->beds ?></p>
                    </div>
                    <div class="col">
                        <p><b>bathrooms: </b><?= $property->baths ?></p>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col">
                        <p><b>Area: </b><?= $property->area . ' ' . $property->area_type ?></p>
                    </div>
                    <div class="col">
                        <p><b>Available for: </b><?= $property->purpose ?></p>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col">
                        <p><b>Address: </b><?= $property->address ?></p>
                    </div>
                    <div class="col">
                        <p><b>Price: </b>$<?= $property->price ?></p>
                    </div>
                </div>

            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Details</h5>
                    <?= $property->description ?>
                </div>
            </div>
        </div>

    </div>
</div>