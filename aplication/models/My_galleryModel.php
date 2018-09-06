<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use aplication\lib\Pagination;
use PDO;

class My_galleryModel extends Model
{

    public function get_effects()
    {
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM effects_img";
      $result = $link->prepare($sql);
      $result->execute();
      $result = $link->prepare($sql);
      $result->execute();
      $res = $result->fetchAll(PDO::FETCH_ASSOC);

      // Добавить вывод значка лайков и количество для конкретной фото, добавить значок коментов и их количество для зареганых пользователей
      // foreach ($res as $val) {
      //   echo '<div class="effect_card"><img width="80" id="' . $val['id_effect'] . 'src="'.$val['effect_path'].'"></div>';
      // }
      $i = 1;
      foreach ($res as $val) {
      $data["obj$i"]['id'] = $val['id_effect'];
      $data["obj$i"]['path'] = $val['effect_path'];
      $i++;
      }
      return ($data);
    }

    public function get_users_foto($data)
    {
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT COUNT(*) FROM users_images WHERE user_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($_SESSION['user_id']));
      $total = $result->fetchColumn();

      $pagination_list = new Pagination($data['current_page'], $data['per_page'], $total);

      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $start = $pagination_list->getStart();
      $sql = "SELECT * FROM users_images WHERE user_id = ? ORDER BY img_time DESC LIMIT $pagination_list->perpage OFFSET $start";
      $result = $link->prepare($sql);
      $result->execute(array($_SESSION['user_id']));
      $res = $result->fetchAll(PDO::FETCH_ASSOC);
      echo '<div class="img_list" data="'. $total .'">';
      // Добавить вывод значка лайков и количество для конкретной фото, добавить значок коментов и их количество для зареганых пользователей
      foreach ($res as $val) {
        echo '<img class="users_card" id="'.$val['img_id'].'" src="'.$val['img_path'].'">';
      }
      echo '</div>';
      echo '<div class="pagin_conteiner">';
      echo $pagination_list;
      echo "</div>";
    }
}
