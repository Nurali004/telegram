<?php

namespace controllers;

use vendor\frame\Controller;

class TelegramController extends Controller
{
    public function bot(){

        $token = '8462375190:AAF7Jzqrc6p5zoRCfZgTOPzGLVAfF-JcVek';
        $apiUrl = 'https://api.telegram.org/bot'.$token.'/';
        $updates = file_get_contents("{$apiUrl}getUpdates");
        $updatesArray = json_decode($updates, true);

        $lastMessage = end($updatesArray['result']);
        $chat_id = $lastMessage['message']['chat']['id'];
        $text = $lastMessage['message']['text'];

        $text = "siz shu habarni yubordingiz:".$text;

        $this->sendMessage("{$apiUrl}sendMessage", $chat_id, $text);

    }

    public function sendMessage($url, $chat_id, $text){
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
        ];
        $url = $url.'?'.http_build_query($data);
        file_get_contents($url);
    }
}