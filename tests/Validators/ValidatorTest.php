<?php

use Fakell\BotMessenger\Model\Attachment\Template\Generic\GenericElement;
use Fakell\BotMessenger\Model\Button\Postback;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase{


    public function testButton() {

        $this->expectException(\InvalidArgumentException::class);
        // Miôtra ray le boutton
        new GenericElement("Title", "Subtitle", null, [
            new Postback("test", 'test'),
            new Postback("test", 'test'),
            new Postback("test", 'test'),
            new Postback("test", 'test'),
        ]);
    }
}