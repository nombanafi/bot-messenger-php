<?php

namespace Fakell\BotMessenger;

use GuzzleHttp\RequestOptions;
use Fakell\BotMessenger\Client;
use Fakell\BotMessenger\Model\Message;
use Fakell\BotMessenger\Model\Attachment;
use Fakell\BotMessenger\Types\MessagingType;
use Fakell\BotMessenger\Types\NotificationType;
use Fakell\BotMessenger\Helpers\PersonasFactory;
use Fakell\BotMessenger\Helpers\ResponseHandler;
use Fakell\BotMessenger\Model\Personas\Personas;
use Fakell\BotMessenger\Helpers\PersonasListFactory;
use Fakell\BotMessenger\Helpers\RequestOptionsFactory;
use Fakell\BotMessenger\Model\MessengerProfile\PersistentMenu\PersistentMenu;

class Messenger {
    use ResponseHandler;

    /**
     * @var Client
     */
    private $client;


    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @param string $recipient
     * @param string $actionType
     * @return array
     */
    public function setActionStatus($recipient, $actionType){
        $options = RequestOptionsFactory::createForTyping($recipient, $actionType); 
        $response = $this->client->send("POST", "me/messages", $options);
        return $this->decodeResponse($response);
    }

    /**
     * Use to send Message
     *
     * @param string $recipient
     * @param string|Message $message
     * @param string $messageType
     * @param string $notificationType
     * @return array
     */
    public function sendMessage($recipient, $message, $personasId = null ,$messageType = MessagingType::RESPONSE ,$notificationType = NotificationType::REGULAR) {
        $message = $this->createMessage($message);
        $options = RequestOptionsFactory::createForMessage($recipient, $message, $personasId, $messageType, $notificationType);
        $response = $this->client->send("POST", "me/messages", $options);
        return $this->decodeResponse($response);
    }

    /**
     * Quick instance
     * @param string $token
     */
    public static function create(string $token) {
        $client = new Client($token);
        return new self($client);
    }


    /**
     * Add personas
     *
     * @param Personas $personas
     * @return array
     */
    public function addPersonas(Personas $personas){
        $options [RequestOptions::FORM_PARAMS] = $personas->jsonSerialize();
        $response = $this->client->send("POST", "me/personas", $options);
        return $this->decodeResponse($response);
    }

    /**
     * delete personas
     *
     * @param string $personasId
     * @return array
     */
    public function deletePersonas($personasId) {
        $response = $this->client->send("DELETE", "" . $personasId);
        return $this->decodeResponse($response);
    }

    /**
     * Get specify personas
     *
     * @param string $personasId
     * @return array
     */
    public function getPersonas($personasId) {
        $response = $this->client->send("GET", "" . $personasId);
        $data  = $this->decodeResponse($response);
        return PersonasFactory::createOne($data);
    }

    public function getAllPersonas() {
        $response = $this->client->send("GET", "me/personas");
        $data = $this->decodeResponse($response);

        return PersonasFactory::createList($data);
    }
    /**
     * Persistent Menu, Greeting Text, Get_started in messenger.
     *
     * @param  $props
     * @return array
     */
    public function setMessengerOptions($props) {
        $options [RequestOptions::JSON] = $props;
        $response = $this->client->send("POST", "me/messenger_profile", $options);
        return $this->decodeResponse($response);
    }

    /**
     * To delete Persistent Menu, Greeting Text, Get_started button
     *
     * @param string $props
     * @return void
     */
    public function deleteMessengerOptions($props){
        $options = RequestOptionsFactory::createForDeleteProperties($props);
        $response = $this->client->send("DELETE", "me/messenger_profile", $options);
        return $this->decodeResponse($response);
    }
    
    /**
     * @param string|Attachment|Message $message
     * @return Message
     */
    private function createMessage($message) {

        if($message instanceof Message){
            return $message;
        }

        if(is_string($message) || $message instanceof Attachment){
            return new Message($message);
        }
    }

    
}