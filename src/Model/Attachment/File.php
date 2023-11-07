<?php


namespace Fakell\BotMessenger\Model\Attachment;

use Fakell\BotMessenger\Model\Attachment;

class File extends Attachment {

    /**
     * @var string
     */
    private $path;
    /**
     * @var null|ressource
     */
    private $stream;


    public function __construct(string $filePath, $type = Attachment::TYPE_FILE){
        $this->path = $filePath;
        $payload = [
            "is_reusable" => true
        ];
        if($this->isRemoteFile()){
            $payload["url"] = $this->path;
        }
        parent::__construct($type, $payload);
    }

    public function open() {
        if($this->stream) {
            return;
        }
        
        if($this->isRemoteFile()) {
            throw new \InvalidArgumentException(("Can not open remote file"));
        }

        if(!is_readable($this->path)) {
            throw new \InvalidArgumentException(sprintf("%s should be a readable file", $this->path));
        } 

        $this->stream = fopen($this->path, "r");

        if(!$this->stream) {
            throw new \RuntimeException(sprintf("Unable to open %s", $this->path));
        }
    }

    public function isRemoteFile(){
        return preg_match("/^https\:\/\//", $this->path) === 1;
    }

    public function getStream() {
        $this->open();
        return $this->stream;
    }

    public function getPath() {
        return $this->path;
    }

}
