<?php


namespace Fakell\BotMessenger\Helpers;

use Fakell\BotMessenger\Callback\VerifyEvent;
use Fakell\BotMessenger\Callback\MessageEvent;
use Fakell\BotMessenger\Callback\PostbackEvent;
use Fakell\BotMessenger\Model\Callback\Message;
use Fakell\BotMessenger\Model\Callback\Postback;
use Fakell\BotMessenger\Model\Callback\Verify;

class CallbackEventFactory {

    /**
     * @param array $data
     * @return CallbackEvent
     */
    public static function create(array $data){
        $entry = $data["entry"][0];
        $messaging = $entry["messaging"][0];
        $sender = $messaging["sender"]["id"];
        $recipient = $messaging["recipient"]["id"];
        $event = isset($messaging["message"]) ? new MessageEvent($sender, $recipient,  Message::create($messaging["message"])) : new PostbackEvent($sender, $recipient,  Postback::create($messaging["postback"]));
        return $event;
    }

    /**
     * @param array $data
     * @return VerifyEvent
     */
    public static function createForVerify(array $data){
        $event = new VerifyEvent(Verify::create($data));
        return $event;
    }
}