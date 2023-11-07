<?php

use PHPUnit\Framework\TestCase;
use Fakell\BotMessenger\Model\Message;
use Fakell\BotMessenger\Model\Attachment\File;

class MessageTest extends TestCase {

    public function testHasFileUploadPath(){
        $a = new File("./a.txt");
        $m = new Message($a);
        $this->assertTrue($m->hasFileToUpload());
    }

    public function testHasFileUploadUrl(){
        $a = new File("https://hello.txt");
        $m = new Message($a);
        $this->assertFalse($m->hasFileToUpload());
    }

    public function testText(){
        $execpted = [
            "text" => "Hello",
            "quick_replies" => null
        ];

        $m = new Message("Hello");

        $this->assertEquals($execpted, $m->jsonSerialize());
    }

}