<?php


namespace Fakell\BotMessenger\Callback;

use Symfony\Contracts\EventDispatcher\Event;

abstract class CallbackEvent extends Event{

    private $sender;

    private $recipient;


    public function __construct($sender, $recipient){
        $this->sender = $sender;
        $this->recipient = $recipient;
    }


    /**
     * Get the value of sender
     */ 
    public function getSender(){
        return $this->sender;
    }

    /**
     * Get the value of recipient
     */ 
    public function getRecipient(){
        return $this->recipient;
    }

    
}