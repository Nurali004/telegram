<?php

//spl_autoload_register(function ($class) {
//    // namespace'dagi "\" larni "/" ga aylantiramiz
//    $classPath = str_replace("\\", "/", $class);
//    $file = __DIR__ . '/' . $classPath . '.php';
//
//    if (file_exists($file)) {
//        require_once $file;
//    } else {
//        throw new Exception("Class file not found: $file");
//    }
//});



spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    require_once __DIR__ . '/' . $class . '.php';
});


