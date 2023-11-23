<?php

namespace Fakell\BotMessenger\Model\MessengerProfile\GetStarted;

/**
 * When the button is tapped, your webhook will receive a messaging_postbacks event that contains a string specified by you in the get_started property of your bot's Messenger profile. 
 * This postback should be used to trigger your initial welcome message, such as a set of quick replies, or a text message that welcomes the person.
 * 
 * @link https://developers.facebook.com/docs/messenger-platform/discovery/welcome-screen#set_postback
 */
class GetStarted implements \JsonSerializable {
    const NAME = "get_started";

    /**
     * @var string
     */
    private string $payload;

    /**
     * @param string $payload
     */
    public function __construct(string $payload) {
        $this->payload = $payload;
    }
    
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize(){
        return [
            self::NAME => [
                "payload" => $this->payload
            ]
        ];
    }

    /**
     * Get the value of payload
     *
     * @return  string
     */ 
    public function getPayload() {
        return $this->payload;
    }
}