<?php
namespace App\Model;
use Gaucho\Gaucho;
class MessagesModel extends Gaucho{
    function __construct(){
        $this->table='messages';
    }
}