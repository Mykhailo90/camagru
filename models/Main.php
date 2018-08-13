<?php

namespace models;
use core\Model;
use aplication\Db;

class Main extends Model
{
  public function get_data(){
    $db = new Db();
    $result = $db->row('SELECT name FROM test');
    return $result;
  }
}
?>
