<?php

namespace Fakell\BotMessenger\Model\QuickReply;

use Fakell\BotMessenger\Model\QuickReply;

/**
 * The user phone number quick reply allows you to ask a user for their phone number. 
 * When the phone number quick reply is sent, the Messenger Platform will automatically pre-fill the displayed quick reply with the phone number from the user's profile information.
 * @link https://developers.facebook.com/docs/messenger-platform/send-messages/quick-replies#phone
 */
class UserPhoneNumber extends QuickReply {
    public function __construct() {
        parent::__construct(QuickReply::TYPE_USER_PHONE_NUMBER);
    }
}