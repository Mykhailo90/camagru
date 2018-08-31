<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
    {
      if (isset($_COOKIE['login']) && isset($_COOKIE['email']) && $_COOKIE['user_id'])
        $_SESSION['login'] = $_COOKIE['login'];
        $_SESSION['email'] = $_COOKIE['email'];
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    }
/*
* Создаем константу корневой директории.
*
* Create a constant for the root directory.
*/

define('ROOT', dirname(__FILE__));
/*
* Подключаем файл базовой инициализации приложения.
*
* We connect the basic application initialization file.
*/

require 'aplication/lib/Dev.php';

use aplication\core\Router;

/*
* Создаем объкт маршрутизации и вызываем главный метод.
*
* Сreate the routing object and call the main method.
*/
$router = new Router();
$router->run();
