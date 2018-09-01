<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use PDO;

class SettingsModel extends Model
{

    public function get_data()
    {
      $but_value = $this->what_notification($_SESSION['email']);
      $data['notification'] = $but_value;
      $data['out_img'] = '<img id="0" class="check_img" src="../../public/img/post_of.png" width="100px">';
      $data['in_img'] = '<img id="1" class="check_img" src="../../public/img/post_on2.png" width="100px">';
      $data['out_text'] = "Выключить уведомления";
      $data['in_text'] = "Включить уведомления";
      return $data;
    }

    private function what_notification($email){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT notification  FROM users_info
              WHERE email = ?";
      $result = $link->prepare($sql);
      $result->execute(array($email));
      $res = $result->fetch(PDO::FETCH_ASSOC);
      return ($res['notification']);
    }

    public function change_notification($value){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE users_info SET notification=? WHERE email = ?";
      $result = $link->prepare($sql);
      $result->execute(array($value, $_SESSION['email']));
    }

    private function get_token($email){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT token  FROM users_info
              WHERE email = ? AND check_email = 1";
      $result = $link->prepare($sql);
      $result->execute(array($email));
      $res = $result->fetch(PDO::FETCH_ASSOC);
      return ($res['token']);
    }

    public function send_for_del(){
      $date = time();
      $token = $this->get_token($_SESSION['email']);
      $message="Сегодня " . date("d.m.Y", $date)." на сайте
      Camagru был сделан запрос на удаление аккаунта.
      В случае удаления аккаунта - все данные будут безвозвратно утрачены.
      Для подтверждения намерения необходимо перейти по ссылке, указанной ниже.
      Если вы не отправляли данный запрос - удалите данное письмо!

      Ссылка для активации:
      ->->->->->->->->->->->->->->
      <a href=\"/settings/delete/checkSum=".$token."\">Перейти</a>;
      ->->->->->->->->->->->->->->

      С уважением, автор проекта msarapii!
      Email для контактов:<a href=\"mailto: mykhailosarapii@gmail.com\"> mykhailosarapii@gmail.com </a>";

//Посылаем сообщение пользователю

      @mail($_SESSION['email'],
          "Запрос на удаление аккаунта",
          $message,
          "Content-Type: text/html; charset= utf-8",
          "From: mykhailosarapii@gmail.com");
    }

    public function del_page($token){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "DELETE FROM users_info WHERE token = ?";
      $result = $link->prepare($sql);
      $result->execute(array($token));

      $this->clear_memory();
    }

    private function clear_memory(){
      if (isset($_COOKIE['login'])){
        unset($_COOKIE['login']);
      }
      if (isset($_COOKIE['email'])){
        unset($_COOKIE['email']);
      }
      if (isset($_COOKIE['user_id'])){
        unset($_COOKIE['user_id']);
      }
      if (isset($_SESSION['login'])){
        unset($_SESSION['login']);
      }
      if (isset($_SESSION['email'])){
        unset($_SESSION['email']);
      }
      if (isset($_SESSION['user_id'])){
        unset($_SESSION['user_id']);
      }
    }

    public function update_user_info($user){
        $user = $this->safety_data($user);
        $this->check_user_email($user['email']);
        $user['token'] = substr(str_shuffle($user['psw']), 0, 10);
        $user['token'] = str_replace("/", "$", $user['token']);

        $link = Registry::getInstance()->getProperty('DB');
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE users_info SET name=? email=? user_password=? token=? WHERE email=?";
        $result = $link->prepare($sql);
        $result->execute(array($user['login'], $user['email'], $user['psw'], $user['token'], $_SESSION['email']));
        $msg = "Операция по изменению данных прошла успешно!";
        $_COOKIE['login'] = $_SESSION['login'] = $user['login'];
        $_COOKIE['email'] = $_SESSION['email'] = $user['email'];
        return ($msg);
    }

    private function safety_data($user){
      foreach ($user as $key => $value) {
        $user["$key"] = trim($value);
        $user["$key"] = stripslashes($user["$key"]);
        $user["$key"] = strip_tags($user["$key"]);
        $user["$key"] = htmlspecialchars($user["$key"]);
      }
      $user['psw'] = password_hash($user['psw'], PASSWORD_DEFAULT);
      return($user);
    }

    private function check_user_email($email){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT COUNT(*) as count FROM users_info WHERE email = ?";
      $result = $link->prepare($sql);
      $result->execute(array($email));
      $number_of_rows = $result->fetchColumn();
      if ($number_of_rows != 0){
        // Делаем запрос на select
        $link = Registry::getInstance()->getProperty('DB');
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT user_id, name, email, FROM users_info
                WHERE email = ? AND check_email = 1";
        $result = $link->prepare($sql);
        $result->execute(array($email));

        $res = $result->fetch(PDO::FETCH_ASSOC);
        if ($res['email'] != $_SESSION['email']){
          $msg = "Ошибка регистрации!</br> В системе уже зарегестрирован пользователь с указанным email! ";
          echo $msg;
          exit();
        }
      }
    }
}
