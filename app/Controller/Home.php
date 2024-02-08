<?php
namespace App\Controller;
use Gaucho\Gaucho;
use App\Model\Messages as MessagesModel;
class Home extends Gaucho{
    function GET(){
        $MessagesModel=new MessagesModel();
        $messages=$MessagesModel->readAll();
        $data=[
            'title'=>$_ENV['SITE_NAME'],
            'messages'=>$messages
        ];
        $this->chaplin('inc/header',$data);
        $this->chaplin('home',$data);
        $this->chaplin('inc/footer',$data);
    }
}