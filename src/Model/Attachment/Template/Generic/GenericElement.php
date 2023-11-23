<?php

namespace Fakell\BotMessenger\Model\Attachment\Template\Generic;

use Fakell\BotMessenger\Model\Attachment\Template\AbstractElement;
use Fakell\BotMessenger\Validators\TemplateValidators;

/**
 * The generic template supports a maximum of 10 elements per message. 
 * At least one property must be set in addition to title.
 */
class GenericElement extends AbstractElement {

    /**
     * @var array
     */
    private $buttons = [];

    /**
     *
     * @param string $title
     * @param string|null $subtitle
     * @param string|null $imgUrl
     * @param array $buttons
     * 
     * @return self
     */
    public function __construct(string $title = "Some title", string $subtitle = "", string $imgUrl = null, array $buttons = []) {
        parent::__construct($title, $subtitle, $imgUrl);
        TemplateValidators::validateButtons($buttons);
        $this->buttons = $buttons;
        return $this;
    }

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        
        $json = parent::jsonSerialize();
        $json ["buttons"] = $this->buttons;

        return $json;
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