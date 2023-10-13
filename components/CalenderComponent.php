<?php 
 
namespace app\components;

use yii\base\Component;
use yii\base\ErrorException;

class CalenderComponent extends Component 
{
    public function add( $num1, $num2 )
    {
        try {
            // return $num1 + $num2;
            10/0;
        } catch (ErrorException  $e) {
            Yii::warning("Division by zero.");
        }
        // return $num1 + $num2;
    }

} 