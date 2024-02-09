<?php
namespace Gaucho;
use Gaucho\DB;
class Model extends DB{
	var $table;
	function dataH($data){
		if(isset($data['created_at'])){
			$h=date('r',$data['created_at']);
			$data['created_at_h']=$h;
			return $data;
		}
		foreach ($data as $key => $value) {
			// data humanizada
			$h=date('r',$value['created_at']);
			$data[$key]['created_at_h']=$h;
		}
		return $data;	
	}
	function create($data){
		$db=$this->db();
		$data['created_at']=time();
		$db->insert($this->table,$data);
		return $db->id();
	}
	function readAll(){
		$cols='*';
		$all=$this->db()->select($this->table,$cols);
		if($all){
			$all=$this->dataH($all);
		}
		return $all;
	}
	function readById($id){
		$cols='*';
		$where=[
			'id'=>$id
		];
		$data=$this->db()->get($this->table,$cols,$where);
		$data=$this->dataH($data);
		return $data;
	}
}