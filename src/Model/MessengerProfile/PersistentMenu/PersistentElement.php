<?php

namespace Fakell\BotMessenger\Model\MessengerProfile\PersistentMenu;

use Fakell\BotMessenger\Types\MessengerAndroidLocales;

class PersistentElement implements \JsonSerializable {

    /**
     * @var string
     */
    private string $locale;

    /**
     *
     * @var Button[]
     */
    private $buttons;

    /**
     * @var boolean
     */
    private bool $composer_input_disabled;


    public function __construct (array $buttons, string $locale = MessengerAndroidLocales::DEFAULT, bool $composer_input_disabled = false) {
        if(count($buttons) > 20) {
            throw new \InvalidArgumentException("The number of button should be less than 20");
        }
        $this->buttons = $buttons;
        $this->locale = $locale;
        $this->composer_input_disabled = $composer_input_disabled;
    }

    public function jsonSerialize(){
        return [
            "locale" => $this->locale,
            "composer_input_disabled" => $this->composer_input_disabled,
            "call_to_actions" => $this->buttons
        ];
    }

    /**
     * Get the value of buttons
     *
     * @return  Button[]
     */ 
    public function getButtons() {
        return $this->buttons;
    }

    /**
     * Set the value of buttons
     *
     * @param  Button[]  $buttons
     *
     * @return  self
     */ 
    public function setButtons($buttons){
        if(count($buttons) > 20) {
            throw new \InvalidArgumentException("The number of button should be less than 20");
        }
        
        $this->buttons = $buttons;

        return $this;
    }
}