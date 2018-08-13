<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// разделитель для путей к файлам
define ('DS', DIRECTORY_SEPARATOR);

// путь к папке c классами для автозагрузки
define ('APP', 'aplication');
// функция для автозагрузки классов логики приложения


function __autoload($class_name){
  $filename = strtolower($class_name) . '.php';
  $file = ROOT . DS . APP . DS . $filename;
  if (file_exists($file) == false){
    return false;
  }
  include ($file);
}

function debug($var)
{
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  exit();
}
