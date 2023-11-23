<?php


namespace Fakell\BotMessenger\Model;


class Button implements \JsonSerializable {

    const TYPE_POSTBACK = "postback";
    const TYPE_PHONE_NUMBER = 'phone_number';
    const TYPE_WEB_URL = 'web_url';

    private $type;

    public function __construct($type){
        $this->type = $type;
    }
    

    /**
     * @return mixed
     */
    public function jsonSerialize() {
        return [
            "type" => $this->type
        ];
    }

    public function getType() {
        return $this->type;
    }
}