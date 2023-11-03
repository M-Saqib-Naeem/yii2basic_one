<?php 
use yii\helpers\BaseUrl;
?>

<div class="row">
    <div class="col-3">

        <div id="user-widget" class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h5 class="fs-5">Registered Users</h5>
                        <h1 class="fs-1 text-success"><?= $usersCount ?> </h1>  
                    </div>
                    <p class="text-right">
                        <a href="<?= BaseUrl::base() ?>/users/list" class="btn btn-success btn-sm">View Users</a>
                    </p>
                </div>
            </div>
            
        </div>

    </div>
    <div class="col-3">

        <div id="user-widget" class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h5 class="fs-5">Total Properties</h5>
                        <h1 class="fs-1 text-info"><?= $propertiesCount ?> </h1>  
                    </div>
                    <p class="text-right">
                        <a href="<?= BaseUrl::base() ?>/properties/list" class="btn btn-info btn-sm">View Properties</a>
                    </p>
                </div>
            </div>
            
        </div>

    </div>
    <div class="col-3">

        <div id="user-widget" class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h5 class="fs-5">Published</h5>
                        <h1 class="fs-1 text-secondary"><?= $propertiesPublished ?> </h1>  
                    </div>
                    <p class="text-right">
                        <a href="<?= BaseUrl::base() ?>/properties/list" class="btn btn-secondary btn-sm">View Properties</a>
                    </p>
                </div>
            </div>
            
        </div>

    </div>
    <div class="col-3">

        <div id="user-widget" class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h5 class="fs-5">Pending</h5>
                        <h1 class="fs-1 text-danger"><?= $propertiesUnpublished ?> </h1>  
                    </div>
                    <p class="text-right">
                        <a href="<?= BaseUrl::base() ?>/properties/list" class="btn btn-danger btn-sm">View Properties</a>
                    </p>
                </div>
            </div>
            
        </div>

    </div>
</div>