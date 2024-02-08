<?php
namespace App\Model;
use Gaucho\Model;
class MessagesModel extends Model{
    function __construct(){
        $this->table='messages';
    }
}