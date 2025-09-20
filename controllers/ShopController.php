<?php
namespace controllers;
use models\AudioModel;
use models\Category;
use models\Product;
use models\UserBot;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\Audio;
use vendor\frame\Controller;

class ShopController extends Controller
{
    public $telegram;
    public $message;
    public $first_name;
    public $last_name;

    public $username;

    public $update;
    public $chat_id;

    public $location;
    public $contact;

    public $text;
    public function __construct(){

        $this->telegram = new api('8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw');


    }
  public function start(){

//    $rs =   $this->telegram->setWebhook(['url'=>'https://0adaee44b141.ngrok-free.app/shop/start']);
//    var_dump($rs);
//       die();


      $this->getDatas();




      switch ($this->text) {
          case '/start':
              $this->showHomePage();
              break;
          case Text::ABOUT_TEXT:
              break;
          case Text::MY_ORDER:
              break;
          case Text::SEARCH_TEXT:
              break;

          case Text::KATALOG_TEXT:
              break;
          case Text::MUSIC_TEXT:
              $this->showMusicPage();
              break;

          case Text::ADMIN_PANEL:
              $this->showAdminPanelPage();
              break;
          default:
          switch ($this->getPage()) {
              case Page::ADMIN_PANEL_PAGE:
                  switch ($this->text) {
                      case Text::BACK_TEXT:
                          $this->showHomePage();
                          break;
                      case Text::ADD_PRODUCT:
                          $this->showAddProductNamePage();
                          break;
                      case Text::EDIT_PRODUCT:
                        //  $this->showEditProductPage();
                          break;
                      case Text::ORDER_PRODUCTS:
                       //   $this->showOrdersPage();
                          break;
                      case Text::SETTINGS:
                       //   $this->showSettingsProductPage();
                          break;
                      case Text::ADD_CATEGORY:
                          $this->showAddCategoryNamePage();
                          break;


                  }
                  break;
              case Page::INPUT_PRODUCT_NAME_PAGE:
                  switch ($this->text) {
                      case Text::BACK_TEXT:
                          $this->showAdminPanelPage();
                          break;
                      default:
                          $this->setKey('productName',$this->text);
                          $this->showAddProductPricePage();
                          break;
                  }
                  break;
              case Page::INPUT_PRODUCT_PRICE_PAGE:
                  switch ($this->text) {
                      case Text::BACK_TEXT:
                          $this->showAddProductNamePage();
                          break;
                      default:
                          $this->setKey('productPrice',$this->text);
                          $this->showAddProductImagePage();
                          break;
                  }
                  break;
              case Page::INPUT_PRODUCT_IMAGE_PAGE:
                  switch ($this->text) {
                      case Text::BACK_TEXT:
                          $this->showAddProductpricePage();
                          break;
                      default:
                         $this->showAddProductImageActions();

                          break;
                  }
                  break;
              case Page::INPUT_PRODUCT_DESC_PAGE:
                  switch ($this->text) {
                      case Text::BACK_TEXT:
                          $this->showAddProductImagePage();
                          break;
                      default:

                          $this->setKey('productDesc',$this->text);
                          $product = new Product();

//                          $this->sendMessage(123);
//                          exit();


                          $data = [
                              'category_id'=> 1,
                              'name'=> $this->getKey('productName'),
                              'price'=> $this->getKey('productPrice'),
                              'image'=> $this->getKey('productImage'),
                              'description'=> $this->text,
                              'in_stock'=> 1
                          ];
                          $product->save($data);
                          $this->sendMessage(Text::PRODUCT_INSERTED_TEXT);
                          $this->showHomePage();
                          break;
                  }
                  break;
              case Page::INPUT_CATEGORY_NAME_PAGE:
                  switch ($this->text) {
                      case Text::BACK_TEXT:
                          $this->showAdminPanelPage();
                          break;
                      default:

                          $this->setKey('CategoryName',$this->text);
                          $category = new Category();
                          $data = [
                             'name'=> $this->getKey('CategoryName'),
                          ];
                          $category->save($data);
                          $this->sendMessage(Text::CATEGORY_INSERTED_TEXT);
                          $this->showHomePage();
                          break;
                  }
                  break;

              case Page::MUSIC_PAGE:
                  if ($this->text == Text::BACK_TEXT) {
                      $this->showHomePage();
                  } else {

                      $this->showMusic();
                  }
                  break;

          }
              break;



      }

  }


