<?php
/**
 * Класс для создания единственного объкта с "глобальными переменными"
 */
class Preferences{
  // Переменная для объекта хранения глобальных переменных
  private static $instance;

  // Ассоциативный массив для хранения глобальных значений
  private $props = array();
  //Закрытый конструктор для создания объекта типа Singleton
  private function __construct(){};
  //Открытый статический метод для создания единственного экземпляра
  //Возвращает указатель на Объект с ассоциативным массивом
  public static function getInstance(){
    if (empty(self::$instance)){
      self::$instance = new Preferences();
    }
    return self::$instance;
  }
  // Открытый метод для задания пар "ключ-значение"
  public function setProperty($key, $val){
    $this->props[$key] = $val;
  }
  // Метод для получения значения по ключу
  public function getProperty($key){
    if (isset($this->props[$key])){
      return $this->props[$key];
    }
    return null;
  }
}

?>
