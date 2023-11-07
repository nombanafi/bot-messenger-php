<?php

use PHPUnit\Framework\TestCase;
use Fakell\BotMessenger\Model\Attachment;
use Fakell\BotMessenger\Model\Attachment\File;
use PHPUnit\Framework\Attributes\DataProvider;
use Fakell\BotMessenger\Model\Attachment\Audio;
use Fakell\BotMessenger\Model\Attachment\Image;
use Fakell\BotMessenger\Model\Attachment\Video;
use Fakell\BotMessenger\Model\Attachment\Template;

class AttachmentTest extends TestCase {

    public static function attachmentProvider(){

        return [
            [
                "file" => new File("https://a.s"),
                "image" => new Image("./a.jpg"),
                "video" => new Video("./a.mp4"),
                "audio" => new Audio("./a.mp3"),
                "template" => new Template(Template::TYPE_GENERIC)
            ]
        ];
    }

    #[DataProvider('attachmentProvider')]
    public function testAttachment($a){
        $this->assertInstanceOf(Attachment::class, $a);
    }
}