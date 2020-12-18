<?php

declare(strict_types=1);

namespace Losgif\YS7;

use Losgif\YS7\Auth\BaseAuth;
use Losgif\YS7\Exceptions\YS7AuthParameterEmptyException;

/**
 * 认证客户端
 */
class YS7Auth extends BaseAuth
{
    private $appKey;

    private $appSecret;

    /**
     * @param $appKey
     * @param $appSecret
     *
     * @return YS7Auth
     */
    public static function create($appKey, $appSecret): YS7Auth
    {
        return new static($appKey, $appSecret);
    }

    /**
     * YS7Auth constructor.
     *
     * @param $appKey
     * @param $appSecret
     */
    public function __construct($appKey, $appSecret)
    {
        if (empty($appKey) || $appKey === '') {
            throw new YS7AuthParameterEmptyException('app key is empty');
        }

        if (empty($appSecret) || $appSecret === '') {
            throw new YS7AuthParameterEmptyException('app secret is empty');
        }

        $this->setAppKey($appKey);
        $this->setAppSecret($appSecret);
    }

    /**
     * @return mixed
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @param  mixed  $appKey
     */
    public function setAppKey($appKey): void
    {
        $this->appKey = $appKey;
    }

    /**
     * @param  mixed  $appSecret
     */
    public function setAppSecret($appSecret): void
    {
        $this->appSecret = $appSecret;
    }
}