  //********************* SHOW PAGES



    public function showMusicPage(){

        $this->setPage(Page::MUSIC_PAGE);
        $this->sendMessage(Text::MUSIC_TEXT_SHOW);

    }



    public function sendAudioMessage($audio, $caption = "", $isFileId = false){
    $params = [
        'chat_id' => $this->chat_id,
        'caption' => $caption,
        'parse_mode' => 'HTML'
    ];

    if ($isFileId) {

        $params['audio'] = $audio;
    } else {

        $params['audio'] = InputFile::create($audio);
    }

    $response = $this->telegram->sendAudio($params);


    if ($response->getAudio()) {
        return $response->getAudio()->getFileId();
    }

    return null;
}


    public function showMusic(){

        $url = $this->text;
        $videoId = null;

        //  https://youtu.be/L1dNtXsYgto?si=9Xj-q3LM2-x61JSC  music url
        //  https://youtu.be/8DuaCN__51g?si=u-5S0KtVl8E3FfKM

        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            $videoId = $params['v'] ?? null;
            if (!$videoId && strpos($url, 'youtu.be') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $videoId = ltrim($path, '/');
            }elseif (!$videoId && strpos($url, '/shorts/') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $parts = explode('/', trim($path, '/'));
                $videoId = $parts[count($parts) - 1];
            }elseif (!$videoId && strpos($url, 'youtu.be/') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $parts = explode('/', trim($path, '/'));
                $videoId = $parts[0];
            }elseif (!$videoId && strpos($url, 'watch?v=') !== false && strpos($url, 'www.youtube.com') !== false) {
                parse_str(parse_url($url, PHP_URL_QUERY), $query);
                if (isset($query['v'])) {
                    $videoId = $query['v'];
                }
            }



        }

        if (!$videoId) {
            $this->sendMessage("❌ Iltimos, YouTube linkini to‘g‘ri yuboring.");
            return;
        }

        $audioModel = new AudioModel();
        $song = $audioModel->getByVideoId($videoId);

