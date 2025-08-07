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

        if($text == 'Qalin' && $chat_id){
            $reply = "<b>". $text. "</b>";
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }elseif($text == 'Yotiq' && $chat_id){
            $reply = "<i>". $text. "</i>";
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }elseif($text == 'Pastgi chiziq' && $chat_id){
            $reply = "<u>". $text. "</u>";
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }elseif($text == 'Yotiq va Qalin' && $chat_id){
            $reply = "<b>".'<i>'. $text. '</i>'."</b>";
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }elseif($text == 'Yashirin' && $chat_id){
            $reply = $text.'<span class="tg-spoiler">Yashirin</span>';
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }elseif($text == 'Havola' && $chat_id){
            $reply = $text.'<a href="https://1.nugaev.uz">Bizning sayt</a>';
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }elseif($text == 'User' && $chat_id){
            $reply = '<a href="tg://user?id=6989752538">Nurali Mavzurov</a>';
            file_get_contents("{$apiUrl}sendMessage?chat_id=$chat_id&parse_mode=HTML&text=" . urlencode($reply));
        }



    }
}