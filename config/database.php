<?php
// Задаем константы:


// разделитель для путей к файлам
define ('DS', DIRECTORY_SEPARATOR);

// путь к корневой папке сайта
$sitePath = realpath(dirname(__FILE__) . DS);
define ('SITE_PATH', $sitePath);

$DB_DSN = "mysql:host=localhost;dbname=camagru";
$DB_USER = "msarapii";
$DB_PASSWORD = "Inn3315400371";



?>
