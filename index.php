<?php
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

<<<<<<< HEAD
// 3. MVC App ni ishga tushirish
$app = new vendor\frame\App();
=======
require_once("vendor/frame/App.php");
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/autoload.php";


$app = new App();
>>>>>>> 508f52b7fa4209aaa11d353103462605d45e520f
$app->run();