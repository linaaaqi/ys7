<?php

namespace Losgif\YS7\Clients;

use Losgif\YS7\Auth\BaseAuth;

/**
 * 令牌
 * https://open.ys7.com/doc/zh/book/index/user.html
 */
class TokenClient extends BaseClient
{
    /**
     * @param  \Losgif\YS7\Auth\BaseAuth  $auth
     *
     * @return \Losgif\YS7\Auth\BaseAuth
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(BaseAuth $auth): BaseAuth
    {
        $resp = $this->send('/api/lapp/token/get', [
            'appKey' => $auth->getAppKey(),
            'appSecret' => $auth->getAppSecret()
        ]);

        $data = $resp->json()['data'];

        $auth->setAccessToken($data['accessToken']);
        $auth->setExpireTime($data['expireTime']);

        return $auth;
    }
}
