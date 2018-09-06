<?php

namespace aplication\controllers;

use aplication\core\Controller;
use aplication\core\View;

/*
* Класс обеспечивает взаимодействие между моделью и отображением главной страницы
*
* The class provides the interaction between the model and the display of the main page
*/

class My_galleryController extends Controller{
  function __construct($parameters){
// Передаем в родительский класс параметры для инициализации модели
// Pass to the parent class the parameters for initializing the model
		parent::__construct($parameters);
		  $this->view = new View($parameters);
	 }

// Метод для получения данных необходимых для отображения главной страницы
// Method for getting the data required to display the main page
    function indexAction(){
			$title = 'Camagru';
      $data['effects'] = $this->model->get_effects();
      if (isset($_POST['per_page']) && isset($_POST['current_page'])){
        $data['per_page'] = (int) $_POST['per_page'];
        $data['current_page'] = (int) $_POST['current_page'];
        $data = $this->model->get_users_foto($data);
        exit();
      }
      $this->view->render($title, $data);
    }
  }
?>
