<?php

namespace Fakell\BotMessenger\Validators;


class GreetingValidators {
    /**
     * @param string $title
     *
     * @throws \InvalidArgumentException
     */
    public static function validateTextSize($title)
    {
        if (mb_strlen($title) > 160) {
            throw new \InvalidArgumentException('The text field should not exceed 160 characters.');
        }
    }

}