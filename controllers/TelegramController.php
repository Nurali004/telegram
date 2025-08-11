<?php
namespace controllers;
use Telegram\Bot\Actions;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use vendor\frame\Controller;

class TelegramController extends Controller
{
    public $telegram;

    public function __construct(){

        $this->telegram = new api('8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw');
    }
    public function bot()
    {
        $request = $this->telegram->getWebhookUpdate();

        $message = $request->getMessage();
        $user = $message->getChat();
        $chat_id = $user->getId();
        $text = $message->getText();
        $messageId = $message['message_id'];


        switch ($text) {
            case '/start':
                $this->showHomePage($chat_id);
                break;

            case 'Bosh sahifa':
                $this->showHomePage($chat_id);
                break;

            case 'Biz haqimizda':
                $this->showAboutPage($chat_id);
                break;
            case 'Kontaktlar':
                $this->showContactPage($chat_id);
                break;

            case 'Manzil':
                $this->showAddresstPage($chat_id);
                break;

            case 'Tilni tanlash':
                $this->showLangPage($chat_id);
                break;
            case "Kabinet":
                $this->showKabinetPage($chat_id);
                break;
            case "Ism":
                $this->showNamePage($chat_id, $text);
                break;
            case "Familya":
                $this->showSurnamePage($chat_id, $text);
                break;

            case "Telefon raqam":
                $this->showPhonePage($chat_id, $text);
                break;

            case '⬅️ Ortga':
                $this->showHomePage($chat_id);
                break;
                default:
                    switch ($this->GetLang($chat_id)) {
                        case 'Language page':
                            $lang = $text;
                            $this->SetLang($chat_id, $lang);
                            break;
                    }

        }
    }

   public function showNamePage($chat_id, $text){
        $register = $chat_id . "register.text";
        if ($text == 'Ism') {
            file_put_contents($register, "Ismni kiriting");
            $this->SendMessage($chat_id, "Iltimos! Ismni kiriting");
            return;
        }

        if(file_exists($register) && file_get_contents($register) == "Ismni kiriting"){
            file_put_contents($chat_id . "name.text", $text);
            file_put_contents($register, "done");
            $this->SendMessage($chat_id, "Rahmat! Ismingiz saqlandi: " . $text);
        }
   }

    public function showSurnamePage($chat_id, $text){
        $register = $chat_id . "register.text";
        if ($text == 'Familya') {
            file_put_contents($register, "Familyani kiriting");
            $this->SendMessage($chat_id, "Rahmat endi! Familyani kiriting");
            return;
        }

        if(file_exists($register) && file_get_contents($register) == "Familyani kiriting"){
            file_put_contents($chat_id . "surname.text", $text);
            file_put_contents($register, "done");
            $this->SendMessage($chat_id, "Rahmat! Familyangiz saqlandi". $text);
        }
    }
    public function showPhonePage($chat_id, $text)
    {
        $register = $chat_id . "register.text";
        if ($text == 'Telefon raqam') {
            file_put_contents($register, "Telefon raqam kiriting");
            $this->SendMessage($chat_id, "Rahmat endi! Telefon raqam kiriting");
            return;
        }

        if(file_exists($register) && file_get_contents($register) == "Telefon raqam kiriting"){
            file_put_contents($chat_id . "phone.text", $text);
            file_put_contents($register, "done");

           $name = file_get_contents($chat_id . "name.text");
           $surname = file_get_contents($chat_id . "surname.text");
           $phone = file_get_contents($chat_id . "phone.text");
           $this->SendMessage($chat_id, "Rahmat! Ma'lumotlaringiz saqlandi");
           $this->SendMessage($chat_id, "Rahmat! Siz tizimdan muvaffaqiyatli ro'yxatdan o'tdingiz \n\n".$name." ".$surname." ".$phone);
        }
    }
    public function showHomePage($chat_id){
        $this->SetPage($chat_id,"Home page");
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button('Bosh sahifa'),
                Keyboard::Button('Biz haqimizda')
            ])
            ->row([
                Keyboard::Button('Kontaktlar'),
                Keyboard::Button('Manzil')
            ])
        ->row([
            Keyboard::Button('Tilni tanlash'),
            Keyboard::Button('Kabinet')
        ]);
        $text = "Salom bosh sahifaga xush kelibsiz";

        $this->sendMessageWithKeyboard($chat_id, $text, $reply_markup);

    }

    public function showKabinetPage($chat_id){
        $this->SetPage($chat_id,"Kabinet page");
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button('Ism')
            ])
            ->row([
                Keyboard::Button('Familya')
            ])
            ->row([
                Keyboard::Button('Telefon raqam')
            ]);
        $text = "Salom Kabinetga xush kelibsiz";

        $this->sendMessageWithKeyboard($chat_id, $text, $reply_markup);

    }

    public function showLangPage($chat_id){
        $this->SetPage($chat_id,"Language page");
        $this->SetLang($chat_id, "Language page");
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button("Uzbek language"),
                Keyboard::Button("English language")
            ])
            ->row([
                Keyboard::Button('Russian language'),
                Keyboard::Button('Germany language')
            ])
            ->row([
                Keyboard::Button('⬅️ Ortga'),

            ]);

        $text = "Kerakli tilni tanlang!";

        $this->sendMessageWithKeyboard($chat_id, $text, $reply_markup);

    }
    public function showAboutPage($chat_id){
        $this->SetPage($chat_id,"About page");

        $text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

        $this->sendMessage($chat_id, $text);

    }

    public function showContactPage($chat_id){
        $this->SetPage($chat_id,"Contact page");

      $text = "<b>Telefonlar</b>:\n+998992907704\n+998989907704\n+998989907704";
      $text .= "\n\n<b>Telegram</b>:\n@programmer_004\n@developer_004";
        $this->sendMessage($chat_id, $text);

    }

    public function showAddresstPage($chat_id){
        $this->SetPage($chat_id,"Address page");
        $text = "Manzillar:\n Samarqand viloyati Samarqand shahar rudakiy 84";
        $this->sendMessage($chat_id, $text);

    }

    public function sendMessageWithKeyboard($chat_id, $text,$reply_markup){

        $this->telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup,

        ]);

    }

    public function SendMessage($chat_id, $text){

         $this->telegram->sendMessage([
             'chat_id' => $chat_id,
             'text' => $text,
             'parse_mode' => 'HTML'
         ]);
    }

    public function SetPage($chat_id,$page){
        file_put_contents($chat_id . "page.txt", $page);
    }
    public function GetPage($chat_id){
       return file_get_contents($chat_id . "page.txt" );
    }

    public function SetLang($chat_id,$lang){
        file_put_contents($chat_id . "lang.txt", $lang);
    }
    public function GetLang($chat_id){
        return file_get_contents($chat_id . "lang.txt" );
    }
}