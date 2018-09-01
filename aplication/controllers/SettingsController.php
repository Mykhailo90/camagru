<?php

namespace aplication\controllers;

use aplication\core\Controller;
use aplication\core\View;

/*
* Класс обеспечивает взаимодействие между моделью и отображением главной страницы
*
* The class provides the interaction between the model and the display of the main page
*/

class SettingsController extends Controller{
  function __construct($parameters){
// Передаем в родительский класс параметры для инициализации модели
// Pass to the parent class the parameters for initializing the model
		  parent::__construct($parameters);
      if (!isset($_SESSION['login']) || empty($_SESSION['login']))
      {
        header("Location: /");
      }
		  $this->view = new View($parameters);
	 }

// Метод для получения данных необходимых для отображения главной страницы
// Method for getting the data required to display the main page
  public function indexAction(){
      $title = 'Camagru';
      $data = $this->model->get_data();
      if (isset($_POST['notification'])){
        $this->model->change_notification($_POST['notification']);
        echo "";
        exit();
      }
      if (isset($_POST['del_page'])){
        $this->model->send_for_del();
      // $this->model->del_page();
      echo '<div class="content_center"><h2 class="mgs_ok"> Вам на почтовый адрес было отправлено письмо.
            Чтобы завершить удаление подтвердите намерение и перейдите по
            указанной в письме ссылке!</h2></div>';
      exit();
      }
      if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['psw'])){
        //Проверить все как при регистрации
        $user['login'] = $_POST['login'];
        $user['email'] = $_POST['email'];
        $user['psw'] = $_POST['psw'];
        $data = $this->model->update_user_info($user);
        
        echo ($data);
        exit();
      }
      $this->view->render($title, $data);
  }

  public function deleteAction(){
    $title = 'Camagru';
    if (!empty($this->params['parameters'])){
      $check_sum = $this->params['parameters'][0];
      $check_sum = explode("=", $check_sum);
      $token = $check_sum[1];
      $data = $this->model->del_page($token);
      if (empty($data)){
        header("Location: /");
        exit();
      }
        header("Location: /Error_404");
        exit();
    }
  }

}
?>
