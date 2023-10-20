<?php
use yii\helpers\BaseUrl;
use yii\bootstrap5\Alert;
use yii\widgets\LinkPager;
?>

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
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1>Properties List </h1>
                <a href="<?= BaseUrl::base(); ?>/properties/create" class="btn btn-primary btn-sm">Add new Property</a>
            </div>

            <p><b>Total:</b> <?= $data[ 'count' ] ?> properties</p>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Property Name</th>
                    <th>Address</th>
                    <th>Area & Size</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                <?php 
                if( is_array( $properties ) && count( $properties ) > 0 ) :
                foreach( $properties as $property ) : ?>
                    <tr>
                        <td><?= $property->id; ?></td>
                        <td>
                            <?= $property->name; ?> -
                            <small><i><?= $property->type; ?></i></small>
                            <br/>
                            Bedrooms: <b><?= $property->beds; ?></b>
                            |
                            Bathrooms: <b><?= $property->baths; ?></b>
                        </td>
                        <td><?= $property->address; ?></td>
                        <td>
                            <?= $property->area; ?> 
                            <?= $property->area_type; ?>
                        </td>
                        <td><?= $property->price; ?> PKR</td>
                        <td>
                            <a href="<?= BaseUrl::base(); ?>/properties/edit?<?= http_build_query([ 'id' => $property->property_id ]) ?>" class="d-inline-block p-2 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="16" height="16"><path d="M18.656.93,6.464,13.122A4.966,4.966,0,0,0,5,16.657V18a1,1,0,0,0,1,1H7.343a4.966,4.966,0,0,0,3.535-1.464L23.07,5.344a3.125,3.125,0,0,0,0-4.414A3.194,3.194,0,0,0,18.656.93Zm3,3L9.464,16.122A3.02,3.02,0,0,1,7.343,17H7v-.343a3.02,3.02,0,0,1,.878-2.121L20.07,2.344a1.148,1.148,0,0,1,1.586,0A1.123,1.123,0,0,1,21.656,3.93Z"/><path d="M23,8.979a1,1,0,0,0-1,1V15H18a3,3,0,0,0-3,3v4H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2h9.042a1,1,0,0,0,0-2H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H16.343a4.968,4.968,0,0,0,3.536-1.464l2.656-2.658A4.968,4.968,0,0,0,24,16.343V9.979A1,1,0,0,0,23,8.979ZM18.465,21.122a2.975,2.975,0,0,1-1.465.8V18a1,1,0,0,1,1-1h3.925a3.016,3.016,0,0,1-.8,1.464Z"/></svg>
                            </a>
                            <a href="#" class="d-inline-block p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><g id="_01_align_center" data-name="01 align center"><path d="M22,4H17V2a2,2,0,0,0-2-2H9A2,2,0,0,0,7,2V4H2V6H4V21a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V6h2ZM9,2h6V4H9Zm9,19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V6H18Z"/><rect x="9" y="10" width="2" height="8"/><rect x="13" y="10" width="2" height="8"/></g></svg>
                            </a>
                        </td>
                    </tr>
                <?php
                endforeach; 
                else:
                ?>
                <tr>
                    <td colspan="5" class="text-center">No records found!</td>
                </tr>
                <?php endif; ?>
            </table>

        </div>
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



    </div>
</div>