<?php
namespace aplication\lib;
/**
 *
 */
class Swow_obj
{
  public $img_id;
  public $img_title;
  public $img_date;
  public $img_path;
  public $count_likes;
  public $count_comments;

  function __construct($img_id)
  {
    $this->$img_id = $img_id;
  }
}

 ?>
