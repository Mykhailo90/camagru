<?php
/**
 *
 */
namespace aplication;
use PDO;

class Db{
  public $dbb;

  public function __construct(){

    $dot = Preferences::getInstance();
    $this->dbb = $dot->getProperty("db");
    }

  public function query($sql, $params = []){
    $stmt = $this->dbb->prepare($sql);
    if (!empty($params)){
      foreach ($params as $key => $val) {
        $stmt->bindValue(':'.$key, $val);
      }
    }
    $stmt->execute();
    return $stmt;
  }

  public function column($sql, $params = []){
    $result = $this->query($sql, $params);
    return $result->fetchColumn();
  }

  public function row($sql, $params = []){
    $result = $this->query($sql, $params);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }
}

 ?>
