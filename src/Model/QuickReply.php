<?php

namespace Fakell\BotMessenger\Model;

/**
 * Quick Replies allow you to get message recipient input by sending buttons in a message.
 * 
 * @link https://developers.facebook.com/docs/messenger-platform/reference/buttons/quick-replies?locale=en_US
 */
abstract class QuickReply implements \JsonSerializable {


    const TYPE_TEXT = "text";
    const TYPE_USER_PHONE_NUMBER = "user_phone_number";
    const TYPE_USER_EMAIL = "user_email";

    /**
     * @var string
     */
    private string $type;

    public function __construct(string $type) {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(){
        return [
            "content_type" => $this->type
        ];
    }

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType() {
        return $this->type;
    }
}