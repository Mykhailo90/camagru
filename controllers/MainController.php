<?php

namespace controllers;

use core\Controller;
use core\View;
use aplication\Db;

class MainController extends Controller{
  // function __construct($parameters){
  //   // require_once ROOT . '/models/model_main.php';
	// 	// $this->model = new Model_main();
	// 	$this->view = new View($this->route);
  //
	 //}

    function indexAction(){
      $res = $this->model->get_data();

      // $db = new Db;
      // $form = '1; Delete FROM test';
      // $params = ['id'=>$form,];
      //
      // // $data = $db->column('SELECT name FROM test WHERE id = :id', $params);
      //
      // $prop = $this->model->get_data();
      //
      // $vars[] = $r;

      // debug($vars);

      $vars = [
        'res' => $res,
      ];
      $this->view->render("Главная страница", $vars);
    }
  }
?>
