<?php
namespace App\Controller;
use Gaucho\Controller;
use App\Model\MessagesModel;
class MessagesController extends Controller{
    function GET(){
        $MessagesModel=new MessagesModel();
        $id=$this->dir(2);
        $message=$MessagesModel->readById($id);
        $data=[
            'message'=>$message,
            'title'=>$message['message']
        ];
        $this->chaplin('inc/header',$data);
        $this->chaplin('message',$data);
        $this->chaplin('inc/footer',$data);
    }
    function POST(){
        $MessagesModel=new MessagesModel();
        $message=[
            'message'=>$_POST['message']
        ];
        $id=$MessagesModel->create($message);
        $url=$_ENV['SITE_URL'].'/messages/'.$id;
        $this->redirect($url);
    }
}