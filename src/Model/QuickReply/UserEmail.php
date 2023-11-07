<?php

namespace Fakell\BotMessenger\Model\QuickReply;

use Fakell\BotMessenger\Model\QuickReply;

/**
 * The user email quick reply allows you to ask a user for their email. 
 * When the email quick reply is sent, the Messenger Platform will automatically pre-fill the displayed quick reply with the email from the user's profile information.
 * @link https://developers.facebook.com/docs/messenger-platform/send-messages/quick-replies#email
 */
class UserEmail extends QuickReply {

    public function __construct() {
        parent::__construct(QuickReply::TYPE_USER_EMAIL);
    }
}