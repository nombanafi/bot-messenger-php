<?php


namespace Fakell\BotMessenger\Model\Callback;


class Verify {


    private $verifyToken;

    private $mode;

    private $challenge;


    public function __construct($verifyToken, $mode, $challenge ){
        $this->verifyToken = $verifyToken;
        $this->mode = $mode;
        $this->challenge = $challenge;
    }


    /**
     * @param array $data
     * @return self
     */
    public static function create(array $data){  
        $mode = $data["hub_mode"];
        $verifyToken = $data["hub_verify_token"];
        $challenge = $data["hub_challenge"];
        return new self($verifyToken, $mode, $challenge);
    }
    /**
     * Get the value of challenge
     */ 
    public function getChallenge(){
        return $this->challenge;
    }

    /**
     * Get the value of mode
     */ 
    public function getMode(){
        return $this->mode;
    }

    /**
     * Get the value of verifyToken
     */ 
    public function getVerifyToken(){
        return $this->verifyToken;
    }
}