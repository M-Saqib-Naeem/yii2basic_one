<?php 
use yii\helpers\Html;
?>

<div class="row">

    <div class="col-6 mx-auto">
        <table class="table table-strapped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
            </tr>
            <tr>
                <td></td>
                <td><?= $products->product_name; ?></td>
                <td><?= $products->product_sku; ?></td>
                <td><?= $products->product_price; ?></td>
            </tr>
        </table>
    </div>
</div>