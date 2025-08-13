<?php

namespace controllers;

use models\Userbot;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use vendor\frame\Controller;

class ShopController extends Controller
{
    public $telegram;
    public $chat_id;
    public $first_name;
    public $last_name;
    public $username;
    public $location;
    public $contact;
    public $text;

    public function __construct(){
        $this->telegram = new api('8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw');

    }
    public function start()
    {
//        $this->telegram->setWebhook(['url' => 'https://140bc15cd05e.ngrok-free.app/shop/start']);
//        die();
        $request = $this->telegram->getWebhookUpdate();
        $message = $request->getMessage();
        $user = $message->getChat();

        $this->chat_id = $user->getId();
        $this->text = $message->getText();
        $this->first_name = $user->getFirstName();
        $this->last_name = $user->getLastName();
        $this->username = $user->getUsername();
        $this->location = $message['location'] ?? null;
        if ($message->getContact()){
            $contact = $message->getContact();
            $this->contact = $contact->getPhoneNumber();
        }


        $this->addUser();

        switch ($this->text){
            case '/start':
                $this->showHomePage();
                break;
            default:
                //$this->default();
                break;
        }


    }






//    ********* Show PAGES
    public function showHomePage(){
        $this->setPage(Page::HOMEPAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button('🛒 Katalog'),
                Keyboard::Button('🔍 Qidirish')
            ])
            ->row([
                Keyboard::Button('📦 Mening buyurtmalarim'),
                Keyboard::Button('ℹ️ Biz haqimizda')
            ])
        ;
        $text = "🛍 Online Magazin Bot Mahsulotlarni tanlang yoki qidiruvdan foydalaning.";

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }
//    ********** END Show PAGES





//  *********** TELEGRAM FUNCTIONS
    public function sendMessageRemoveKeyboard($text){

        $this->telegram->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => Keyboard::remove()

        ]);

    }
    public function sendMessage($text, $chat_id = null){
        if (is_null($chat_id)) {
            $chat_id = $this->chat_id;
        }
        $this->telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true
        ]);
    }
    public function sendMessageWithKeyboard($text,$reply_markup){

        $this->telegram->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]);

    }
//  *********** END TELEGRAM FUNCTIONS




//  ********** DB FUNCTIONS

    public function addUser()
    {
        $user = new Userbot();
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'chat_id' => $this->chat_id,
        ];
        $user->save($data);
    }

    public function setPage($page){
    }
    public function getPage(){
    }

//  ********** END DB FUNCTIONS


}