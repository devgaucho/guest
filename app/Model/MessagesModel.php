<?php
namespace App\Model;
use SPA\Model;
class MessagesModel extends Model{
    function __construct(){
        $this->table='messages';
    }
}