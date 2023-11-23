<?php

namespace Fakell\BotMessenger\Model\QuickReply;

use Fakell\BotMessenger\Model\QuickReply;

/**
 * Text quick replies may also be sent with an optional image that appears as an icon beside the title
 * @link https://developers.facebook.com/docs/messenger-platform/send-messages/quick-replies#text
 */
class Text extends QuickReply {


    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $payload;

    /**
     * @var string|null
     */
    private $imgUrl;

    /**
     * @param string $title
     * @param string $payload
     * @param string|null $imgUrl
     */
    public function __construct(string $title, string $payload, $imgUrl = null) {
        parent::__construct(QuickReply::TYPE_TEXT);

        $this->title = $title;
        $this->payload = $payload;
        $this->imgUrl = $imgUrl;
        
        return $this;
    }


    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $json = parent::jsonSerialize();
        $json ["title"] = $this->title;
        $json ["payload"] = $this->payload;
        $json ["image_url"] = $this->imgUrl;
        return $json;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of payload
     *
     * @return  string
     */ 
    public function getPayload() {
        return $this->payload;
    }

    /**
     * Set the value of payload
     *
     * @param  string  $payload
     *
     * @return  self
     */ 
    public function setPayload(string $payload) {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get the value of imgUrl
     *
     * @return  string
     */ 
    public function getImgUrl() {
        return $this->imgUrl;
    }

    /**
     * Set the value of imgUrl
     *
     * @param  string  $imgUrl
     *
     * @return  self
     */ 
    public function setImgUrl(string $imgUrl) {
        $this->imgUrl = $imgUrl;

        return $this;
    }
}