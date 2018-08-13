<?php

/**
 * метод generate предназначен для формирования вида.
 * В него передаются следующие параметры:
 * $content_file — виды отображающие контент страниц;
 * $template_file — общий для всех страниц шаблон;
 * $data — массив, содержащий элементы контента страницы.
 * Обычно заполняется в модели.
 * Функцией include динамически подключается общий шаблон (вид),
 * внутри которого будет встраиваться вид
 * для отображения контента конкретной страницы.
 * В нашем случае общий шаблон будет содержать
 * header, menu, sidebar и footer, а контент страниц будет
 * содержаться в отдельном виде.
 */
namespace core;

class View
{
  public $path;
  public $route;
  public $layout = 'default';
//public $template_view; // здесь можно указать общий вид по умолчанию.
  function __construct($route){
    $this->route = $route;
    $this->path = $route['controller'].'/'.$route['action'];
    // debug($this->path);
  }
  // function generate($content_view, $template_view, $data = null)
  // {
  // /*
  // if(is_array($data)) {
  //   // преобразуем элементы массива в переменные
  //   extract($data);
  // }
  // */
  //
  //   include 'views/'.$template_view;
  // }

  public function render($title, $vars = []){
    extract($vars);
    if (file_exists(ROOT.'/views/'.$this->path.'.php')){
      ob_start();
      require 'views/'.$this->path.'.php';
      $content = ob_get_clean();
      require 'views/layout/'.$this->layout.'.php';
    }else {
      echo "Страница вида не найдена".$this->path.'.php';
    }

  }


  public function redirect($url){
    header('location: '.$url);
    exit();
  }

  public static function errorCode($code){
    http_response_code($code);
    require ROOT.'/views/errors/'.$code.'.php';
    exit();
  }


}

?>
