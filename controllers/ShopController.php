<?php

namespace controllers;

use models\AudioItem;
use models\AudioModel;
use models\Category;
use models\Product;
use models\UserBot;
use models\VideoItemModel;
use models\VideoModel;
use Telegram\Bot\Actions;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\Audio;
use Telegram\Bot\Objects\Video;
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
    public $message_id;
    public $callback_data;

    public $text;
    public $bot_token = "8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw";

    public function __construct()
    {

        $this->telegram = new api('8297930277:AAEeX9D0hmwxJdlDu7wtVXQ0dpHGzqrbCAw');


    }

    public function start()
    {
        $this->enable();
        $this->disable();


        $this->getDatas();

        if (!is_null($this->callback_data)) {
            if (strpos($this->callback_data, 'song_') !== false) {
                $this->downloadMusicPage();
            }elseif(strpos($this->callback_data, 'page_') !== false){
                $page = (int)str_replace('page_', '', $this->callback_data);
                $this->showMusicResult($page, $this->message_id);

            }else{
                $this->showCallBackdata();
            }

        }else{
            switch ($this->text) {
                case '/start':
                    $this->showHomePage();
                    break;
                case '/about':
                    $this->showInlineKeyboard();
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
                case Text::VIDEO_TEXT:
                    $this->showVideoPage();
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
                                    $this->setKey('productName', $this->text);
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
                                    $this->setKey('productPrice', $this->text);
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

                                    $this->setKey('productDesc', $this->text);
                                    $product = new Product();

                                    $data = [
                                        'category_id' => 1,
                                        'name' => $this->getKey('productName'),
                                        'price' => $this->getKey('productPrice'),
                                        'image' => $this->getKey('productImage'),
                                        'description' => $this->text,
                                        'in_stock' => 1
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

                                    $this->setKey('CategoryName', $this->text);
                                    $category = new Category();
                                    $data = [
                                        'name' => $this->getKey('CategoryName'),
                                    ];
                                    $category->save($data);
                                    $this->sendMessage(Text::CATEGORY_INSERTED_TEXT);
                                    $this->showHomePage();
                                    break;
                            }
                            break;

                        case Page::MUSIC_PAGE:
                            switch ($this->text){
                                case Text::BACK_TEXT:
                                    $this->showHomePage();
                                    break;
                                case Text::MUSIC_SEARCH_NAME:
                                    $this->showMusicSearchPage();
                                    break;
                            }
                            break;
                        case Page::VIDEO_PAGE:
                            if ($this->text == Text::BACK_TEXT) {
                                $this->showHomePage();
                            } else {
                                $this->showVideo();
                            }
                            break;
                        case  Page::SEARCH_PAGE:
                            switch ($this->text) {
                                case Text::BACK_TEXT:
                                    $this->showMusicPage();
                                    break;
                                default:
                                    $this->setKey('search', $this->text);
                                    $this->showMusicResult();
                                    break;
                            }
                            break;

                    }
                    break;


            }
        }




    }


    //********************* SHOW PAGES


    public function showMusicPage()
    {

        $this->setPage(Page::MUSIC_PAGE);

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::MUSIC_LINK),
            ])
            ->row([
                Keyboard::Button(Text::MUSIC_SEARCH_NAME),
            ])
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);

        $this->sendMessageWithKeyboard(Text::MUSIC_TEXT_SHOW, $reply_markup);

    }

    public function showMusicSearchPage(){
        $this->setPage(Page::SEARCH_PAGE);
        $text = "Musiqa nomini kiriting!";
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }

    public function showMusicResult($page = 1, $message_id = null){

       $search = $this->getKey('search');

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://youtube138.p.rapidapi.com/search/?q={$search}&hl=en&gl=US",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: youtube138.p.rapidapi.com",
                "x-rapidapi-key: c65ee05e90msha747563874734c6p1ed25djsne8bce8ddb241"
            ],
        ]);

        $natija = curl_exec($curl);


        curl_close($curl);


        $data = json_decode($natija, true);
        file_put_contents('result.json', json_encode($data, JSON_PRETTY_PRINT));

        if (!isset($data['contents']) || empty($data['contents'])) {
            $this->sendMessage("Hech narsa topilmadi😞");
            return;
        }

        $videos = [];
        foreach ($data['contents'] as $item) {
            if (!isset($item['video'])) continue;
            $videos[] = [
                'id' => $item['video']['videoId'] ?? null,
                'title' => $item['video']['title'] ?? 'No title',
            ];

        }

        $limit = 9;
        $total = count($videos);
        $total_pages = ceil($total / $limit);

        if ($page > $total_pages) $page = $total_pages;

        $offset = ($page - 1) * $limit;
        $page_items = array_slice($videos, $offset, $limit);

        $message_text = "🎵 Natijalar:\n\n";

        $keyboard = [];
        $row = [];

        foreach ($page_items as $index => $song) {
            $num = $offset + $index + 1;
            $title = $song['title'];
            $message_text .= "{$num}. {$title}\n";


            $row[] = Keyboard::inlineButton([
                'text' => "🎧 {$num}",
                'callback_data' => "song_" . $song['id']
            ]);


            if (count($row) === 3) {
                $keyboard[] = $row;
                $row = [];
            }
        }

        if (!empty($row)) {
            $keyboard[] = $row;
        }


        $nav_buttons = [];
        if ($page > 1) {
            $nav_buttons[] = Keyboard::inlineButton([
                'text' => '⬅️ Oldingi',
                'callback_data' => "page_" . ($page - 1)
            ]);
        }
        if ($page < $total_pages) {
            $nav_buttons[] = Keyboard::inlineButton([
                'text' => '➡️ Keyingi',
                'callback_data' => "page_" . ($page + 1)
            ]);
        }

        if (!empty($nav_buttons)) {
            $keyboard[] = $nav_buttons;
        }

        $reply_markup = Keyboard::make([
            'inline_keyboard' => $keyboard
        ]);
        if ($message_id) {

            $this->telegram->editMessageText([
                'chat_id' => $this->chat_id,
                'message_id' => $message_id,
                'text' => $message_text,
                'reply_markup' => $reply_markup
            ]);
        } else {
            $this->telegram->sendMessage([
                'chat_id' => $this->chat_id,
                'text' => $message_text,
                'reply_markup' => $reply_markup
            ]);
        }



    }

    public function downloadMusicPage()
    {
        $download = $this->callback_data;

        if (strpos($download, 'song_') === 0) {
            $video_id = str_replace('song_', '', $download);


            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://youtube-mp36.p.rapidapi.com/dl?id={$video_id}",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "x-rapidapi-host: youtube-mp36.p.rapidapi.com",
                    "x-rapidapi-key: 68482e1a48mshdcf8eba4ab516cdp139badjsna79ca4ffc08d"
                ],
            ]);

            $res = curl_exec($curl);

            curl_close($curl);


            $song = json_decode($res, true);

            if (isset($song['link']) && !empty($song['link'])) {

                $this->telegram->sendChatAction([
                    'chat_id' => $this->chat_id,
                    'action' => Actions::UPLOAD_VIDEO,

                ]);



                $this->telegram->sendAudio([
                    'chat_id' => $this->chat_id,
                    'audio' => InputFile::create($song['link']),
                    'caption' => $song['title']
                ]);

            }else{
                $this->sendMessage("Qo'shiqni yuklab bo'lmadi");
            }


        }

    }

    public function showVideoPage()
    {

        $this->setPage(Page::VIDEO_PAGE);
        $this->sendMessage(Text::VIDEO_TEXT_SHOW);

    }

    public function showVideo()
    {
        $video_id = null;
        $url = $this->text;
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            if (isset($params['v'])) {
                $video_id = $params['v'];
            }

            if (!$video_id && strpos($url, 'youtu.be') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $video_id = ltrim($path, '/');

            }

            if (!$video_id && strpos($url, '/shorts/') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $param = explode('/', trim($path, '/'));
                $video_id = end($param);

            }
        }

        $video = new VideoModel();
        $video_old = $video->getBYVideo($video_id);


        $video_item = new VideoItemModel();



        if ($video_old) {
            $video = $video_item->getBYVideo($video_old->id);
            if (isset($video) && !empty($video->telegram_file_id)) {
                $this->sendMessage($video->telegram_file_id);
                $this->telegram->sendVideo([
                    'chat_id' => $this->chat_id,
                    'video' => $video->telegram_file_id,
                ]);
                exit();


            }

        }


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://youtube-media-downloader.p.rapidapi.com/v2/video/details?videoId=$video_id&urlAccess=normal&videos=auto&audios=auto",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: youtube-media-downloader.p.rapidapi.com",
                "x-rapidapi-key: 10294a8acamsh325f4f506fd2178p1fd06ajsn725d84dfe7f1"
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        file_put_contents("response.json", json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $videos = new VideoModel();

//        $data = file_get_contents('response.json');
//        $data = json_decode($data, true);


        $inform = [
            'video_id' => $data['id'],
            'title' => $data['title'],
            'new_column' => $data['description'],
        ];
        $video_id = $videos->save($inform);



        foreach ($data['videos']['items'] as $item) {

            if ($item['extension'] == 'mp4' && $item['hasAudio'] == true) {

                $savedatas = [
                    'url' => $item['url'],
                    'extension' => $item['extension'],
                    'sizeText' => $item['sizeText'],
                    'quality' => $item['quality'],
                    'video_id' => $video_id,
                ];
                $video_item->save($savedatas);
            }


        }

        $audio_item = new AudioItem();
        foreach ($data['audios']['items'] as $item) {
            if ($item['extension'] !== 'mp3' && $item['hasAudio'] == true) {
                continue;
            }

            $savedatas = [
                'url' => $item['url'],
                'extension' => $item['extension'],
                'sizeText' => $item['sizeText'],

            ];
            $audio_item->save($savedatas);
        }

        $this->sendVideoKeyboard($data['id'], $data['videos']['items']);


    }

    public function showCallBackdata()
    {

        $data = json_decode($this->callback_data, true);

        if (isset($data['video_id'])) {
            $this->sendMessage($data['video_id']);

            $video = new VideoModel();
            $video = $video->getBYVideo($data['video_id']);
            $video_item_obj = new VideoItemModel();
            $video_item = $video_item_obj->getByVideoId($video->id);

            if (!is_null($video_item->telegram_file_id)) {
                $this->sendVideoMessage($video_item->telegram_file_id);

            }else{

                $ch = curl_init($video_item->url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_exec($ch);
                $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                curl_close($ch);


                $fileId = $this->sendVideoMessage($finalUrl);
                $this->sendMessage(json_encode($fileId, JSON_PRETTY_PRINT));

                $data = [
                    'telegram_file_id' => $fileId,
                ];

                $video_item_obj->update($video_item->id, $data);



            }

        }


    }

    public function showInlineKeyboard()
    {
        $reply_markup = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton([
                    'text' => Text::BACK_TEXT,
                    'url' => 'https://google.com',
                ]),
                Keyboard::inlineButton([
                    'text' => 2,
                    'url' => 'https://google.com',
                ]),
                Keyboard::inlineButton([
                    'text' => 3,
                    'url' => 'https://google.com',
                ]),
                Keyboard::inlineButton([
                    'text' => 3,
                    'url' => 'https://google.com',
                ]),
            ])
            ->row([
                Keyboard::inlineButton([
                    'text' => Text::BACK_TEXT,
                    'url' => 'https://google.com',
                ]),
                Keyboard::inlineButton([
                    'text' => 4,
                    'url' => 'https://google.com',
                ]),
                Keyboard::inlineButton([
                    'text' => 5,
                    'url' => 'https://google.com',
                ]),
                Keyboard::inlineButton([
                    'text' => 6,
                    'url' => 'https://google.com',
                ]),
            ]);
        $text = "Welcome to about page";

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }

    public function sendVideoKeyboard($id, $videos)
    {
        $reply_markup = Keyboard::make()
            ->inline();

        foreach ($videos as $video) {
            if ($video['extension'] == 'mp4' && $video['hasAudio'] == true) {
                $reply_markup->row([
                    Keyboard::inlineButton([
                        'text' => $video['quality'],
                        'callback_data' => json_encode([
                            'type' => 'video',
                            'quality' => $video['quality'],
                            'video_id' => $id,
                        ])
                    ])
                ]);


            }

        }

        $text = "Kerakli video sifatini tanlang";
        $this->sendMessageWithKeyboard($text, $reply_markup);

    }

    public function sendAudioMessage($audio, $caption = "", $isFileId = false)
    {
        $this->telegram->sendChatAction([
            'chat_id' => $this->chat_id,
            'action' => Actions::UPLOAD_VOICE
        ]);
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

    public function sendVideoMessage($video, $caption = "", $isFileId = false)
    {
        $this->telegram->sendChatAction([
            'chat_id' => $this->chat_id,
            'action' => Actions::UPLOAD_VIDEO
        ]);
        $params = [
            'chat_id' => $this->chat_id,
            'caption' => $caption,
            'parse_mode' => 'HTML'
        ];

        if ($isFileId) {

            $params['video'] = $video;
        } else {

            $params['video'] = InputFile::create($video);
        }

        $video_responce = $this->telegram->sendVideo($params);
        file_put_contents('file.responce', $video_responce);

        return $video_responce->getVideo()->getFileId();





    }

    public function showMusic()
    {

        $url = $this->text;
        $videoId = null;

        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            $videoId = $params['v'] ?? null;
            if (!$videoId && strpos($url, 'youtu.be') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $videoId = ltrim($path, '/');
            } elseif (!$videoId && strpos($url, '/shorts/') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $parts = explode('/', trim($path, '/'));
                $videoId = $parts[count($parts) - 1];
            } elseif (!$videoId && strpos($url, 'youtu.be/') !== false) {
                $path = parse_url($url, PHP_URL_PATH);
                $parts = explode('/', trim($path, '/'));
                $videoId = $parts[0];
            } elseif (!$videoId && strpos($url, 'watch?v=') !== false && strpos($url, 'www.youtube.com') !== false) {
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
                exit();
            }
        }


        $count_check = 1;

//        while(true){
//            if ($count_check > 3) {
//                break;
//            }
//
//            $curl = curl_init();
//            curl_setopt_array($curl, [
//                CURLOPT_URL => "https://youtube-mp36.p.rapidapi.com/dl?id=" . $videoId,
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_HTTPHEADER => [
//                    "x-rapidapi-host: youtube-mp36.p.rapidapi.com",
//                    "x-rapidapi-key: c65ee05e90msha747563874734c6p1ed25djsne8bce8ddb241"
//                ],
//            ]);
//            $response = curl_exec($curl);
//            curl_close($curl);
//
//            $data = json_decode($response, true);
//            $this->sendMessage(json_encode($data));
//
//            if (isset($data['link']) && $data['link'] !== '') {
//                $size = round($data['filesize'] / 1024 / 1024, 2) . ' MB';
//                $caption = "🎵 <b>{$data['title']}</b>\n";
//                $caption .= "📦 Hajmi: {$size}\n";
//
//
//                $fileId = $this->sendAudioMessage($data['link'], $caption);
//
//
//                $saveData = [
//                    'videoId' => $videoId,
//                    'link' => $data['link'],
//                    'title' => $data['title'],
//                    'file_id' => $fileId,
//                    'filesize' => $data['filesize'],
//                ];
//                $audioModel->save($saveData);
//                break;
//
//
//            } elseif($count_check == 3) {
//                $this->sendMessage("❌ Qo‘shiqni yuklab bo‘lmadi.");
//            }
//            $count_check++;
//            sleep(6);
//
//
//        }


    }

    public function showHomePage()
    {
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
                Keyboard::Button(Text::VIDEO_TEXT),
                Keyboard::Button(Text::MUSIC_TEXT),

            ]);

        if ($this->isAdmin()) {
            $reply_markup->row([
                Keyboard::Button(Text::ADMIN_PANEL),
            ]);
        }


        $text = Text::HELLO_TEXT;

        $this->sendMessageWithKeyboard($text, $reply_markup);

    }


    // ************* END SHOW PAGES

    // ************* ADMIN SHOW PAGES

    public function showAdminPanelPage()
    {
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

    public function showAddProductNamePage()
    {
        $this->setPage(Page::INPUT_PRODUCT_NAME_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_PRODUCT_NAME_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }

    public function showAddCategoryNamePage()
    {
        $this->setPage(Page::INPUT_CATEGORY_NAME_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_CATEGORY_NAME_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }

    public function showAddProductpricePage()
    {
        $this->setPage(Page::INPUT_PRODUCT_PRICE_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_PRODUCT_PRICE_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }

    public function showAddProductImagePage()
    {
        $this->setPage(Page::INPUT_PRODUCT_IMAGE_PAGE);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row([
                Keyboard::Button(Text::BACK_TEXT),
            ]);
        $text = Text::INPUT_PRODUCT_IMAGE_TEXT;
        $this->sendMessageWithKeyboard($text, $reply_markup);
    }

    public function showAddProductDescPage()
    {
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
        if ($this->message->has('photo')) {
            $photos = $this->message->getPhoto();
            $photos = json_decode($photos, true);
            $photo = end($photos);

            $this->setKey('productImage', $photo['file_id']);
            $this->showAddProductDescPage();
        } else {
            $this->sendMessage("kechirasiz bu yerga faqat rasim yuborish mumkin!");
        }
    }
    // ************* END ADMIN SHOW PAGES


    //********* TELEGRAM FUNCTIONS
    public function getDatas()
    {

        $request = $this->telegram->getWebhookUpdate();

        if ($request->isType('callback_query')) {
            $callback_query = $request->getCallbackQuery();

            $this->callback_data = $callback_query->get('data');
            $this->chat_id = $callback_query->getMessage()->getChat()->getId();
            $message_id = $callback_query->getMessage()->getMessageId();
            $this->message_id = $message_id;

        } else {

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
            if ($message->getContact()) {
                $contact = $message->getContact();
                $phoneNumber = $contact->getPhoneNumber();
                $this->contact = $phoneNumber;
            }
            $messageId = $message['message_id'];

            if (!$this->isUser()) {
                $this->addUser();
            }
        }

    }

    public function sendMessageRemoveKeyboard($text)
    {

        $this->telegram->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => Keyboard::remove()

        ]);

    }

    public function sendMessage($text, $chat_id = null)
    {
        $this->telegram->sendChatAction([
            'chat_id' => $this->chat_id,
            'action' => Actions::TYPING
        ]);
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

    public function sendMessageWithKeyboard($text, $reply_markup)
    {

        $this->telegram->sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup,

        ]);

    }

    //********* END TELEGRAM FUNCTIONS

    //********* DB FUNCTIONS

    public function addUser()
    {
        $user = new UserBot();
        if (is_null($this->last_name)) {
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

    public function isAdmin()
    {
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        if ($user->is_admin) {
            return true;
        }
        return false;
    }

    public function isUser()
    {
        $userbot = new UserBot();

        if ($userbot->getByChatId($this->chat_id)) {
            return true;
        } else {
            return false;
        }

    }

    public function setPage($page)
    {
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        $data = [
            'step' => $page,
        ];
        $userbot->update($user->id, $data);

    }

    public function getPage()
    {
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        return $user->step;

    }

    public function setKey($key, $value)
    {
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        $arr_data = json_decode($user->data, true);
        $arr_data[$key] = $value;
        $data = [
            'data' => json_encode($arr_data)
        ];
        $userbot->update($user->id, $data);


    }

    public function getKey($key)
    {
        $userbot = new UserBot();
        $user = $userbot->getByChatId($this->chat_id);
        $arr_data = json_decode($user->data, true);
        return isset($arr_data[$key]) ? $arr_data[$key] : null;

    }
    
    //********* END DB FUNCTIONS

    public function enable()
    {
        $webHook = 'https://2.nugaev.uz/shop/start';
        $apiUrl = "https://api.telegram.org/bot{$this->bot_token}/setWebhook?url={$webHook}";
        $response = file_get_contents($apiUrl);
        $result = json_decode($response, true);

        if (!empty($result['ok'])) {
            echo "✅ Webhook yoqildi";
        }

        
    }

    public function disable()
    {
        $apiUrl = "https://api.telegram.org/bot{$this->bot_token}/deleteWebhook";
        $response = file_get_contents($apiUrl);
        $result = json_decode($response, true);

        if (!empty($result['ok']) && $result['ok'] === true) {
            echo "Webhook o‘chirildi";
        }
        
    }


}