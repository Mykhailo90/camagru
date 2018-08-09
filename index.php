<?php

ini_set('display_errors', 1);
/**
 * turn on base modules in work
 */

// require_once 'config/database.php'
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';

Route::start();
// $password = password_hash($password, PASSWORD_DEFAULT);

 ?>
