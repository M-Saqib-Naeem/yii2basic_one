<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;

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
        $request = Yii::$app->request;


        $title = "Hello, <b>welcome</b> to the basic <u>Yii App</u>";
        return $this->render('list', [
            'products' => [ 'product 1', 'product 2', 'product 3', 'request_url' => $request->url, 
            'absolute url' => $request->absoluteUrl,
            'host information' => $request->hostInfo,
            'path information' => $request->pathInfo,
            'query string' => $request->queryString,
            'base url' => $request->baseUrl,
            'script url' => $request->scriptUrl,
            'server name' => $request->serverName,
            'server Port' => $request->serverPort,
        ],
            'title' => $title
        ]);
    }

    /**
     * Store product entries
     */
    public function actionEntry() {

        $request = Yii::$app->request;

        $product = new Product;

        if( $product->load( Yii::$app->request->post() ) ) {

            $product->save();

            return $this->render( 'entry-confirm', [
                'products' => $product
            ] );
        }

        return $this->render( 'entry', [
            'products' => $product
        ] );
    }

    /**
     * Route: product/products-details > Product/Product-Details > ProductController/ProductDetails > ProductController/ActionProductDetails
     */
    public function actionProductDetails() {
        echo "This is product details";
    }

    public function actionProductDetailsWithId( $first = "Saqib", $last = "Naeem" ) {
        echo "This is product details $first $last";
    }

    // public function beforeAction( $action ) 
    // {
    //     echo "controller action example";
        
    //     return parent::beforeAction( $action );
    // }

}
