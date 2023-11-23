<?php


namespace Fakell\BotMessenger\Helpers;

use GuzzleHttp\RequestOptions;
use Fakell\BotMessenger\Client;
use Fakell\BotMessenger\Model\Attachment;
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
    public static function createForMessage($recipient, Message $message, string $personasId = null, $messagingType = MessagingType::RESPONSE, $tag, $notificationType = NotificationType::REGULAR){
        $options = [];
        $data = [
            'messaging_type' => $messagingType,
            'recipient' => [
                "id" => $recipient
            ],
            "tag" => $tag, 
            'message' => $message,
            "persona_id" => $personasId,
            'notification_type' => $notificationType,
        ];

        if($message->hasFileToUpload()){

            $type = $message->getData()->getType();
            
            if($type === Attachment::TYPE_FILE) {
                $mimeType = "application/octect-stream";
            } elseif ($type === Attachment::TYPE_AUDIO){
                $mimeType = "audio/mp3";
            } elseif ($type === Attachment::TYPE_IMAGE){
                $mimeType = "image/png";
            } elseif ($type === Attachment::TYPE_VIDEO){
                $mimeType = "video/mp4";
            }

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
                    'headers' => [
                        'Content-Type' => $mimeType
                    ],
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