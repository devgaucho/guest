<?php
namespace App\Controller;
use Gaucho\Gaucho;
use App\Model\Messages as MessagesModel;
class Messages extends Gaucho{
	function GET(){
		$MessagesModel=new MessagesModel();
		$id=$this->dir(2);
		$message=$MessagesModel->readById($id);
	}
	function POST(){
		$MessagesModel=new MessagesModel();
// 		TODO validar a mensagem no backend
		$message=[
			'message'=>$_POST['message']
		];
		$id=$MessagesModel->create($message);
		$url=$_ENV['SITE_URL'].'/messages/'.$id;
		$this->redirect($url);
	}
}