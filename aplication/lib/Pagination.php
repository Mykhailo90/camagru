<?php
  namespace aplication\lib;

  /**
   *  Класс принимает текущую страницу, лимит страниц и общее количество объектов на вывод
   *  Возвращает готовый кусок html кода для вставки в див. Вызывать на печать через echo
   */
  class Pagination
  {
    public $currentPage;
    public $perpage;
    public $total;
    public $countPages;

    function __construct($page, $perpage, $total)
    {
      $this->perpage = $perpage;
      $this->total = $total;
      $this->countPages = $this->getCountPages();
      $this->currentPage = $this->getCurrentPage($page);
    }

    private function getCountPages(){
      return ceil($this->total / $this->perpage) ? : 1;
    }

    private function getCurrentPage($page){
      if (!$page || $page < 1){
        $page = 1;
      }
      if ($page > $this->countPages){
        $page = $this->countPages;
      }
      return ($page);
    }

    public function getStart(){
      return ($this->currentPage - 1) * $this->perpage;
    }

    public function __toString(){
      return $this->getHtml();
    }

    public function getHtml(){
      $back = null;
      $forward = null;
      $start_page = null;
      $end_page = null;

    if($this->currentPage > 1){
        $back = '<li><a class="pag_link" onclick="prev()"><img id="back" width="50" src="../../public/img/left.png" ></a></li>';
    }
    if ($this->currentPage < $this->countPages){
        $forward = '<li><a class="pag_link" onclick="next()"><img id="forward" width="50" src="../../public/img/right.png"></a></li>';
    }
    if ($this->currentPage > 2){
      $start_page = '<li><a class="pag_link" onclick="start()"><img id="start_page" width="50" src="../../public/img/start.png"></a></li>';
    }
    if ($this->currentPage < ($this->countPages - 1)){
      $end_page = '<li><a class="pag_link" onclick="finish()"><img id="end_page" width="50" src="../../public/img/end.png" ></a></li>';
    }
    $login = (isset($_SESSION['login'])) ? $_SESSION['login'] : "undef";
    return ('<ul class="pagination_list">' . $start_page . $back . $forward . $end_page .'</ul><div class="is_reg" id="'.$login . '"></div>');
  }

}

 ?>
