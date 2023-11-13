<?php


namespace Fakell\BotMessenger\Callback;

use Fakell\BotMessenger\Callback\CallbackEvent;
use Fakell\BotMessenger\Model\Callback\Message;

class MessageEvent extends CallbackEvent{

    const NAME = "message_event";

    private Message $message;


    public function __construct($sender, $recipient, Message $message){
        parent::__construct($sender, $recipient);
        $this->message = $message;
    }    

    /**
     * Get the value of message
     */ 
    public function getMessage(){
        return $this->message;
    }

    public function getName(){
        return self::NAME;
    }
}