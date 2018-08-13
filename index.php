<?php

require_once 'aplication/dev.php';

use core\Router;
use aplication\Helper;

// путь к корневой папке сайта
$sitePath = realpath(dirname(__FILE__) . DS);
define ('ROOT', $sitePath);

spl_autoload_register(function ($class) {
  $path = str_replace('\\', '/', $class);
  $path .= '.php';
  if (file_exists($path))
    require $path;
});

session_start();
Helper::init();
$router = new Router;
$router->run();


// $routes = ROOT . '/config/routes.php';
// Helper::init();
// require_once 'core/model.php';
// require_once 'core/view.php';
// require_once 'core/controller.php';
// require_once 'core/route.php';

// $registry = Preferences::getInstance();
 // $router = new route($routes);
// $router->setPath (ROOT . '/controllers');
// $registry->setProperty('router', $router);
// $router->delegate();
 // $router->start();
// $password = password_hash($password, PASSWORD_DEFAULT);

 ?>
