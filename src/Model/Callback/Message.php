<?php


namespace Fakell\BotMessenger\Model\Callback;


class Message {


    /**
     * @var string|null
     */
    private ?string $text;

    /**
     * @var string|null
     */
    private ?string $quickReplyPayload;

    /**
     * @var array|null
     */
    private ?array $attachments;


    public function __construct(?string $text, ?string $quickReplyPayload, ?array $attachments){
        $this->text = $text;
        $this->quickReplyPayload = $quickReplyPayload;
        $this->attachments = $attachments;
    }

    /**
     * @return boolean
     */
    public function hasAttachment(){
        return $this->attachments !== [];
    }


    /**
     * @return boolean
     */
    public function hasQuickReply(){
        return $this->quickReplyPayload !== null;
    }

    /**
     * @return boolean
     */
    public function hasText(){
        return $this->text !== null;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function create(array $data){
        $text = $data["text"] ?? null;
        $attachments = isset($data['attachments']) ? $data['attachments'] : [];
        $quickReply = isset($data['quick_reply']) ? $data['quick_reply']['payload'] : null;

        return new static($text, $quickReply, $attachments);
    }

    /**
     * Get the value of text
     *
     * @return  string|null
     */ 
    public function getText(){
        return $this->text;
    }

    /**
     * Get the value of quickReplyPayload
     *
     * @return  string|null
     */ 
    public function getQuickReplyPayload(){
        return $this->quickReplyPayload;
    }

    /**
     * Get the value of attachments
     *
     * @return  array|null
     */ 
    public function getAttachments(){
        return $this->attachments;
    }
}