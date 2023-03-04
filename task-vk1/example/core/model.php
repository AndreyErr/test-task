<?php

namespace core;
use redisAccessData;

abstract class model{

    use redisAccessData;

    // Проверяет статус пользователя для выполнения действия или вывода информации
    protected function checkAccess(string $typeOfInfo){
        // ...
    }
}