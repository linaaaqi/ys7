<?php
namespace Losgif\YS7\Clients\RAM;

use Losgif\YS7\Clients\BaseClient;

/**
 * https://open.ys7.com/doc/zh/book/index/account-api.html
 */
class AccountClient extends BaseClient
{
    /**
     * 创建子账户
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api1
     *
     * @param  mixed  $accountName
     * @param  mixed  $password
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createAccount($accountName, $password): string
    {
        return $this->sendWithAuth(
            '/api/lapp/ram/account/create',
            [
                'accountName' => $accountName,
                'password' => strtolower(md5($this->auth->getAppKey() . '#' . $password))
            ])->json()['data']['accountId'];
    }

    /**
     * 获取单个子账户信息
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api2
     *
     * @param  mixed  $accountId
     * @param  mixed  $accountName
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccount($accountId = null, $accountName = null): array
    {
        $req = [];
        if($accountId) {
            $req['accountId'] = $accountId;
        }
        if($accountName) {
            $req['accountName'] = $accountName;
        }
        return $this->sendWithAuth('/api/lapp/ram/account/get', $req)->json()['data'];
    }

    /**
     * 获取子账户信息列表
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api3
     *
     * @param  int  $pageStart
     * @param  int  $pageSize
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(int $pageStart = 0, int $pageSize = 50)
    {
        return $this->sendWithAuth('/api/lapp/ram/account/list', [
            'pageStart' => $pageStart,
            'pageSize' => $pageSize,
        ])->json()['data'];
    }

    /**
     * 修改当前子账户密码
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api4
     *
     * @param  mixed  $accountId
     * @param  mixed  $password
     * @param  mixed  $oldPassword
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updatePassword($accountId, $password, $oldPassword)
    {
        return $this->sendWithAuth(
            '/api/lapp/ram/account/updatePassword',
            [
                'accountId' => $accountId,
                'oldPassword' => strtolower(md5($this->auth->getAppKey() . '#' . $oldPassword)),
                'newPassword' => strtolower(md5($this->auth->getAppKey() . '#' . $password))
            ])->json()['data'];
    }

    /**
     * 删除子账户
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api9
     *
     * @param  mixed  $accountId
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAccount($accountId)
    {
        return $this->sendWithAuth('/api/lapp/ram/account/delete', [
            'accountId' => $accountId
        ])->json()['data'];
    }
}
