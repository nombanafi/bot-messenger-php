<?php
namespace Fakell\BotMessenger\Model\Attachment\Template;

use Fakell\BotMessenger\Validators\TemplateValidators;

abstract class AbstractElement implements \JsonSerializable
{
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var null|string
     */
    private $subtitle;

    /**
     * @var null|string
     */
    private $imageUrl;

    /**
     * @param string $title
     * @param null|string $subtitle
     * @param null|string $imageUrl
     */
    public function __construct(string $title, $subtitle = null, $imageUrl = null) {
        // TemplateValidators::validateTitleSize($title);
        // TemplateValidators::validateSubtitleSize($subtitle);
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->imageUrl = $imageUrl;
    }
    
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize(){
        return [
            "title" => $this->title,
            "subtitle" => $this->subtitle,
            "image_url" => $this->imageUrl
        ];
    }
    /**
     * @return null|string
     */
    public function getImageUrl() {
        return $this->imageUrl;
    }

    /**
     * @return null|string
     */
    public function getSubtitle() {
        return $this->subtitle;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @deprecated use the constructor argument instead
     * @param null|string $imageUrl
     */
    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }


    /**
     * @deprecated use the constructor argument instead
     * @param null|string $subtitle
     */
    public function setSubtitle($subtitle) {
        TemplateValidators::validateSubtitleSize($subtitle);

        $this->subtitle = $subtitle;
    }
}
