<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use aplication\lib\Pagination;
use PDO;

class GalleryModel extends Model
{
    public function get_data($img_id){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT img_id, img_path, count_likes, count_comments
              FROM users_images WHERE img_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($img_id));
      $res = $result->fetch(PDO::FETCH_ASSOC);
      return ($res);
    }

    public function check_img($img_id){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT COUNT(*) as count FROM users_images
              WHERE img_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($img_id));
      $number_of_rows = $result->fetchColumn();
      if ($number_of_rows == 0){
        header("Location: /Error_404");
        exit();
      }
    }

    public function add_comment($comment)
    {
      foreach ($comment as $key => $value) {
        $comment["$key"] = htmlspecialchars($value);
      }
      $receiver_id = $this->get_receiver($comment['img_id']);
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO img_comments (id_sender, id_receiver, id_img, comment_text) values(?, ?, ?, ?)";
      $result = $link->prepare($sql);
      $result->execute(array($comment['user_id'], $receiver_id, $comment['img_id'], $comment['text']));

      $sql = "UPDATE users_images SET `count_comments`=`count_comments`+ 1 WHERE img_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($comment['img_id']));

      $receiver['notification'] = $this->get_notification($receiver_id);
      if ($receiver['notification']){
        $receiver['email'] = $this->get_receiver_email($receiver_id);
        $this->send_email_msg($comment, $receiver);
      }
    }


    public function add_like($img_id)
    {
      $img_id = (int) $img_id;
      $receiver_id = $this->get_receiver($img_id);
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT COUNT(*) as count FROM img_likes
              WHERE sender_id = ? AND img_id = ?";
      $result = $link->prepare($sql);
      $result->execute(array($_SESSION['user_id'], $img_id));
      $number_of_rows = $result->fetchColumn();

      if ($number_of_rows == 0){
        $sql = "INSERT INTO img_likes (sender_id, receiver_id, img_id) values(?, ?, ?)";
        // debug($receiver_id);
        $result = $link->prepare($sql);
        $result->execute(array($_SESSION['user_id'], $receiver_id, $img_id));

        $sql = "UPDATE users_images SET `count_likes`=`count_likes`+ 1 WHERE img_id = ?";
        $result = $link->prepare($sql);
        $result->execute(array($img_id));
        echo "ok";
        $receiver['notification'] = $this->get_notification($receiver_id);
        if ($receiver['notification']){
          $receiver['email'] = $this->get_receiver_email($receiver_id);
          $this->send_email_like($img_id, $receiver);
        }
      }
      else {
        $sql = "UPDATE users_images SET `count_likes`=`count_likes`- 1 WHERE img_id = ?";
        $result = $link->prepare($sql);
        $result->execute(array($img_id));

        $sql = "DELETE FROM img_likes WHERE img_id = ? AND sender_id = ?";
        $result = $link->prepare($sql);
        $result->execute(array($img_id, $_SESSION['user_id']));
      }
    }

    public function send_email_like($img_id, $receiver){
      $date = time();

      $message="Сегодня " . date("d.m.Y", $date)." на сайте
      Camagru ваша фотография /gallery/show/" . $img_id .
      " была отмечена пользователем " . $_SESSION['login'] .
      "
      .С уважением, автор проекта msarapii!
      Email для контактов:<a href=\"mailto: mykhailosarapii@gmail.com\"> mykhailosarapii@gmail.com </a>";

//Посылаем сообщение пользователю

      mail($receiver['email'],
          "Внимание - ЛАЙКИ!!!",
          $message,
          "Content-Type: text/html; charset= utf-8",
          "From: mykhailosarapii@gmail.com");
    }

    public function send_email_msg($comment, $receiver){
      $date = time();

      $message="Сегодня " . date("d.m.Y", $date)." на сайте
      Camagru ваша фотография /gallery/show/" . $comment['img_id'] .
      " была прокоментирована пользователем " . $_SESSION['login'] .
      "
      .С уважением, автор проекта msarapii!
      Email для контактов:<a href=\"mailto: mykhailosarapii@gmail.com\"> mykhailosarapii@gmail.com </a>";

//Посылаем сообщение пользователю

      mail($receiver['email'],
          "Внимание!!! Новый комментарий!",
          $message,
          "Content-Type: text/html; charset= utf-8",
          "From: mykhailosarapii@gmail.com");
    }


  private function get_receiver($img_id){
    $link = Registry::getInstance()->getProperty('DB');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT user_id  FROM users_images
            WHERE img_id = ?";
    $result = $link->prepare($sql);
    $result->execute(array($img_id));
    $res = $result->fetch(PDO::FETCH_ASSOC);
    return ($res['user_id']);
  }

  private function get_notification($receiver_id){
    $link = Registry::getInstance()->getProperty('DB');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT notification  FROM users_info
            WHERE user_id = ?";
    $result = $link->prepare($sql);
    $result->execute(array($receiver_id));
    $res = $result->fetch(PDO::FETCH_ASSOC);
    return ($res['notification']);
  }

  private function get_receiver_email($id){
    $link = Registry::getInstance()->getProperty('DB');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT email  FROM users_info
            WHERE user_id = ?";
    $result = $link->prepare($sql);
    $result->execute(array($id));
    $res = $result->fetch(PDO::FETCH_ASSOC);
    return ($res['email']);
  }

  public function get_last_comments($data){
    $link = Registry::getInstance()->getProperty('DB');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT COUNT(*) FROM img_comments WHERE id_img=?";
    $result = $link->prepare($sql);
    $result->execute(array($data['img_id']));
    $total = $result->fetchColumn();
    $pagination_list = new Pagination($data['current_page'], $data['per_page'], $total);

    $link = Registry::getInstance()->getProperty('DB');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $start = $pagination_list->getStart();
    $img_id = $data['img_id'];
    $sql = "SELECT id_sender, id_receiver, comment_text, comment_time, avatar, name
            FROM img_comments, users_info
            WHERE id_img = ?
            AND id_sender = user_id
            ORDER BY comment_time DESC LIMIT $pagination_list->perpage OFFSET $start";
    $result = $link->prepare($sql);
    $result->execute(array($img_id));
    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    echo "<h2>Комментарии пользователей</h2>";
    echo '<div class="info_block" data="'. $total .'">';

    // Добавить вывод значка лайков и количество для конкретной фото, добавить значок коментов и их количество для зареганых пользователей
    foreach ($res as $val) {
      echo '<div class="comment_card">';
      echo '<div class="avatar">';
      echo '<img width="70" data="'.$val['id_receiver'].'" src="'.$val['avatar'].'">';
      echo '<p>' . $val['comment_time'] . "</br>" . $val['name']. "</p></div>";
      echo '<div class="content_center, text"><strong>' . $val['comment_text'] . '</strong></div>';
      echo '</div>';
    }

    echo '<div class="pagin_div">';
    echo $pagination_list;
    echo "</div>";
  }

  public function get_last_likes($img_id){
    $link = Registry::getInstance()->getProperty('DB');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT COUNT(*) FROM img_likes WHERE img_id = $img_id";
    $result = $link->prepare($sql);
    $result->execute();
    $total = $result->fetchColumn();
    if ($total < 1){
      echo "На данный момент фотографию еще никто не отметил!";
      exit();
    }
    $sql = "SELECT avatar, name, sender_id FROM users_info, img_likes
            WHERE img_likes.img_id = $img_id AND sender_id = user_id
            ORDER BY like_time";
    $result = $link->prepare($sql);
    $result->execute();
    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    echo "<h2>Фото отметили:</h2>";
    echo '<div class="info_block">';

    foreach ($res as $val) {
      echo '<div class="like_card">';
      echo '<div class="avatar_l">';
      echo '<img width="70" src="'.$val['avatar'].'">';
      echo '<p>' . $val['name']. "</p></div>";
      echo '</div>';
    }
    echo "</div>";
  }
}
