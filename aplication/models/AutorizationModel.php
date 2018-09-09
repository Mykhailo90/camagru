<?php

namespace aplication\models;

use aplication\core\Model;
use aplication\lib\Registry;
use PDO;

class AutorizationModel extends Model
{

    public function get_data()
    {
        $allData = array('navMenu' => 'test',
                        'programs' => '$programs',
                        'filterType' => '$filterType',
                        'filterForWhom' => '$filterForWhom',
                        'filterSubjects' => '$filterSubjects',
                        'filterTrainer' => '$filterTrainer',
                        );
        return $allData;
    }

    public function search_user($user){
      $link = Registry::getInstance()->getProperty('DB');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT user_id, name, email, user_password  FROM users_info
              WHERE email = ? AND check_email = 1";
      $result = $link->prepare($sql);
      $result->execute(array($user['email']));
      $res = $result->fetch(PDO::FETCH_ASSOC);

      if (password_verify($user['psw'], $res['user_password'])){
        return ($res);
      }
      else{
        echo "Вы ввели неверный логин или пароль! Повторите пожалуйста попытку
                или пройдите процесс регистрации на сайте!!!";
        exit();
      }

    }
}
