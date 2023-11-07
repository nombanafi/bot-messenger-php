<?php

namespace Fakell\BotMessenger\Model\Attachment;


use Fakell\BotMessenger\Model\Attachment;
use Fakell\BotMessenger\Model\Attachment\File;



class Video extends File {
    
    public function __construct(string $filePath) {
        parent::__construct($filePath, Attachment::TYPE_VIDEO);
    }
}