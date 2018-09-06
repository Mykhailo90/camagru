<?php

namespace aplication\controllers;

use aplication\core\Controller;
use aplication\core\View;

/*
* Класс обеспечивает взаимодействие между моделью и отображением главной страницы
*
* The class provides the interaction between the model and the display of the main page
*/

class GalleryController extends Controller{
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
    function showAction(){
			$title = 'Camagru';
      $img_id = $this->params['parameters'][0];
      $this->model->check_img($img_id);
      $data = $this->model->get_data($img_id);
      $this->view->render($title, $data);
    }

    function show_commentsAction(){
      if (isset($_POST['img_id']) && isset($_POST['current_page']) && isset($_POST['per_page'])){
        $data['per_page'] = (int) $_POST['per_page'];
        $data['current_page'] = (int) $_POST['current_page'];
        $data['img_id'] = (int) $_POST['img_id'];
        $data = $this->model->get_last_comments($data);
        exit();
      }
    }

    function show_likesAction(){
      if (isset($_POST['img_id'])){
      $img_id = (int) $_POST['img_id'];
        $data = $this->model->get_last_likes($img_id);
        exit();
      }
    }

    function add_commentAction(){
      $title = 'Camagru';
      if (isset($_POST['img_id']) && isset($_POST['comment_text'])){
        $comment['img_id'] = $_POST['img_id'];
        $comment['text'] = $_POST['comment_text'];
        $comment['user_id'] = $_SESSION['user_id'];
        // echo $_SESSION['user_id'];
        $this->model->add_comment($comment);
        exit();
      }
    }

    function add_likeAction(){
      $title = 'Camagru';
      if (isset($_POST['img_id'])){
        $img_id = $_POST['img_id'];
        // $user_id = $_SESSION['user_id'];
        // echo $_SESSION['user_id'];
        $this->model->add_like($img_id);
        exit();
      }
    }
  }
