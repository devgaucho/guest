<?php
namespace Gaucho;
use Gaucho\Chaplin;
use Gaucho\DB;
use Gaucho\Env;
use Gaucho\Mig;
use Gaucho\Route;
class Gaucho{
	function chaplin($name,$data=[],$print=true){
		$Chaplin=new Chaplin();
		$filename=ROOT.'/view/'.$name.'.html';
		$data['SITE_DOMAIN']=$_ENV['SITE_DOMAIN'];
		$data['SITE_NAME']=$_ENV['SITE_NAME'];
		$data['SITE_URL']=$_ENV['SITE_URL'];
		$data['SITE_VERSION']=$_ENV['SITE_VERSION'];
		$rendered=$Chaplin->renderFromFile($filename,$data);
		if($print){
			if($this->isAjax()){
				$this->json($data);
			}else{
				return print $rendered;
			}
		}else{
			return $rendered;
		}
	}
	function dir($dir){
		$dirs=$this->dirs();
		if(isset($dirs[$dir])){
			return $dirs[$dir];
		}else{
			return false;
		}
	}
	function dirs(){
		if($this->isCli()){
			return false;
		}else{
			$uri=$this->getNormalUri();
			$dirs=explode('/',$uri);
			$dirs=array_filter($dirs);
			if(empty($dirs)){
				return [
					'1'=>'/'
				];
			}
			return $dirs;
		}
	}
	function getNormalUri(){
		$scheme=$_SERVER['REQUEST_SCHEME'];
		$host=$_SERVER['HTTP_HOST'];
		$uri=$_SERVER["REQUEST_URI"];
		$uri=explode('?',$uri)[0];
		$full=$scheme.'://'.$host.$uri;
		$env=@$_ENV['SITE_URL'];
		if($env){
			$uri=@explode($env,$full)[1];
			if(empty($uri)){
				return '/';
			}else{
				return $uri;
			}
		}else{
			return $uri;
		}
	}
	function getRotasEViews(){
		$viewsList=glob(ROOT.'/view/*.html');
		if(count($viewsList) > 0){
			$rotas=[];
			foreach ($viewsList as $view){
				$filename=$view;
				$viewName=@explode(
					'.',basename($view)
				)[0];
				$str=file_get_contents($filename);
				$rotas[$viewName]=$str;
			}
			return $rotas;
		}else{
			die('views not found');
		}
	}
	function isAjax(){
		if(
			!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
		){
			$str=strtolower(
				$_SERVER['HTTP_X_REQUESTED_WITH']
			);
			if($str=='xmlhttprequest'){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function isCli(){
		if(php_sapi_name()=="cli"){
			return true;
		}else{
			return false;
		}
	}
	function json($mix){
		header('Content-Type:application/json');
		die(json_encode($mix,JSON_PRETTY_PRINT));
	}
	function mig($id=false){
		$DB=new DB();
		$prefix='DB'.$id;
		$dbType=@$_ENV[$prefix.'_TYPE'];
		if($dbType=='mysql'){
			$DB->createMysqlDB($id);
		}
		if($dbType=='sqlite'){
			$DB->createSQLiteDB($id);
		}
		$db=$DB->db($id);
		$pdo=$db->pdo;
		$tableDirectory=glob(ROOT.'/table');
		$Mig=new Mig($pdo,$tableDirectory,$dbType);
		$Mig->mig();
	}
	function redirect($url){
		header('Location: '.$url);
		die();
	}
	function run($routes=false){
		new Env(ROOT.'/.env');
		ini_set("memory_limit",$_ENV['SITE_MEMORY']);
		$this->showErrors($_ENV['SITE_ERRORS']);
		if($routes){
			new Route($routes);
		}
	}
	function salvarRotasEViews($filename,$rotasEViews){
		$data=json_encode($rotasEViews,JSON_PRETTY_PRINT);
		$data='var rotas='.$data.';'.PHP_EOL;
		$data.='var SITE_DOMAIN="'.$_ENV['SITE_DOMAIN'].'";';
		$data.=PHP_EOL;
		$data.='var SITE_NAME="'.$_ENV['SITE_NAME'].'";';
		$data.=PHP_EOL;
		$data.='var SITE_URL="'.$_ENV['SITE_URL'].'";';
		$data.=PHP_EOL;
		$data.='var SITE_VERSION="';
		$data.=$_ENV['SITE_VERSION'].'";'.PHP_EOL;
		if(file_put_contents($filename,$data)){
			$msg=$filename.' criado com sucesso!';
			$msg.=PHP_EOL;
			print $msg;
		}else{
			die("erro ao criar o ".$filename.PHP_EOL);
		}
	}
	function showErrors($bool){
		if($bool){
			ini_set('display_errors',1);
			ini_set('display_startup_errors',1);
			error_reporting(E_ALL);
		}else{
			ini_set('display_errors',0);
			ini_set('display_startup_errors',0);
			error_reporting(0);
		}
	}
}
