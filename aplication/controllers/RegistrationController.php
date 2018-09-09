<?php

namespace aplication\controllers;

use aplication\core\Controller;
use aplication\core\View;

/*
* Класс обеспечивает взаимодействие между моделью и отображением главной страницы
*
* The class provides the interaction between the model and the display of the main page
*/

class RegistrationController extends Controller{
  function __construct($parameters){
// Передаем в родительский класс параметры для инициализации модели
// Pass to the parent class the parameters for initializing the model
		  parent::__construct($parameters);
      if (isset($_SESSION['login']) && !empty($_SESSION['login']))
      {
        header("Location: /");
      }
		  $this->view = new View($parameters);
	 }

// Метод для получения данных необходимых для отображения главной страницы
// Method for getting the data required to display the main page
    function indexAction(){
      $title = 'Camagru';
    if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['psw'])){
      $user['login'] = $_POST['login'];
      $user['email'] = $_POST['email'];
      $user['psw'] = $_POST['psw'];
      $data = $this->model->set_user_info($user);
      return ($data);
      exit();
    }

      $this->view->render($title);
    }

    function activateAction(){
      $title = 'Camagru';
      if (!empty($this->params['parameters'])){
        $check_sum = $this->params['parameters'][0];
        $check_sum = explode("=", $check_sum);
        $token = $check_sum[1];
        $data = $this->model->check_token($token);

        if (empty($data)){
          header("Location: /autorization");
          exit();
        }
          header("Location: /Error_404");
          exit();
      }
  }
}
?>
