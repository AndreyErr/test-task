<?php

namespace core;

abstract class controller{

    // Путь, разбитый на массив
    protected $path;
    // Объект модели
    protected $model;

    // Выбираем действие исходя из запроса
    abstract protected function actionSelect(string $path);
    
    // Получаем путь и модель
    public function __construct(){
        // ...
        // Модель задаём здесь
        $this->model = new storeM;
    }

    // Конвертирует данные в JSON и отправляет их в представление
    public function sendData(array $data){
        // ...
    }
}