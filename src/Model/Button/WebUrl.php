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

    /**
     * @var string
     */
    private $webview_height_ratio;

    /**
     * @var bool
     */
    private $messenger_extensions;

    /**
     * @var string
     */
    private $webview_share_button;

    public function __construct(string $title, string $url, string $webview_height_ratio = "full", bool $messenger_extensions = true, string $webview_share_button = "hide"){
        ButtonValidators::validateTitleSize($title);
        ButtonValidators::validateWebUrl($url);
        $this->title = $title;
        $this->url = $url;
        $this->webview_height_ratio = $webview_height_ratio;
        $this->messenger_extensions = $messenger_extensions;
        $this->webview_share_button = $webview_share_button;
        parent::__construct(Button::TYPE_WEB_URL);
    }

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $json = parent::jsonSerialize();
        $json["title"] = $this->title;
        $json["url"] = $this->url;
        $json["webview_height_ratio"] = $this->webview_height_ratio;
        $json["messenger_extensions"] = $this->messenger_extensions;
        $json["webview_share_button"] = $this->webview_share_button;
        return $json;
    }


    public function getTitle() {
        return $this->title;
    }

    public function getUrl() {
        return $this->url;
    }
}