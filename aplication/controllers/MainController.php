<?php

namespace aplication\controllers;

use aplication\core\Controller;
use aplication\core\View;

class MainController extends Controller{

  function __construct($parameters){
		parent::__construct($parameters);
		$this->view = new View($parameters);
	 }

    function listAction(){
			$title = 'DTEK Academy';
      $data = $this->model->get_data();
      $this->view->render($title, $data);
    }
  }
?>
