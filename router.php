<?php
// Faqat PHP ichki serveri orqali ishlatayotgan bo'lsak
if (php_sapi_name() === 'cli-server') {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $fullPath = __DIR__ . $urlPath;

    // Agar so'rov qilingan fayl yoki katalog mavjud bo'lsa — to'g'ridan-to'g'ri beramiz
    if (is_file($fullPath) || is_dir($fullPath)) {
        return false;
    }

    // Apache RewriteRule (.*) /index.php/$1 ga mos ravishda sozlash
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';
    $_SERVER['PHP_SELF'] = '/index.php';
    $_SERVER['PATH_INFO'] = $urlPath;
}

// index.php'ni ishga tushiramiz
require __DIR__ . '/index.php';
