<?php

namespace aplication\controllers;

use aplication\core\Controller;
use aplication\core\View;

/*
* Класс обеспечивает взаимодействие между моделью и отображением главной страницы
*
* The class provides the interaction between the model and the display of the main page
*/

class AutorizationController extends Controller{
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
  public function indexAction(){
      $title = 'Camagru';
    if (isset($_POST['email']) && isset($_POST['psw'])){
      $user['email'] = $_POST['email'];
      $user['psw'] = $_POST['psw'];
      $data = $this->model->search_user($user);
      $_COOKIE['login'] = $_SESSION['login'] = $data['name'];
      $_COOKIE['user_id'] = $_SESSION['user_id'] = $data['user_id'];
      $_COOKIE['email'] = $_SESSION['email'] = $data['email'];
      echo "";
      exit();
    }

      $this->view->render($title);
  }

  public function unlogAction(){
    if (isset($_SESSION['login'])){
      unset($_SESSION['login']);
      unset($_COOKIE['login']);
    }
    if (isset($_SESSION['email'])){
      unset($_SESSION['email']);
      unset($_COOKIE['email']);
    }
    if (isset($_SESSION['user_id'])){
      unset($_SESSION['user_id']);
      unset($_COOKIE['user_id']);
    }
    header("Location: /");
  }
}
?>
