<?php


namespace Fakell\BotMessenger\Callback;

use Fakell\BotMessenger\Model\Callback\Verify;
use Symfony\Contracts\EventDispatcher\Event;

class VerifyEvent extends Event{

    const NAME = "verify_event";
    private Verify $verify;
    
    public function __construct(Verify $verify){
        $this->verify = $verify;
    }

    /**
     * Get the value of verify
     */ 
    public function getVerify(){
        return $this->verify;
    }

    public function getName(){
        return self::NAME;
    }
}