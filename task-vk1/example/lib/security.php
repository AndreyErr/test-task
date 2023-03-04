<?php

trait security {

    // Хеширование пароля
    protected function hashPass(string $pass): string{
        // ...
    }

    // Кодирование строки
    protected function encode(string $str): string{
        // ...
    }

    // Декодирование строки
    protected function decode(string $str): string{
        // ...
    }
}