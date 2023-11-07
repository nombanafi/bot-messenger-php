<?php

namespace Fakell\BotMessenger\Model\Attachment\Template\Button;

use Fakell\BotMessenger\Model\Attachment\Template;
use Fakell\BotMessenger\Validators\TemplateValidators;

/**
 * The button template allows you to send a structured message that includes text and buttons. 
 * @link https://developers.facebook.com/docs/messenger-platform/reference/templates/button
 */
class Button extends Template{

    /**
     * @var string
     */
    private string $text;

    /**
     * @var array
     */
    private array $buttons;


    public function __construct(string $text = "Some text", array $buttons = []) {
        TemplateValidators::validateButtons($buttons);
        parent::__construct(Template::TYPE_BUTTON);
        $this->text = $text;
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $json = parent::jsonSerialize();

        $json["payload"] ["text"]= $this->text;
        $json["payload"] ["buttons"]= $this->buttons;
        
        return $json;
    }

    /**
     * Get the value of text
     *
     * @return  string
     */ 
    public function getText() {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @param  string  $text
     *
     * @return  self
     */ 
    public function setText(string $text) {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of buttons
     *
     * @return  array
     */ 
    public function getButtons() {
        return $this->buttons;
    }

    /**
     * Set the value of buttons
     *
     * @param  array  $buttons
     *
     * @return  self
     */ 
    public function setButtons(array $buttons) {
        TemplateValidators::validateButtons($buttons);
        $this->buttons = $buttons;
        return $this;
    }
}
