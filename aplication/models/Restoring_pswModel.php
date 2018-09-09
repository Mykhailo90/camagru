<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use PDO;

class Restoring_pswModel extends Model
{

    public function check_token($token){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT COUNT(*) as count FROM users_info WHERE token = ? AND check_email = 1";
      $result = $link->prepare($sql);
      $result->execute(array($token));
      $number_of_rows = $result->fetchColumn();
      if ($number_of_rows != 1){
        $msg = "Ошибка!</br> Вы пытаетесь использовать неликивидную ссылку! ";
        return($msg);
      }
    }

    public function get_user($token){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT user_id, name, email FROM users_info
              WHERE token = ? AND check_email = 1";
      $result = $link->prepare($sql);
      $result->execute(array($token));
      $res = $result->fetch(PDO::FETCH_ASSOC);
      return ($res);
    }

    public function send_email_change($email){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT COUNT(*) as count FROM users_info WHERE email = ? AND check_email = 1";
      $result = $link->prepare($sql);
      $result->execute(array($email));
      $number_of_rows = $result->fetchColumn();
      if ($number_of_rows != 1){
        $msg = "Ошибка!</br> Вы пытаетесь использовать незарегестрированный или неподтвержденный адрес! ";
        return($msg);
      }
      $this->send_email_msg($email);
      $msg = "На ваш электронный адрес была отправлена ссылка для изменения пароля";
      return($msg);
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

    private function send_email_msg($email){
      $date = time();
      $HTTP_HOST = $_SERVER['HTTP_HOST'];
      $token = $this->get_token($email);
      $message="Сегодня " . date("d.m.Y", $date)." на сайте
      Camagru был сделан запрос на восстановление пароля по данному email.
      Для подтверждения намерения необходимо перейти по ссылке, указанной ниже.
      Если вы не отправляли данный запрос - удалите данное письмо!

      Ссылка для активации:
      ->->->->->->->->->->->->->->
      <a href=\"http://" . $HTTP_HOST . "/restoring_psw/activate/checkSum=".$token."\">Перейти</a>;
      ->->->->->->->->->->->->->->

      С уважением, автор проекта msarapii!
      Email для контактов:<a href=\"mailto: mykhailosarapii@gmail.com\"> mykhailosarapii@gmail.com </a>";

//Посылаем сообщение пользователю

      mail($email,
          "Запрос на смену пароля",
          $message,
          "Content-Type: text/html; charset= utf-8",
          "From: mykhailosarapii@gmail.com");
    }

}
