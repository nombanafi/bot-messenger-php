<?php

namespace Fakell\BotMessenger\Model\Callback;


class Postback {

    /**
     * @var string
     */
    private string $payload;

    /**
     * @var string
     */
    private string $title;


    public function __construct(string $payload, string $title) {
        $this->payload = $payload;
        $this->title = $title;
    }

    

    /**
     * Get the value of payload
     *
     * @return  string
     */ 
    public function getPayload() {
        return $this->payload;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle() {
        return $this->title;
    }


    public static function create(array $data){
        return new static($data["payload"], $data["title"]);
    }
}