<?php


namespace Fakell\BotMessenger\Model\Button;

use Fakell\BotMessenger\Model\Button;
use Fakell\BotMessenger\Validators\ButtonValidators;
/**
 * The Call Button can be used to initiate a phone call. 
 * This button can be used with the Button and Generic Templates.
 * @link https://developers.facebook.com/docs/messenger-platform/reference/buttons/call?locale=en_US
 */
class PhoneNumber extends Button{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $phoneNumer;


    public function __construct(string $title, string $phoneNumber) {
        ButtonValidators::validateTitleSize($title);
        ButtonValidators::validatePhoneNumber($phoneNumber);

        $this->title = $title;
        $this->phoneNumer = $phoneNumber;

        parent::__construct(Button::TYPE_PHONE_NUMBER);
    }


    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $json = parent::jsonSerialize();

        $json["title"] = $this->title;
        $json["payload"] = $this->phoneNumer;
        return $json;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPhoneNumber() {
        return $this->phoneNumer;
    }
}