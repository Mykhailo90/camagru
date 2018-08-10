<?php

ini_set('display_errors', 1);
// разделитель для путей к файлам
define ('DS', DIRECTORY_SEPARATOR);
// путь к корневой папке сайта
$sitePath = realpath(dirname(__FILE__) . DS);
define ('SITE_PATH', $sitePath);
// путь к папке c классами для автозагрузки
define ('APP', 'aplication');

function __autoload($class_name){
  $filename = strtolower($class_name) . '.php';
  $file = SITE_PATH . DS . APP . DS . $filename;
  if (file_exists($file) == false){
    return false;
  }
  include ($file);
}

Helper::init();
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';


Route::start();
// $password = password_hash($password, PASSWORD_DEFAULT);

 ?>
