<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use PDO;

class RegistrationModel extends Model
{

    public function set_user_info($user){
      $user = $this->safety_data($user);
      $msg = $this->check_user_email($user);
      if(!empty($msg)){
        echo($msg);
        exit();
      }
      $user['token'] = substr(str_shuffle($user['psw']), 0, 10);
      $user['token'] = str_replace("/", "$", $user['token']);

      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO users_info (name, email, user_password, token) values(?, ?, ?, ?)";
      $result = $link->prepare($sql);
      $result->execute(array($user['login'], $user['email'], $user['psw'], $user['token']));

      $this->send_email_msg($user);
      $msg = '<span class="mgs_ok">На электронный адрес ' .$user['email'] . ' было отправлено сообщение.</br>
              Чтобы завершить регистрацию, необходимо подтвердить email.</br>
              Для подтверждения - выполните действия указанные в сообщении!!!<span>';
      echo "$msg";
      exit();
    }

    private function safety_data($user){
      foreach ($user as $key => $value) {
        // echo "$key = $value\n";
        $user["$key"] = trim($value);
        $user["$key"] = stripslashes($user["$key"]);
        $user["$key"] = strip_tags($user["$key"]);
        $user["$key"] = htmlspecialchars($user["$key"]);
      }
      $user['psw'] = password_hash($user['psw'], PASSWORD_DEFAULT);
      return($user);
    }

    private function check_user_email($user){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT COUNT(*) as count FROM users_info WHERE email = ?";
      $result = $link->prepare($sql);
      $result->execute(array($user['email']));
      $number_of_rows = $result->fetchColumn();
      if ($number_of_rows != 0){
        $msg = "Регистрация невозможна!</br> В системе уже зарегестрирован пользователь с указанным email! ";
        return($msg);
      }
    }

    private function send_email_msg($user){
      $date = time();

      $HTTP_HOST = $_SERVER['HTTP_HOST'];

      // <a href='/autorization/?email=$user_mail&token=$token'>Click Here</a>";
      $message="Сегодня в " . date("d.m.Y", $date)." на сайте
      Camagru был зарегистрирован пользователь указавший данный email.
      Для подтверждения регистрации необходимо перейти по ссылке, указанной ниже.
      Если вы не регистрировались на сайте - удалите данное письмо!
      Аккаунт будет действителен до
      ".date("d.m.Y",mktime(0,0,0,date("d",$date)+4,date("m",$date),date("Y",$date))).",  после чего
      данные будут удалены!
      Ссылка для активации:
      ->->->->->->->->->->->->->->
      <a href=\"http://" . $HTTP_HOST . "/registration/activate/checkSum=".$user['token']."\">Перейти</a>;
      ->->->->->->->->->->->->->->

      С уважением, автор проекта msarapii!
      Email для контактов:<a href=\"mailto: mykhailosarapii@gmail.com\"> mykhailosarapii@gmail.com </a>";

//Посылаем сообщение пользователю

      mail($user['email'],
          "Активация аккаунта",
          $message,
          "Content-Type: text/html; charset= utf-8",
          "From: mykhailosarapii@gmail.com");
    }

    public function check_token($token){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE users_info SET check_email=1 WHERE token = ?";
      $result = $link->prepare($sql);
      $result->execute(array($token));
      $rows = $result->rowCount();
      if ($rows != 1){
        $msg = "Ошибка!</br> Вы пытаетесь перейти по несуществующей ссылке! ";
        return($msg);
      }
    }
}
