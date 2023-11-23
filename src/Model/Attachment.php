<?php

namespace Fakell\BotMessenger\Model;

abstract class Attachment  implements \JsonSerializable{
    const TYPE_FILE = "file";
    const TYPE_AUDIO = "audio";
    const TYPE_IMAGE = "image";
    const TYPE_VIDEO = "video";

    const TYPE_TEMPLATE = "template";
    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $payload;

    /**
     *
     * @param string $type
     * @param array $payload
     */
    public function __construct(string $type, array $payload = []){
        $this->payload = $payload;
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function getPayload() {
        return $this->payload;
    }

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
            'payload' => $this->payload,
        ];
    }
}