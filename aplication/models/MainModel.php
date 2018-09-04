<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use aplication\lib\Pagination;
use PDO;

class MainModel extends Model
{

    public function get_data($data)
    {
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT COUNT(*) FROM users_images";
      $result = $link->prepare($sql);
      $result->execute();
      $total = $result->fetchColumn();

      $pagination_list = new Pagination($data['current_page'], $data['per_page'], $total);

      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $start = $pagination_list->getStart();
      $sql = "SELECT * FROM users_images ORDER BY img_time DESC LIMIT $pagination_list->perpage OFFSET $start";
      $result = $link->prepare($sql);
      $result->execute();
      $res = $result->fetchAll(PDO::FETCH_ASSOC);
      echo '<div class="img_list" data="'. $total .'">';
      // Добавить вывод значка лайков и количество для конкретной фото, добавить значок коментов и их количество для зареганых пользователей
      foreach ($res as $val) {
        echo '<div class="show" onclick="new_window('.$val['img_id'].')"><img width="120" id="'.$val['img_id'].'" data="'.$val['user_id'].'" src="'.$val['img_path'].'"></div>';
      }
      echo '</div>';
      echo '<div class="pagin_div">';
      echo $pagination_list;
      echo "</div>";
      // debug($res);











      // return $allData;
    }
}
