<?php
namespace Fakell\BotMessenger;

use Fakell\BotMessenger\Helpers\CallbackEventFactory;
use GuzzleHttp\Psr7\ServerRequest;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WebhookRequestHandler {

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var ServerResquestInterface
     */
    private $request;


    public function __construct() {
        $this->request = ServerRequest::fromGlobals();
        $this->dispatcher = new EventDispatcher;
    }



    /**
     * Dispatch event
     *
     * @return void
     */
    public function dispatch(){

        if(!$this->isValidCallbackRequest() && !$this->isVerifyTokenRequest()) return;

        if($this->isVerifyTokenRequest()){
            $event = CallbackEventFactory::createForVerify($this->getParams());
        } else {
            $event = CallbackEventFactory::create($this->getDecodedBody());
        }

        $this->dispatcher->dispatch($event, $event->getName());
    }

    /**
     * @param EventSubscriberInterface $subscriber
     * @return void
     */
    public function addSubscriber(EventSubscriberInterface $subscriber){
        $this->dispatcher->addSubscriber($subscriber);
    }

    /**
     * @return boolean
     */
    public function isVerifyTokenRequest() {
        if($this->request->getMethod() !== "GET") return false;

        $params = $this->request->getQueryParams();
        if (!isset($params['hub_verify_token']) || !isset($params['hub_mode']) || !isset($params['hub_challenge'])) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getParams(){
        return $this->request->getQueryParams();
    }

    /**
     * Check if the request is a valid webhook request
     *
     * @return bool
     */
    public function isValidCallbackRequest(){

        $decoded = $this->getDecodedBody();

        $object = isset($decoded['object']) ? $decoded['object'] : null;
        $entry = isset($decoded['entry']) ? $decoded['entry'] : null;

        return $object === 'page' && null !== $entry;
    }


    public function getDecodedBody(){

        $body = (string) $this->getRequest()->getBody();
        return json_decode($body, true);
    }


    /**
     * @return ServerRequestInterface
     */
    public function getRequest(){
        return $this->request;
    }

}