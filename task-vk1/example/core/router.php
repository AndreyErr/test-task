<?php

namespace core;
use redisAccessData;
use security;

class router{
    use redisAccessData{ selectData as private; }
    use security;

    public function __construct(){
        // Получение информации о вызываемом пути
        $this->router($path);
    }
    // Выбор контроллера
    private function router(string $path){
        // ...
        // Проверки существования контроллера и модели
        // Проверка доступа к модулю
        // Подключение контроллера
        // Для нашего случая:
        new storeC;
    }

    // Проверка существования контроллера
    private function checkController(string $path): bool{
        // ...
    }

    // Проверка существования модели
    private function checkModel(string $path): bool{
        // ...
    }

    // Проверка на доступ к модулю
    private function chAccess(string $module): bool{
        // ...
    }
}