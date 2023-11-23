<?php


namespace Fakell\BotMessenger\Model\Attachment\Template\Media;

use Fakell\BotMessenger\Model\Attachment\Template;
use Fakell\BotMessenger\Validators\TemplateValidators;

class Media extends Template{

    const TYPE_IMAGE = "image";
    const TYPE_VIDEO = "video";

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $attachmentIdorUrl;

    /**
     * @var array
     */
    private array $buttons;
    /**
     *
     * @param string $type
     * @param string $attachmentIdorUrl attachment_id or url
     * @param array $buttons
     */
    public function __construct(string $type, string $attachmentIdorUrl, array $buttons) {
        TemplateValidators::validateButtons($buttons);
        parent::__construct(Template::TYPE_MEDIA);
        $this->type = $type;
        $this->attachmentIdorUrl = $attachmentIdorUrl;
        $this->buttons = $buttons;
    }


    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $json = parent::jsonSerialize();
        $elements = [
            "media_type" => $this->type,
            "buttons" => $this->buttons
        ];
        if(filter_var($this->attachmentIdorUrl, FILTER_VALIDATE_URL)) {
            $elements ["url"] = $this->attachmentIdorUrl;
        } else {
            $elements ["attachment_id"] = $this->attachmentIdorUrl;
        }
        $json ["payload"] ["elements"] = [$elements];
        return $json;
    }
}