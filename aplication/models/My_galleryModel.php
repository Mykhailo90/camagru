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
      echo '<div class="button_panel">
              <img class="panel" id="delete_btn" src="../../public/img/delete.png" alt="Удалить фото">
            </div>';
    }

    public function del_img($img_id){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT user_id FROM users_images WHERE img_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($img_id));
      $res = $result->fetch(PDO::FETCH_ASSOC);

      if($res['user_id'] != $_SESSION['user_id']){
        echo "error";
        exit();
      }

      $sql = "DELETE FROM users_images WHERE img_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($img_id));
    }

    public function get_img_path($eff_id){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT effect_path FROM effects_img WHERE id_effect = ?";
      $result = $link->prepare($sql);
      $result->execute(array($eff_id));
      $res = $result->fetch(PDO::FETCH_ASSOC);
      return($res['effect_path']);
    }

    function resizePng($im, $dst_width, $dst_height) {
        $width = imagesx($im);
        $height = imagesy($im);

        $newImg = imagecreatetruecolor($dst_width, $dst_height);

        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
        imagecopyresampled($newImg, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
        return $newImg;
    }

    function save_user_foto($user_id, $fileName){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO users_images (user_id, img_path) values(?, ?)";
      $result = $link->prepare($sql);
      $result->execute(array($user_id, $fileName));

      $sql = "UPDATE users_info SET avatar=? WHERE user_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($fileName, $user_id));
    }
}
