<?php
// Устанавливаем путь к конфигурациооным файлам
  $path_to_config = 'aplication/config/db_access.php';

// Проверяем наличие данного файла и в случае отсутствия - сообщаем об этом
  if (file_exists($path_to_config)){

// Загружаем настройки для подключения к базе данных
    $configs = include $path_to_config;

// Инициализируем переменные параметрами для подключения к бд
    $servername = "127.0.0.1";
    $username = $configs['DB_USER'];
    $password = $configs['DB_PASSWORD'];
    $db_name = "camagru";

    try {
// Подключаемся к mysql данных для создания БД
      $conn = new PDO("mysql:host=$servername", $username, $password);
// Устанавливаем значения для вывода ошибок
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Если база данных не создана - создаем указанную бд
      $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
      $conn->exec($sql);
      echo "База данных успешно создана!\n";
    }
    catch(PDOException $e)
    {
// Иначе выводим ошибку
      echo $sql . "<br>" . $e->getMessage();
    }
// Закрываем соединение
    $conn = null;

    try {
// Подключаемся к бд для создания таблиц
      $db = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
// Устанавливаем конфигурации вывода ошибок
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Сообщаем об успешном подключении
      echo "Вы успешно подключились к Базе данных\n";
      }
      catch(PDOException $e)
      {
// Иначе выводим ошибку
        echo "Ошибка при подключении: " . $e->getMessage();
      }
// Считываем код инициализации в буфер
      $sql = file_get_contents("$db_name.sql");
// Выполняем запрос на инициализацию
      $db->exec($sql);
// Создаем хранимые процедуры
      $sql = 'CREATE PROCEDURE path_in_program() READS SQL DATA BEGIN SELECT path FROM path; END;';
      $db->exec($sql);
    echo "База данных успешно инсталирована\n";
  }
  else {
    echo "Операция недоступна\n";
    echo "На данный момент инициализация Базы Данных невозможна.\n";
    echo "На сервере проводятся технические работы.\n";
    echo "Повторите попытку позже.\n";
  }
