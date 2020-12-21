<?php

namespace Losgif\YS7\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Losgif\YS7\Auth\BaseAuth;
use Losgif\YS7\Exceptions\YS7BadResponseException;
use Losgif\YS7\Message\Response;
use Losgif\YS7\Traits\RecursiveClientMixin;

/**
 * Class BaseClient
 *
 * @property \Losgif\YS7\YS7Auth $auth
 *
 * @package Losgif\YS7\Clients
 */
class BaseClient
{
    use RecursiveClientMixin;

    protected $auth;

    private $httpClient;

    /**
     * BaseClient constructor.
     *
     * @param  \Losgif\YS7\Auth\BaseAuth  $auth
     * @param  array                      $config
     */
    public function __construct(BaseAuth $auth, array $config = [])
    {
        $this->setAuth($auth);
        $this->setHttpClient(new Client($config));
    }

    public function getAuth(): BaseAuth
    {
        return $this->auth;
    }

    public function setAuth(BaseAuth $auth): void
    {
        $this->auth = $auth;
    }

    /**
     * @return mixed
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @param  mixed  $httpClient
     */
    public function setHttpClient(Client $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param  string  $url
     * @param  array   $data
     * @param  string  $method
     * @param  array   $params
     * @param  array   $headers
     * @param  array   $options
     *
     * @return \Losgif\YS7\Message\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(string $url, $data = [], $method = 'POST', $params = [], $headers = [], $options = []): Response
    {
        $client = $this->httpClient ?? new Client();

        $options = array_merge([
            'form_params' => $data,
            'query' => $params,
            'headers' => $headers,
        ], $options);

        $request = new Request($method, $url);
        $response = $client->request($method, $url, $options);
        $responseObject = new Response($response->getBody()->getContents());
        $responseMessage = $responseObject->json();

        if ($responseMessage['code'] !== '200') {
            throw new YS7BadResponseException($responseMessage['msg'], $request, $response);
        }

        return $responseObject;
    }

    /**
     * @param          $url
     * @param  array   $data
     * @param  string  $method
     * @param  array   $params
     * @param  array   $headers
     * @param  array   $options
     *
     * @return Response
     * @throws GuzzleException
     */
    public function sendWithAuth($url, $data = [], $method = 'POST', $params = [], $headers = [], $options = []): Response
    {

        $data = array_merge([
            'accessToken' => $this->auth->getAccessToken()
        ], $data);

        return $this->send($url, $data, $method, $params, $headers, $options);
    }
}
