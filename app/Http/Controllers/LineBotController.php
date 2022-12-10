<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Log;

class LineBotController extends Controller
{
    private $client;
    private $bot;
    private $channelAccessToken;
    private $channelSecret;
   

    public function __construct()
    {
        $this->channelAccessToken = config('linebot.channelAccessToken');
        $this->channelSecret = config('linebot.channelSecret');
        $this->companyGroupID = config('linebot.companyGroupID');
        $this->customerGroupID = config('linebot.customerGroupID');

        $httpClient = new CurlHTTPClient($this->channelAccessToken);
        $this->bot = new LINEBot($httpClient, ['channelSecret' => $this->channelSecret]);
        $this->client = $httpClient;
    }

    public function webHook(Request $request)
    {
        $signature = $request->header(\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        $body = $request->getContent();

        $foodData = [
            '摩斯', '麥當勞', '鐵板燒',
            '八方雲集', '爭鮮', '壽司郎',
            '燒臘', '吃土', '火鍋', '水餃',
            '酸辣粉'
        ];

        try {
            $events = $this->bot->parseEventRequest($body, $signature);
            Log::info($events);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        foreach ($events as $event) {
            $replyToken = $event->getReplyToken();
            if ($event instanceof MessageEvent) {
                $messageType = $event->getMessageType();
                switch ($messageType) {
                    case 'text':{
                        $text = $event->getText();
                        if ($text == '吃') {
                            $count = count($foodData);
                            $randFood = $foodData[rand(0, $count-1)];
                            $this->bot->replyMessage($replyToken, new TextMessageBuilder($randFood));
                        }
                    }
                }
            }
        }
    }
}
