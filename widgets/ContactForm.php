<?php
namespace app\widgets;
use Yii;
use yii\base\widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ContactForm as Contact;

class ContactForm extends widget
{

    public $contact;
    public function run()
    {
        
        $contact = new Contact();
        if( $contact->load( Yii::$app->request->post() ) ) {
            if( ! $contact->save() ) {
                Yii::$app->session->setFlash('error', 'Some Error!');
                Yii::$app->getResponse()->redirect('contact-us')->send();
                return;
                // return $this->redirect('contact-us');
            }
            Yii::$app->session->setFlash('success', 'Your enquiry has been generated successfully! We will get back to you soon if needed. Thank!');
            Yii::$app->getResponse()->redirect('contact-us')->send();
            return;

            // return $this->redirect('contact-us');
        }

        ob_start();
        $form = ActiveForm::begin();

        echo $form->field( $contact, 'name' );
        echo $form->field( $contact, 'email' )->input('email');
        echo $form->field( $contact, 'subject' );
        echo $form->field( $contact, 'body' );

        echo Html::submitButton( 'Submit Form', [ 'class' => 'btn btn-primary' ] );

        ActiveForm::end();

        return ob_get_clean();
    }
}