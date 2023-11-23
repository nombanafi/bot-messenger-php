<?php

namespace Fakell\BotMessenger\Model\MessengerProfile\PersistentMenu;
/**
 * The Persistent Menu allows you to create and send a menu of the main features of your business, such as hours of operation, store locations, and products, is always visible in a person's Messenger conversation with your business.
 * 
 *  RequirementsFor the persistent menu to appear, the following must be true:
 * - The person must be running Messenger v106 or above on iOS or Android.
 * - The Facebook Page the Messenger bot is subscribe to must be published.
 * - The Messenger bot must be set to "public" in the app settings.
 * - The Messenger bot must have the pages_messaging permission.
 * - The Messenger bot must have a get started button set.
 * 
 * @link https://developers.facebook.com/docs/messenger-platform/send-messages/persistent-menu?locale=en_US
 */
class PersistentMenu implements \JsonSerializable {

    const NAME = "persistent_menu";
    /**
     *
     * @var PersistentElement[]
     */
    private $persistantElements;

    /**
     * @param Button[] $buttons
     * @param null|string $psid
     */
    public function __construct($persistantElements) {
        $this->persistantElements = $persistantElements;
        return $this;
    }

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $json = [
            "persistent_menu" => $this->persistantElements
        ];
        return $json;
    }


    /**
     * Get the value of persistantElements
     *
     * @return  PersistentElements[]
     */ 
    public function getPersistantElements() {
        return $this->persistantElements;
    }

    /**
     * Set the value of persistantElements
     *
     * @param  PersistentElement[]  $persistantElements
     *
     * @return  self
     */ 
    public function setPersistantElements($persistantElements ){
        $this->persistantElements = $persistantElements;

        return $this;
    }
}