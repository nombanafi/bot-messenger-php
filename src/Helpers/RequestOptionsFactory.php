<?php


namespace Fakell\BotMessenger\Helpers;

use GuzzleHttp\RequestOptions;
use Fakell\BotMessenger\Client;
use Fakell\BotMessenger\Model\Message;
use Fakell\BotMessenger\Model\Personas\Personas;
use Fakell\BotMessenger\Types\MessagingType;
use Fakell\BotMessenger\Types\NotificationType;


class RequestOptionsFactory {



    /**
     * Create options for typing
     *
     * @param string $recipient
     * @param string $typingIndicator
     * @return array
     */
    public static function createForTyping($recipient, $actionType){
        $options = [];
        $data = [
            "recipient" => [
                "id" => $recipient
            ],
            "sender_action" => $actionType,
        ];
        $options [RequestOptions::JSON] = $data;
        return $options;
    }

    /**
     * Create options for message
     *
     * @param string $recipient
     * @param Message $message
     * @param string $messagingType
     * @param string $notificationType
     * @return array
     */
    public static function createForMessage($recipient, Message $message, string $personasId = null, $messagingType = MessagingType::RESPONSE ,$notificationType = NotificationType::REGULAR){
        $options = [];
        $data = [
            'messaging_type' => $messagingType,
            'recipient' => [
                "id" => $recipient
            ],
            'message' => $message,
            "persona_id" => $personasId,
            'notification_type' => $notificationType,
        ];

        if($message->hasFileToUpload()){
             // Create a multipart request
            $options[RequestOptions::MULTIPART] = [
                [
                    'name' => 'messaging_type',
                    'contents' => $messagingType
                ],
                [
                    'name' => 'recipient',
                    'contents' => json_encode($data['recipient']),
                ],
                [
                    'name' => 'message',
                    'contents' => json_encode($data['message']),
                ],
                [
                    'name' => 'notification_type',
                    'contents' => $data['notification_type'],
                ],
                [
                    'name' => 'filedata',
                    'contents' => $message->getFileStream(),
                ],
                [
                    "name" => "persona_id",
                    "contents" => $personasId
                ]
            ];
            $options[RequestOptions::TIMEOUT] = Client::DEFAULT_FILE_UPLOAD_TIMEOUT;
            return $options;
        }

        $options [RequestOptions::JSON] = $data;
        return $options;
    }

    public static function createForDeleteProperties($props) {
        $options [RequestOptions::JSON] = [
            "fields" => [$props]
        ];
        return $options;
    }
}