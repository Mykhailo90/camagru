<?php
  /**
   * Сохраняем идентификатор доступа к Базе Данных
   */
  class Helper
  {
    public static function init(){
      require_once 'config/database.php';
      $pref = Preferences::getInstance();
      if(is_null($pref->getProperty("db"))){
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pref->changeProperty("db", $db);
      }
    }
  }
?>
