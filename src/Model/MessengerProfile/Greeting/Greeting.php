<?php

namespace Fakell\BotMessenger\Model\MessengerProfile\Greeting;

/**
 * The greeting property of your bot's Messenger profile allows you to specify the greeting message people will see on the welcome screen of your bot. 
 * 
 * The welcome screen is displayed for people interacting with your bot for the first time.
 * 
 * @link https://developers.facebook.com/docs/messenger-platform/reference/messenger-profile-api/greeting
 */
class Greeting implements \JsonSerializable {
    const NAME = "greeting";

    /**
     * @var GreetingElement[]
     */
    private $greetingElements;

    public function __construct($greetingElements)  {
        $this->greetingElements = $greetingElements;
    }
    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            self::NAME => $this->greetingElements
        ];
    }
}