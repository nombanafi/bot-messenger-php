<?php

namespace Fakell\BotMessenger\Model\MessengerProfile\Greeting;

use Fakell\BotMessenger\Types\MessengerAndroidLocales;
use Fakell\BotMessenger\Validators\GreetingValidators;

class GreetingElement implements \JsonSerializable {

    /**
     * @var string
     */
    private string $text;

    /**
     * @var string
     */
    private string $locale;

    /**
     * @param string $text
     * 
     * You can personalize the greeting text using the person's name. You can use the following template strings:
     * - {{user_first_name}}
     * - {{user_last_name}}
     * - {{user_full_name}}
     * 
     * @param string $locale
     */
    public function __construct(string $text, string $locale = MessengerAndroidLocales::DEFAULT){
        GreetingValidators::validateTextSize($text);
        $this->text = $text;
        $this->locale = $locale;
    }
    /**
     * @return array
     */
    public function jsonSerialize(){
        return [
            "locale" => $this->locale,
            "text" =>$this->text
        ];
    }
}