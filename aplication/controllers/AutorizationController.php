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

  //   function activateAction(){
  //     $title = 'Camagru';
  //     if (!empty($this->params['parameters'])){
  //       $check_sum = $this->params['parameters'][0];
  //       $check_sum = explode("=", $check_sum);
  //       $token = $check_sum[1];
  //       $data = $this->model->check_token($token);
  //
  //       if (empty($data)){
  //         header("Location: /autorization");
  //         exit();
  //       }
  //         header("Location: /Error_404");
  //         exit();
  //     }
  // }
//       $title = 'DTEK Academy';
//       $data = $this->model->get_data($this->params['action']);
//       // debug($data);
//       if (!isset($_POST['page'])) {
//             $current_page = 1;
//       }
//       else {
//         $current_page = $_POST['page'];
//       }
//       if (isset($_POST['type_event'])){
//         foreach ($_POST as $key => $value) {
//           if (!empty($value))
//             $choice[$key] = $value;
//         }
//
//       }
// // Вынести количество элементов на странице в конфигурациооный файл
//       $elements_per_page = 5;
//
//
//       $count_of_pages = ceil(count($data['programs']) / $elements_per_page);
//       $check = array_slice($data['programs'], ($current_page - 1) * $elements_per_page, $elements_per_page);
//       $data['pages'] = $count_of_pages;
//       $data['programs'] = $check;
//       $data['url'] = $this->params['route'];
//
//       if (isset($_POST['page'])) {
//         unset($_POST['page']);
//         foreach ($data['programs'] as $value){
//         echo "<div class='prog_cards'>";
//         echo '<img class="prog_image" width="150" height="150" src="../../../public/img/corporate.jpg" alt="f1">';
//         echo '<div class="cards_content">';
//         echo '<h2 class="prog_title">'.$value['title'].'</h2>';
//         echo '<a href="'.$value['path_to_program'].'"><p class="text_content">';
//         echo $value['short_info'];
//         echo "</p></a></div></div>";
//       }
//       exit();
//       }
//       $this->view->render($title, $data);
//     }
//
//     function treningsAction(){
//       $this->listAction();
// 			// $title = 'DTEK Academy';
//       // $data = $this->model->get_data($this->params['action']);
//       // $this->view->render($title, $data);
//     }
//
//     function team_buildingsAction(){
//       $this->listAction();
// 			// $title = 'DTEK Academy';
//       // $data = $this->model->get_data($this->params['action']);
//       // $this->view->render($title, $data);
//     }
//
//     function module_programsAction(){
//       $this->listAction();
//       // $title = 'DTEK Academy';
//       // $data = $this->model->get_data($this->params['action']);
//       // $this->view->render($title, $data);
//     }
  }
?>
