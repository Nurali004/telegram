<?php
namespace controllers;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use vendor\frame\Controller;

class TelegramController extends Controller
{
    public $telegram;
    public $chat_id;
    public $location;
    public $contact;

    public function __construct(){

        $this->telegram = new api('8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw');
    }
    public function bot()
    {

//         $this->telegram->setWebhook(['url' => 'https://140bc15cd05e.ngrok-free.app/telegram/bot']);

     $request = $this->telegram->getWebhookUpdate();

        $message = $request->getMessage();
        $user = $message->getChat();
        $chat_id = $user->getId();
        $this->chat_id = $chat_id;
        $text = $message->getText();
        $this->location = $message['location'] ?? null;
        if ($message->getContact()){
            $contact = $message->getContact();
            $this->contact = $contact->getPhoneNumber();
        }

        $messageId = $message['message_id'];


        switch ($text) {
            case '/start':
                $this->showHomePage();
                break;

            case 'Bosh sahifa':
                $this->showHomePage();
                break;

            case 'Biz haqimizda':
                $this->showAboutPage();
                break;
            case 'Kontaktlar':
                $this->showContactPage();
                break;

            case 'Manzil':
                $this->showAddresstPage();
                break;

            case 'Tilni tanlash':
                $this->showLangPage();
                break;
            case Text::BUYURTMA_BERISH:
                $this->showProductsPage();
                break;
            case "Kabinet":
                $this->showKabinetPage();
                break;
            case "Ism":
                $this->showNamePage();
                break;
            case "Familya":
                $this->showSurnamePage();
                break;

            case "Telefon raqam":
                $this->showPhonePage();
                break;

            case '⬅️ Ortga':
                $this->showHomePage();
                break;
                default:
                    switch ($this->getPage()) {
                        case 'Language page':
                            $lang = $text;
                            $this->setLang($lang);
                            break;
                        case 'Ism':
                            if ($text == '⬅️ Ortga') {
                                $this->showHomePage();
                                die();
                            }
                            $this->namePage($text);
                            break;
                        case 'Surname':
                            if ($text == '⬅️ Ortga') {
                                $this->showHomePage();
                                die();
                            }
                            $this->surnamePage($text);
                            break;
                        case 'Telefon':
                            if ($text == '⬅️ Ortga') {
                                $this->showHomePage();
                                die();
                            }
                            $this->phonePage($text);
                            break;
                        case 'Kabinet page':
                            switch ($text) {
                                case Text::ORTGA:
                                    $this->showHomePage();
                                    break;
                                    }

                                case Text::PRODUCTS_PAGE:
                                    $this->productPage($text);
                                    break;
                                case Text::COUNT_PAGE:
                                    $this->countPage($text);
                                    break;
                                case Text::CONTACT_NUMBER_PAGE:
                                    $this->orderContactNumberPage($text);
                                    break;
                                case Text::ORDER_ADDRESS_PAGE:
                                    $this->orderAddressPage($text);
                                    break;
                    }
                    break;

        }
    }

   public function showNamePage(){
            $this->setPage('Ism');
            $this->sendMessage("Iltimos! Ismni kiriting");


   }

   public function namePage($text){
        $this->setName($text);
       $this->sendMessage("✅ Saqlandi.");
   }

    public function showSurnamePage(){
        $this->setPage('Surname');
        $this->sendMessage("Iltimos! Familyangizni kiriting");


    }

    public function surnamePage($text){
        $this->setSurName($text);
        $this->sendMessage("✅ Saqlandi.");
    }


    public function showPhonePage(){
        $this->setPage('Telefon');
        $this->sendMessage("Iltimos! Telefon raqamingizni kiriting");


    }

    public function phonePage($text){
        $this->setPhone($text);
        $this->sendMessage("✅ Saqlandi.");
    }


