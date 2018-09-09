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
    if (!isset($_SESSION['login']) || empty($_SESSION['login']))
    {
      header("Location: /");
    }
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

    function del_imgAction(){
      $title = 'Camagru';
      if (isset($_POST['img_id'])){
        $img_id = (int)$_POST['img_id'];
        $this->model->del_img($img_id);
      }
    }

    function lipsAction(){
      if (isset($_POST['user_img']) && isset($_POST['id_effect'])){
        $user_img = str_replace('data:image/png;base64,', '', $_POST['user_img']);
        $user_img = str_replace(' ', '+', $user_img);
        $user_img = base64_decode($user_img);
        $user_img = imagecreatefromstring($user_img);
        $path_to_directory = "public/img/users_img/" . $_SESSION['user_id'] . '/';
        if (file_exists($path_to_directory)) {
                $fileName = $path_to_directory . time() . '.png';
        }
        else {
                $path_to_directory = mkdir($path_to_directory, 0700);
                $fileName = $path_to_directory . time() . ".png";
        }
        if ($_POST['id_effect'] != "empty") {
          $path = str_replace("../../", "", $this->model->get_img_path((int)$_POST['id_effect']));
          $effect = file_get_contents($path);
          $effect = $this->model->resizePng(imagecreatefromstring($effect), 640, 480);
          imagecopy($user_img, $effect, 0, 0, 0, 0, 640, 480);
       }
       // Сюда дописать код сохранения фото с камеры без эффекта!!!
       imagepng($user_img, $fileName);
       $fileName = '../../' . $fileName;
       $this->model->save_user_foto($_SESSION['user_id'], $fileName);
      }
    }
  }
?>
