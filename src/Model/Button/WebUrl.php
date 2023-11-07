<?php

namespace Fakell\BotMessenger\Model\Button;

use Fakell\BotMessenger\Model\Button;
use Fakell\BotMessenger\Validators\ButtonValidators;

/**
 * The URL Button opens a webpage in the Messenger webview. 
 * This button can be used with the Button and Generic Templates.
 * @link https://developers.facebook.com/docs/messenger-platform/reference/buttons/url?locale=en_US
 */
class WebUrl extends Button {
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    public function __construct(string $title, string $url){
        ButtonValidators::validateTitleSize($title);
        ButtonValidators::validateWebUrl($url);
        $this->title = $title;
        $this->url = $url;
        parent::__construct(Button::TYPE_WEB_URL);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize() {
        $json = parent::jsonSerialize();
        $json["title"] = $this->title;
        $json["url"] = $this->url;
        return $json;
    }


    public function getTitle() {
        return $this->title;
    }

    public function getUrl() {
        return $this->url;
    }
}