    public function showHomePage(){
        $this->setPage("Home page");
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
        ])
        ->row([
            Keyboard::Button(Text::BUYURTMA_BERISH),
        ])
        ;
        $text = "Salom bosh sahifaga xush kelibsiz";

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }
    public function showProductsPage(){
        $this->setPage(Text::PRODUCTS_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::NOTEBOOK),
                Keyboard::Button(Text::PHONE),
            ])
            ->row([
                Keyboard::Button(Text::ORTGA),
            ])
        ;
        $text = "Kerakli buyurtmalarni tanlang";

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }

    public function productPage($text){
        $this->setProduct($text);
        $this->showCountPage();
    }

    public function orderContactNumberPage($text = null){

        if ($this->contact){
            $text = $this->contact;
        }

        $this->setPhone($text);
        $this->showOrderAddressPage();
    }

    public function showCountPage(){
        $this->setPage(Text::COUNT_PAGE);

        $text = "Mahsulot sonini raqamda yoki tugmalarda kiriting";
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button('2'),
                Keyboard::Button('3'),
                Keyboard::Button('4')
            ])
            ->row([
                Keyboard::Button('5'),
                Keyboard::Button('6'),
                Keyboard::Button('7')
            ])
            ->row([
                Keyboard::Button('8'),
                Keyboard::Button('9'),
                Keyboard::Button('10')
            ]);

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }

    public function countPage($text){
        if ($text < 2 || $text > 30) {
            $this->sendMessage("Siz hamida 2 ta, ko'pi bilan 30 ta mahsulot buyurtma qilishingiz mumkin!");
            die();
        }
        $this->setCount($text);
        $this->showOrderContactNumberPage();
       // $this->showOrderAddressPage();
    }

    public function showOrderAddressPage(){
        $this->setPage(Text::ORDER_ADDRESS_PAGE);

        $text = "Yetkazib berish manzilini kiriting";

        $reply_markup = Keyboard::make(
            [
                'keyboard' => [
                    [
                        Keyboard::button([
                            'text'=>" 📍 Lokatsiyani yuborish",
                            'request_location' => true
                        ])
                    ]
                ],
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ]
        );


        $this->sendMessageWithKeyboard($text, $reply_markup);
    }
    public function showOrderContactNumberPage(){
        $this->setPage(Text::CONTACT_NUMBER_PAGE);

        $text = "Yetkazib berish uchun kontaktingizni kiriting";

        $reply_markup = Keyboard::make(
            [
                'keyboard' => [
                    [
                        Keyboard::button([
                            'text'=>"Kontakni yuborish",
                            'request_contact' => true
                        ])
                    ]
                ],
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ]
        );


        $this->sendMessageWithKeyboard($text, $reply_markup);
    }

    public function orderAddressPage($text){

        if (!is_null($this->location)){
            $text = $this->location;
            $address = "<a href='https://maps.yandex.ru/?pt={$this->location['longitude']},{$this->location['latitude']}'>Lokatsiya</a>";
        }else{
            $address = $this->getOrderAddress();
        }
        $this->setOrderAddress($text);
        $text = " ✅ Buyurtma saqlandi. ";
        $this->sendMessage($text);

        $product = $this->getProduct();
        $count = $this->getCount();
        $number = $this->getPhone();

        $order_text = "Yangi buyurtma qabul qilindi\n\n";
        $order_text .= "Mahsulot: {$product}\n";
        $order_text .= "Soni: {$count}\n";
        $order_text .= "Telefon Number: {$number}\n";
        $order_text .= "Adres: {$address}\n";
        $this->sendMessage($order_text, 6989752538);

        $this->showHomePage();
    }

    public function showKabinetPage(){
        $this->setPage("Kabinet page");
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
            ])
            ->row([
                Keyboard::Button(Text::ORTGA)
            ]);

        $name = $this->getName();
        $surname = $this->getSurname();
        $phone = $this->getPhone();


        $text = "Salom Kabinetga xush kelibsiz\n\n";
        $text .= "Ma'lumotlaringiz:\n\n"."Name: $name\n\n Familiya: $surname\n\n Telefon: $phone";

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }


    public function showLangPage(){
        $this->setPage("Language page");
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

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }
    public function showAboutPage(){
        $this->setPage("About page");

        $text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

        $this->sendMessage($text);

    }

    public function showContactPage(){
        $this->setPage("Contact page");

      $text = "<b>Telefonlar</b>:\n+998992907704\n+998989907704\n+998989907704";
      $text .= "\n\n<b>Telegram</b>:\n@programmer_004\n@developer_004";
        $this->sendMessage($text);

    }

    public function showAddresstPage(){
        $this->setPage("Address page");
        $text = "Manzillar:\n Samarqand viloyati Samarqand shahar rudakiy 84";
        $this->sendMessage($text);

    }

    public function sendMessageWithKeyboard($text,$reply_markup){

        $this->telegram->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup,

        ]);

    }

    public function sendMessageWithKeyboardOrder($text,$reply_markup){

        $this->telegram->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup,

        ]);

    }

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

    public function setPage($page){
       $this->setKey('page',$page);
    }
    public function getPage(){
       return $this->getKey('page');
    }

    public function setPhone($phone){
        $this->setKey('phone',$phone);
    }
    public function getPhone(){
        return $this->getKey('phone');
    }

    public function setName($name){
        $this->setKey('name',$name);
    }
    public function getName(){
        return $this->getKey('name');
    }

    public function setCount($count){
        $this->setKey('count',$count);
    }
    public function getCount(){
        return $this->getKey('count');
    }
    public function setOrderAddress($address){
        $this->setKey('address',$address);
    }
    public function getOrderAddress(){
        return $this->getKey('address');
    }

    public function setOrderContactNumberPage($number){
        $this->setKey('number',$number);
    }
    public function getOrderContactNumberPage(){
        return $this->getKey('number');
    }


    public function setProduct($product){
        $this->setKey('product',$product);
    }
    public function getProduct(){
        return $this->getKey('product');
    }

    public function setSurName($surname){
        $this->setKey('surname',$surname);
    }
    public function getSurName(){
        return $this->getKey('surname');
    }

    public function setLang($lang){
        $this->setKey('lang',$lang);
    }
    public function getLang(){
       return $this->getKey('lang');
    }
    public function setKey($key, $value){
       $arr = json_decode(file_get_contents($this->chat_id . ".txt", $key), true);
       $arr[$key] = $value;
       file_put_contents($this->chat_id . ".txt", json_encode($arr));
    }
    public function getKey($key){
        $arr = json_decode(file_get_contents($this->chat_id . ".txt", $key), true);
        return $arr[$key] ?? '';
    }
}