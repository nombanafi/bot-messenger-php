<?php

namespace Fakell\BotMessenger\Callback;

use Fakell\BotMessenger\Callback\CallbackEvent;
use Fakell\BotMessenger\Model\Callback\Postback;

class PostbackEvent extends CallbackEvent{

    const NAME = "postback_event";

    private Postback $postback;


    public function __construct($sender, $recipient, Postback $postback){
        parent::__construct($sender, $recipient);
        $this->postback = $postback;
    }    

    /**
     * Get the value of postback
     */ 
    public function getPostback(){
        return $this->postback;
    }

    
    public function getName(){
        return self::NAME;
    }
}