<?php

namespace controllers;

use vendor\frame\Controller;

class TelegramController extends Controller
{

    public $url;

    public function __construct(){
        $token = '8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw';
        $this->url = 'https://api.telegram.org/bot'.$token.'/';

    }
    public function bot(){

        $content = file_get_contents('php://input');
        $update = json_decode($content, true);

        $chat_id = $update['message']['chat']['id'] ?? null;
        $text = $update['message']['text'] ?? '';

        if($text == 'Qalin' && $chat_id){
            $reply = "<b>". $text. "</b>";
            $this->sendMessage($chat_id, $reply);
        }elseif($text == 'Yotiq' && $chat_id){
            $reply = "<i>". $text. "</i>";
            $this->sendMessage($chat_id, $reply);
        }elseif($text == 'Pastgi chiziq' && $chat_id){
            $reply = "<u>". $text. "</u>";
            $this->sendMessage($chat_id, $reply);
        }elseif($text == 'Yotiq va Qalin' && $chat_id){
            $reply = "<b>".'<i>'. $text. '</i>'."</b>";
            $this->sendMessage($chat_id, $reply);
        }elseif($text == 'Yashirin' && $chat_id){
            $reply = $text.'<span class="tg-spoiler">Yashirin</span>';
            $this->sendMessage($chat_id, $reply);
        }elseif($text == 'Havola' && $chat_id){
            $reply = $text.'<a href="https://1.nugaev.uz">Bizning sayt</a>';
            $this->sendMessage($chat_id, $reply);
        }elseif($text == 'User' && $chat_id){
            $reply = '<a href="tg://user?id=6989752538">Nurali Mavzurov</a>';
            $this->sendMessage($chat_id, $reply);
        }elseif($text == 'Photo' && $chat_id){
            $reply = 'Bu PHP Photo :';
            $this->sendPhoto($chat_id, $reply, 'https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cGhwfGVufDB8fDB8fHww');
        }




    }

    public function sendMessage($chat_id, $text){
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'HTML'
        ];

        file_get_contents("{$this->url}sendMessage?". http_build_query($data));

    }

    public function sendPhoto($chat_id, $text, $photo){
        $data = [
            'chat_id' => $chat_id,
            'caption' => $text,
            'photo'=> $photo,
            'parse_mode' => 'HTML'
        ];

        file_get_contents("{$this->url}sendPhoto?". http_build_query($data));

    }
}