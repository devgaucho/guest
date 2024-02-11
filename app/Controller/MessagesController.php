<?php
namespace App\Controller;
use Gaucho\Controller;
use App\Model\MessagesModel;
use ReCaptcha\ReCaptcha;
class MessagesController extends Controller{
    function GET(){
        $MessagesModel=new MessagesModel();
        $id=$this->dir(2);
        $message=$MessagesModel->readById($id);
        $data=[
            'message'=>[$message],
            'title'=>$message['message']
        ];
        $this->chaplin('inc/header',$data);
        $this->chaplin('messages',$data);
        $this->chaplin('inc/footer',$data);
    }
    function POST(){
        // https://www.google.com/recaptcha/admin/create
        // https://github.com/google/recaptcha 
        $recaptcha = new ReCaptcha(
            $_ENV['RECAPTCHA_SECRET_KEY']
        );
        $gRecaptchaResponse=$_POST["g-recaptcha-response"];
        $resp = $recaptcha->verify($gRecaptchaResponse);
        if (!$resp->isSuccess()) {
            // mensagem de erro
            $data=[
                'title'=>'reCAPTCHA inválido',
                'msg'=>'Responda o desafio corretamente'
            ];
            $this->chaplin('inc/header',$data);
            $this->chaplin('msg',$data);
            $this->chaplin('inc/footer',$data);
            die();      
        }
        $message=@trim($_POST['message']);
        // validar a mensagem
        $len=0;
        if(is_string($message)){
            $len=mb_strlen($message);
        }
        if($len<1 or $len>128){
            // mensagem de erro
            $data=[
                'title'=>'Mensagem inválida',
                'msg'=>'A mensagem deve ter entre 1 e 128 caracteres'
            ];
            $this->chaplin('inc/header',$data);
            $this->chaplin('msg',$data);
            $this->chaplin('inc/footer',$data);
            die();      
        }
        // salvar a mensagem
        $MessagesModel=new MessagesModel();
        $data=[
            'message'=>$message
        ];
        $id=$MessagesModel->create($data);
        $url=$_ENV['SITE_URL'];
        $this->redirect($url);
    }
}