<?php

namespace aplication\controllers;

use aplication\core\Controller;
use aplication\core\View;
// use aplication\models\Restoring_pswModel;
/*
* Класс обеспечивает взаимодействие между моделью и отображением главной страницы
*
* The class provides the interaction between the model and the display of the main page
*/

class Restoring_pswController extends Controller{
  function __construct($parameters){
// Передаем в родительский класс параметры для инициализации модели
// Pass to the parent class the parameters for initializing the model
		parent::__construct($parameters);
    if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
      header("Location: /");
    }
		  $this->view = new View($parameters);
	 }

// Метод для получения данных необходимых для отображения главной страницы
// Method for getting the data required to display the main page
    function indexAction(){
      $title = 'Camagru';

      if (isset($_POST['email'])){
        $msg = $this->model->send_email_change($_POST['email']);
        echo "$msg";
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
          $user = $this->model->get_user($token);
          $_COOKIE['login'] = $_SESSION['login'] = $user['name'];
          $_COOKIE['user_id'] = $_SESSION['user_id'] = $user['user_id'];
          $_COOKIE['email'] = $_SESSION['email'] = $user['email'];
          header("Location: /settings");
          exit();
        }
          header("Location: /Error_404");
          exit();
      }
  }

  }
?>
