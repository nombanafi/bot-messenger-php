<?php

use PHPUnit\Framework\TestCase;
use Fakell\BotMessenger\Model\Button;
use Fakell\BotMessenger\Model\Button\WebUrl;
use Fakell\BotMessenger\Model\Button\Postback;
use PHPUnit\Framework\Attributes\DataProvider;
use Fakell\BotMessenger\Model\Button\PhoneNumber;

class ButtonTest extends TestCase {

    public static function buttonProvider(){

        return [
            [
                "phone" => new WebUrl("Title", "https://fakell.com"),
                "postback" => new Postback("Fakell bogosy", "My payload"),
                "weburl" => new PhoneNumber("Numero e", "+261251555")
            ]
        ];
    }

    #[DataProvider('buttonProvider')]
    public function testButtonInstance($a){
        $this->assertInstanceOf(Button::class, $a);
    }
}