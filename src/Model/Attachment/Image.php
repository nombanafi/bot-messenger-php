<?php

namespace Fakell\BotMessenger\Model\Attachment;

use Fakell\BotMessenger\Model\Attachment;
use Fakell\BotMessenger\Model\Attachment\File;


class Image extends File {
    
    public function __construct(string $filePath) {
        parent::__construct($filePath, Attachment::TYPE_IMAGE);
    }
}