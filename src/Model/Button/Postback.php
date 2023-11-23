<?php

namespace Fakell\BotMessenger\Model\Button;

use Fakell\BotMessenger\Model\Button;
use Fakell\BotMessenger\Validators\ButtonValidators;


/**
 * When the postback button is tapped, the Messenger Platform sends an event to your postback webhook.
 * This is useful when you want to invoke an action in your bot. 
 * This button can be used with the Button Template and Generic Template.
 * @link https://developers.facebook.com/docs/messenger-platform/reference/buttons/postback?locale=en_US
 */
class Postback extends Button {
    
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $payload;

    public function __construct(string $title, string $payload) {
        ButtonValidators::validateTitleSize($title);
        ButtonValidators::validatePayload($payload);
        $this->title = $title;
        $this->payload = $payload;
        parent::__construct(Button::TYPE_POSTBACK);
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPayload() {
        return $this->payload;
    }

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $json = parent::jsonSerialize();
        $json["title"] = $this->title;
        $json["payload"] = $this->payload;
        return $json;
    }



}