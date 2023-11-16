<?php

namespace Fakell\BotMessenger\Model;

use Fakell\BotMessenger\Model\Attachment\File;


class Message implements  \JsonSerializable {

    const TYPE_TEXT = "text";
    const TYPE_ATTACHEMENT = "attachment";

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string|Attachment
     */
    private $data;

    /**
     * @var QuickReply[]
     */
    private $quickReplies = null;


    /**
     * @param string|Attachment $data
     */
    public function __construct($data){

        if(is_string($data)){
            $this->type = self::TYPE_TEXT;
        } elseif ($data instanceof Attachment) {
            $this->type = self::TYPE_ATTACHEMENT;
        }
        $this->data = $data;

        return $this;
    }



    /**
     * Add one quick reply
     *
     * @param QuickReply $quickReply
     * @return self
     */
    public function addQuickReply(QuickReply $quickReply){
        if($this->quickReplies == null){
            $this->quickReplies = [$quickReply];
            return $this;  
        } 
        
        $this->quickReplies = array_merge($this->quickReplies,[$quickReply]);
        return $this;
    }
    
    /**
     * Is Upload
     *
     * @return boolean
     */
    public function hasFileToUpload(){
        if($this->data instanceof File) {
            if($this->data->isRemoteFile()) return false;
            return true;
        }
        return false;
    }

    
    /**
     * Get file ressource
     *
     * @return null|ressource
     */
    public function getFileStream() {
        if(!$this->data instanceof File){
            throw new \RuntimeException("Data is not a File Object");
        }
        return $this->data->getStream();
    }


    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            $this->type => $this->data,
            "quick_replies" => $this->quickReplies
        ];
    }

    /**
     * Get the value of quickReplies
     *
     * @return  QuickReply[]
     */ 
    public function getQuickReplies() {
        return $this->quickReplies;
    }

    /**
     * Set the value of quickReplies
     *
     * @param  QuickReply[]  $quickReplies
     *
     * @return  self
     */ 
    public function setQuickReplies( $quickReplies)
    {
        $this->quickReplies = $quickReplies;

        return $this;
    }
}