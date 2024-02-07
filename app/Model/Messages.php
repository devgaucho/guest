<?php
namespace App\Model;

use Gaucho\Gaucho;

class Messages extends Gaucho{
	var $db;
	function __construct(){
		$this->db=$this->db();
	}
	function create($message){
		$message['created_at']=time();
		$this->db->insert('messages',$message);
		return $this->db->id();
	}
	function readAll(){
		$cols='*';
		return $this->db->select('messages',$cols);
	}
	function readById($id){
		$cols='*';
		$where=[
			'id'=>$id
		];
		return $this->db->get('messages',$cols,$where);
	}
}