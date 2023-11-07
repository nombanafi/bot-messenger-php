<?php

namespace Fakell\BotMessenger\Validators;


class ButtonValidators {

    /**
     * @param string $title
     *
     * @throws \InvalidArgumentException
     */
    public static function validateTitleSize($title)
    {
        if (mb_strlen($title) > 20) {
            throw new \InvalidArgumentException('The button title field should not exceed 20 characters.');
        }
    }

    /**
     * @param string $title
     *
     * @throws \InvalidArgumentException
     */
    public static function validateWebUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('The button url field should be a valid URL.');
        }
    }

    /**
     * @param $payload
     *
     * @throws \InvalidArgumentException
     */
    public static function validatePayload($payload)
    {
        if (mb_strlen($payload) > 1000) {
            throw new \InvalidArgumentException(sprintf(
                'Payload should not exceed 1000 characters.', $payload)
            );
        }
    }

    /**
     * @param $phoneNumber
     *
     * @throws \InvalidArgumentException
     */
    public static function validatePhoneNumber($phoneNumber)
    {
        if (strpos($phoneNumber, '+') !== 0) {
            throw new \InvalidArgumentException(sprintf(
                'The phone number "%s" seem to be invalid. Please check the documentation to format the phone number.', $phoneNumber)
            );
        }
    }

}