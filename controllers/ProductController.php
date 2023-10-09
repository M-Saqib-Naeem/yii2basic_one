<?php

namespace app\controllers;

use yii\web\Controller;

// Route: product > Product > ProductController > app\controllers\ProductController
class ProductController extends Controller
{
    /**
     * Change the default action to custom defualt.
     * By default its set to index method
     */
    public $defaultAction = "route-name";


    // Route: product/index > Product/Index > ProductController/ActionIndex
    public function actionIndex() {
        $title = "saa";
        return $this->render('index');
    }

    // Route: product/products > Product/Products > ProductController/ActionProducts
    public function actionProducts() {
        echo "Hello WOrld";
    }

    // Route: product/products-details > Product/Product-Details > ProductController/ProductDetails > ProductController/ActionProductDetails
    public function actionProductDetails() {
        echo "This is product details";
    }

    public function actionProductDetailsWithId( $first = "Saqib", $last = "Naeem" ) {
        echo "This is product details $first $last";
    }
}
