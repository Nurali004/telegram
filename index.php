<?php
session_start();
// 1. Composer autoload (Telegram SDK va boshqa kutubxonalar uchun)
require __DIR__ . '/vendor/autoload.php';

// 2. O'z MVC autoload (controllers, models va boshqalar uchun)
spl_autoload_register(function ($class) {
    $classPath = str_replace("\\", "/", $class);
    $file = __DIR__ . '/' . $classPath . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// 3. MVC App ni ishga tushirish
$app = new vendor\frame\App();
$app->run();