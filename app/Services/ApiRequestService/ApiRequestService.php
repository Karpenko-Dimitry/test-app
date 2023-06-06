<?php

namespace App\Services\ApiRequestService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiRequestService
{
    private Client $client;
    private string $method = 'get';
    private string $url = '';
    private string $errorCode;
    private string $errorMessage;

    public function __construct() {
        $this->client = new Client();
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method): static
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param string $errorCode
     * @return $this
     */
    public function setErrorCode(string $errorCode): static
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage(string $errorMessage): static
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return false|mixed
     * @throws \JsonException
     */
    public function execute(): mixed
    {
        try {
            $response = $this->client->request($this->method, $this->url);
        } catch (GuzzleException $e) {
            $code = $e->getCode();
            $message = $e->getMessage();

            $this->setErrorCode($e->getCode());
            $this->setErrorMessage($e->getMessage());

            log_debug('Api request service error', compact('code', 'message'));

            return false;
        }

        return json_decode($response->getBody(), true);
    }
}
