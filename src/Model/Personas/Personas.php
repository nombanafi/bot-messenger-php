<?php


namespace Fakell\BotMessenger\Model\Personas;

/**
 * The Messenger Platform allows you to create and manage personas for your business messaging experience.
 * The persona may be backed by a human agent or a bot.
 * A persona allows conversations to be passed from bots to human agents seemlessly.
 * When a persona is introduced into a conversation, the persona's profile picture will be shown and all messages sent by the persona will be accompanied by an annotation above the message that states the persona name and business it represents.
 * 
 * Best Practices
 * - The name of a persona is freeform, but a first name and last name or initial, such as "John Z.", is recommended
 * - The Page name is still shown at the top of the conversation when using a persona. It is not necessary to include the company name in the name field.
 * - The persona should not be overly generic.
 * - The persona should be clearly distinguished from the Page/bot itself
 * - The persona should not attempt to deceive the recipient
 * - A persona can be created quickly. It is not necessary to sync your entire database of agents in advance
 * @link https://developers.facebook.com/docs/messenger-platform/send-messages/personas#invoking
 */

class Personas implements \JsonSerializable {
    /**
     * @var string|null
     */
    private $id;
    
    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $profile_picture_url;


    public function __construct(string $name, string $profile_picture_url, $id = null) {
        $this->name = $name;
        $this->profile_picture_url = $profile_picture_url;
        $this->id = $id;
    }

    
    #[\ReturnTypeWillChange]
    public function jsonSerialize(){
        return [
            'name' => $this->name,
            'profile_picture_url' => $this->profile_picture_url
        ];
    }

    /**
     * Get the value of id
     *
     * @return  string|null
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName() {
        return $this->name;
    }

    /**
     * Get the value of profile_picture_url
     */ 
    public function getProfile_picture_url() {
        return $this->profile_picture_url;
    }
}