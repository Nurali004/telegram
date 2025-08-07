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

        if($text == 'qalin' && $chat_id){
            $reply = "<b>". $text. "</b>" . $text;
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }elseif($text == 'yotiq' && $chat_id){
            $reply = "<i>Siz yozdingiz: </i>" . $text;
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }



    }
}