<?php

namespace controllers;

use vendor\frame\Controller;

class TelegramController extends Controller
{
    public function bot(){

        $token = '8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw';
        $apiUrl = 'https://api.telegram.org/bot'.$token.'/';

        $content = file_get_contents('php://input');
        $update = json_decode($content, true);

        $chat_id = $update['message']['chat']['id'] ?? null;
        $text = $update['message']['text'] ?? '';

        if ($chat_id && $text) {
            $reply = "Siz yozdingiz: " . $text;
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&text=" . urlencode($reply));

        }

    }
}