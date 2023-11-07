<?php

namespace Fakell\BotMessenger;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use Fakell\BotMessenger\Exception\ApiException;



class Client {

    /**
     * API BASE URI
     */
    const API_BASE_URI = "https://graph.facebook.com/";

    /**
     * API VERSION
     */
    const API_VERSION = 'v18.0';

    /**
     * Request default timeout
     */
    const DEFAULT_TIMEOUT = 60;

    /**
     * Request default file upload timeout
     */
    const DEFAULT_FILE_UPLOAD_TIMEOUT = 500;

    /**
     * @var array
     */
    public static $allowedMethod = ["POST", "GET"];

    /**
     * Page ACCESS TOKEN
     *
     * @var string
     */
    private $accessToken;
    
    /**
     * Guzzle ClientInterface
     *
     * @var ClientInterface client
     */
    private $client;

    /**
     * @var ResponseInterface|null
     */
    private $lastResponse;


    public function __construct(string $accessToken, ClientInterface $httpClient = null)  {
        $this->accessToken = $accessToken;
        $this->client = $httpClient ?: $this->defaultHttpClient();
    }


    public function send(string $method, string $uri, array $options = [], $body = null, array $query = [], array $headers = [], ){
        $options = $this->buildOptions($body, $query, $headers, $options);
        try {
            $this->lastResponse = $this->client->request($method, $uri, $options);
        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }

        $this->validateResponse($this->lastResponse);
        return $this->lastResponse;
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws ApiException
     */
    private function validateResponse(ResponseInterface $response) {
        if ($response->getStatusCode() !== 200) {
            $responseData = json_decode((string) $response->getBody(), true);
            $code = isset($responseData['error']['code']) ? $responseData['error']['code'] : 0;
            $message = isset($responseData['error']['message']) ? $responseData['error']['message'] : $response->getReasonPhrase();

            throw new ApiException($message, $code, $responseData);
        }
    }

    /**
     * Get the last response from the API
     *
     * @return null|ResponseInterface
     */
    public function getLastResponse() {
        return $this->lastResponse;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient() {
        return $this->client;
    }

    /**
     * Build Options for the request
     *
     * @param mixed $body
     * @param array $query
     * @param array $headers
     * @param array $options
     * @return array
     */
    private function buildOptions($body = null, array $query = [], array $headers = [], array $options = []){

        // ADD Token
        $query["access_token"] = $query["access_token"] ?? $this->accessToken;
        
        if(is_array($body)) {
            $body = json_encode($body);
            $headers['Content-Type'] = 'application/json';
        }

        $options [RequestOptions::BODY] = $body;
        $options [RequestOptions::QUERY] = $query;
        $options [RequestOptions::HEADERS] = $headers;
        return $options;
    }

    /**
     * Default HttpClient for Facebook
     *
     * @return ClientInterface
     */
    private function defaultHttpClient() : ClientInterface {
        return new \GuzzleHttp\Client([
            "base_uri" => self::API_BASE_URI . self::API_VERSION,
            "timeout" => self::DEFAULT_TIMEOUT
        ]);
    }
}