<?php

// Точка входа

namespace core;

session_start();

require_once 'settings/access.php'; // Для проверки доступа
require_once 'settings/connect.php'; // Для бд
require_once 'lib/security.php'; // Безопасность некоторых данных

date_default_timezone_set("Europe/Moscow");

// Автоподключение классов
spl_autoload_register(function ($class) {
    // ...
});

// Вызов роутера
$app = new router;