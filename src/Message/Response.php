<?php

namespace Losgif\YS7\Message;

class Response
{
    private $responseString;

    /**
     * Response constructor.
     *
     * @param $responseString
     */
    public function __construct($responseString)
    {
        $this->setResponseString($responseString);
    }

    /**
     * @return mixed
     */
    public function getResponseString()
    {
        return $this->responseString;
    }

    /**
     * @param  mixed  $responseString
     */
    public function setResponseString($responseString): void
    {
        $this->responseString = $responseString;
    }

    /**
     * @return array
     */
    public function json(): array
    {
        return json_decode($this->getResponseString(), true);
    }
}