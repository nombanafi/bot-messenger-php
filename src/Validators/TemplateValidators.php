<?php

namespace Fakell\BotMessenger\Validators;


class TemplateValidators {


    const MAX_BUTTON = 3;
    const MAX_ELEMENT = 10;
    const MAX_SUB_SIZE = 80;
    const MAX_TITLE_SIZE = 80;
    /**
     * @param array $buttons
     *
     * @throws \InvalidArgumentException
     */
    public static function validateButtons(array $buttons){
        if (count($buttons) > self::MAX_BUTTON) {
            throw new \InvalidArgumentException('A generic template can not have more than 3 buttons');
        }
    }

    /**
     * @param array $elements
     *
     * @throws \InvalidArgumentException
     */
    public static function validateElements(array $elements) {
        if (count($elements) > self::MAX_ELEMENT) {
            throw new \InvalidArgumentException('A generic template can not have more than 10 bubbles');
        }
    }

    /**
     * @param string $subtitle
     *
     * @throws \InvalidArgumentException
     */
    public static function validateSubtitleSize(string $subtitle) {
        if (mb_strlen($subtitle) > self::MAX_SUB_SIZE) {
            throw new \InvalidArgumentException('The subtitle field should not exceed '. self::MAX_SUB_SIZE .' characters.');
        }
    }

    /**
     * @param string $title
     *
     * @throws \InvalidArgumentException
     */
    public static function validateTitleSize(string $title) {
        if (mb_strlen($title) > self::MAX_TITLE_SIZE) {
            throw new \InvalidArgumentException('The title field should not exceed '. self::MAX_TITLE_SIZE .' characters.');
        }
    }
}