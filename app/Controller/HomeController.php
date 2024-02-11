<?php
namespace App\Controller;
use Gaucho\Controller;
use App\Model\MessagesModel;
class HomeController extends Controller{
    function GET(){
        $MessagesModel=new MessagesModel();
        $messages=$MessagesModel->readAll();
        $data=[
            'title'=>$_ENV['SITE_NAME'],
            'messages'=>$messages,
            'RECAPTCHA_PUBLIC_KEY'=>$_ENV['RECAPTCHA_PUBLIC_KEY']
        ];
        $this->chaplin('inc/header',$data);
        $this->chaplin('home',$data);
        $this->chaplin('inc/footer',$data);
    }
    function POST(){
        $this->redirect($_ENV['SITE_URL']);
    }
}