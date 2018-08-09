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


class View
{
//public $template_view; // здесь можно указать общий вид по умолчанию.

  function generate($content_view, $template_view, $data = null)
  {
  /*
  if(is_array($data)) {
    // преобразуем элементы массива в переменные
    extract($data);
  }
  */

    include 'application/views/'.$template_view;
  }
}

?>
