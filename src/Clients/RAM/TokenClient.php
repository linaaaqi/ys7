<?php
namespace Losgif\YS7\Clients\RAM;

use Losgif\YS7\Auth\BaseAuth;
use Losgif\YS7\Auth\YS7SubAuth;
use Losgif\YS7\Clients\BaseClient;
use Losgif\YS7\YS7Auth;

/**
 * https://open.ys7.com/doc/zh/book/index/account-api.html
 */
class TokenClient extends BaseClient
{
    /**
     * 获取B模式子账户accessToken
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api8
     *
     * @param  mixed  $accountId
     *
     * @return BaseAuth
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken($accountId): BaseAuth
    {
        $resp = $this->sendWithAuth(
            '/api/lapp/ram/token/get', [ 'accountId' => $accountId])->json();
        $data = $resp['data'];
        return new YS7Auth($this->auth->getAppKey(), $data['accessToken']);
    }
}
