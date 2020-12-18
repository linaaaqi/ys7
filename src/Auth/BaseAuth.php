<?php

namespace Losgif\YS7\Auth;

use Losgif\YS7\Exceptions\YS7AuthParameterEmptyException;

/**
 * Class BaseAuth
 *
 * @package Losgif\YS7\Auth
 */
abstract class BaseAuth
{
    private $accessToken;
    private $expireTime;

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        if (empty($this->accessToken)) {
            throw new YS7AuthParameterEmptyException('access token is empty!');
        }

        return $this->accessToken;
    }

    /**
     * @param  mixed  $accessToken
     */
    public function setAccessToken($accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getExpireTime()
    {
        return $this->expireTime ?? time() * 1000;
    }

    /**
     * @param  mixed  $expireTime
     */
    public function setExpireTime($expireTime): void
    {
        $this->expireTime = $expireTime;
    }
}
