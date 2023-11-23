<?php

namespace Fakell\BotMessenger\Model\Attachment;

use Fakell\BotMessenger\Model\Attachment;

class Template extends Attachment {

    const TYPE_GENERIC = "generic";
    const TYPE_BUTTON = "button";
    const TYPE_MEDIA = "media";
    const TYPE_RECEIPT = "receipt";

    /**
     * Type of template
     *
     * @var string
     */
    private string $type;


    public function __construct(string $type) {
        parent::__construct(Attachment::TYPE_TEMPLATE);
        $this->type = $type;
    }


    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $json = parent::jsonSerialize();
        $json ["payload"] = [
            "template_type" => $this->type
        ];
        return $json;
    }
}