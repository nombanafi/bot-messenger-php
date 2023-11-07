<?php


namespace Fakell\BotMessenger\Model\Attachment\Template\Generic;

use Fakell\BotMessenger\Model\Attachment\Template;
use Fakell\BotMessenger\Types\TemplateType;
use Fakell\BotMessenger\Validators\TemplateValidators;

/**
 * The generic template allows you to send a structured message that includes an image, text and buttons.
 * @link https://developers.facebook.com/docs/messenger-platform/reference/templates/generic
 */
class Generic extends Template {
    /**
     *
     * @var GenericElement[]
     */
    private $elements;

    /**
     * @param GenericElement[] $elements
     */
    public function __construct(array $elements) {
        TemplateValidators::validateElements($elements);

        parent::__construct(Template::TYPE_GENERIC);

        $this->elements = $elements;
    }

    /**
     * Add one Generic Element
     *
     * @param GenericElement $element
     * @return self
     */
    public function addElement(GenericElement $element) {

        $elements = array_merge($this->elements, [$element]);
        
        TemplateValidators::validateElements($elements);

        $this->elements = $elements;
        return $this;
    }


    /**
     * @return Element[]
     */
    public function getElements() {
        return $this->elements;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $json = parent::jsonSerialize();

        $json["payload"]["elements"] = $this->elements;
        return $json;
    }
}