        if ($song) {
            $size = round($song->filesize / 1024 / 1024, 2) . ' MB';
            $caption = "🎵 <b>{$song->title}</b>\n";
            $caption .= "📦 Hajmi: {$size}\n";

            if (!empty($song->file_id)) {

                $this->sendAudioMessage($song->file_id, $caption, true);
            } else {

                $this->sendAudioMessage($song->link, $caption);
            }
            return;
        }


        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://youtube-mp36.p.rapidapi.com/dl?id=" . $videoId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: youtube-mp36.p.rapidapi.com",
                "x-rapidapi-key: c65ee05e90msha747563874734c6p1ed25djsne8bce8ddb241"
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        if (isset($data['link'])) {
            $size = round($data['filesize'] / 1024 / 1024, 2) . ' MB';
            $caption = "🎵 <b>{$data['title']}</b>\n";
            $caption .= "📦 Hajmi: {$size}\n";


            $fileId = $this->sendAudioMessage($data['link'], $caption);


            $saveData = [
                'videoId' => $videoId,
                'link' => $data['link'],
                'title' => $data['title'],
                'file_id' => $fileId,
                'filesize' => $data['filesize'],
            ];
            $audioModel->save($saveData);

        } else {
            $this->sendMessage("❌ Qo‘shiqni yuklab bo‘lmadi.");
        }
    }


    public function showHomePage(){
        $this->setPage(Page::HOME_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::KATALOG_TEXT),
                Keyboard::Button(Text::SEARCH_TEXT),
            ])
            ->row([
                Keyboard::Button(Text::MY_ORDER),
                Keyboard::Button(Text::ABOUT_TEXT)
            ])
            ->row([
                Keyboard::Button(Text::MUSIC_TEXT),
            ]);

        if($this->isAdmin()){
            $reply_markup->row([
                Keyboard::Button(Text::ADMIN_PANEL),
            ]);
        }


        $text = Text::HELLO_TEXT;

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }



    // ************* END SHOW PAGES

    // ************* ADMIN SHOW PAGES

    public function showAdminPanelPage(){
        if ($this->isAdmin()) {
            $this->setPage(Page::ADMIN_PANEL_PAGE);
            $reply_markup = Keyboard::make()
                ->setResizeKeyboard(true)
                ->row([
                    Keyboard::Button(Text::ADD_PRODUCT),
                    Keyboard::Button(Text::EDIT_PRODUCT),
                ])
                ->row([
                    Keyboard::Button(Text::ORDER_PRODUCTS),
                    Keyboard::Button(Text::SETTINGS),
                ])
                ->row([
                    Keyboard::Button(Text::ADD_CATEGORY),
                ])
                ->row([
                    Keyboard::Button(Text::BACK_TEXT),
                ]);

            $text = Text::ADMIN_TEXT;

            $this->sendMessageWithKeyboard($text, $reply_markup);

        }
    }
    public function showAddProductNamePage(){
        $this->setPage(Page::INPUT_PRODUCT_NAME_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_PRODUCT_NAME_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }
    public function showAddCategoryNamePage(){
        $this->setPage(Page::INPUT_CATEGORY_NAME_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_CATEGORY_NAME_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }
    public function showAddProductpricePage(){
        $this->setPage(Page::INPUT_PRODUCT_PRICE_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_PRODUCT_PRICE_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }
    public function showAddProductImagePage(){
        $this->setPage(Page::INPUT_PRODUCT_IMAGE_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_PRODUCT_IMAGE_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }
    public function showAddProductDescPage(){
        $this->setPage(Page::INPUT_PRODUCT_DESC_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_PRODUCT_DESC_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }
    public function showAddProductImageActions()
    {
        if ($this->message->has('photo')){
            $photos = $this->message->getPhoto();
            $photos = json_decode($photos,true);
            $photo = end($photos);

            $this->setKey('productImage', $photo['file_id']);
            $this->showAddProductDescPage();
        }else{
            $this->sendMessage("kechirasiz bu yerga faqat rasim yuborish mumkin!");
        }
    }
    // ************* END ADMIN SHOW PAGES



    //********* TELEGRAM FUNCTIONS

    public function getDatas(){



        $request = $this->telegram->getWebhookUpdate();

        $message = $request->getMessage();
        $this->message = $message;
        $user = $message->getChat();
        $chat_id = $user->getId();
        $this->chat_id = $chat_id;

        $this->text = $message->getText();
        $this->first_name = $user->getFirstName();
        $this->last_name = $user->getLastName();
        $this->username = $user->getUsername();
        $this->location = $message['location'] ?? null;
        if($message->getContact()){
            $contact = $message->getContact();
            $phoneNumber = $contact->getPhoneNumber();
            $this->contact = $phoneNumber;
        }
        $messageId = $message['message_id'];

        if(!$this->isUser()){
            $this->addUser();
        }

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
    public function sendMessageWithKeyboard($text,$reply_markup){

        $this->telegram->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup,

        ]);

    }

    //********* END TELEGRAM FUNCTIONS

    //********* DB FUNCTIONS

    public function addUser(){
        $user = new UserBot();
        if(is_null($this->last_name)){
            $this->last_name = "";
        }
        $data = [
            'chat_id' => $this->chat_id,
            'firstname' => $this->first_name,
            'lastname' => $this->last_name,
            'username' => $this->username,
        ];
         $user->save($data);

    }

    public function isAdmin(){
        $userbot = new UserBot();
       $user = $userbot->getByChatId($this->chat_id);
        if($user->is_admin){
            return true;
        }
        return false;
    }

   public function isUser()
   {
      $userbot = new UserBot();

      if($userbot->getByChatId($this->chat_id)){
          return true;
      }else{
          return false;
      }

   }
    public function setPage($page){
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        $data = [
            'step'=>$page,
        ];
        $userbot->update($user->id,$data);

    }
    public function getPage(){
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        return $user->step;

    }

    public function setKey($key, $value){
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        $arr_data = json_decode($user->data,true);
        $arr_data[$key] = $value;
        $data = [
            'data'=>json_encode($arr_data)
        ];
        $userbot->update($user->id,$data);



    }
    public function getKey($key){
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        $arr_data = json_decode($user->data,true);
        return isset($arr_data[$key]) ? $arr_data[$key]:null;

    }
    //********* END DB FUNCTIONS




}