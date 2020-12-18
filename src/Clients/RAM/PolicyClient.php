<?php

namespace Losgif\YS7\Clients\RAM;

use GuzzleHttp\Exception\GuzzleException;
use Losgif\YS7\Clients\BaseClient;
use Losgif\YS7\Policy\Statement;
use Psr\Http\Message\ResponseInterface;

/**
 * 权限策略
 * https://open.ys7.com/doc/zh/book/index/account-api.html
 */
class PolicyClient extends BaseClient
{
    /**
     * 设置子账户的授权策略
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api5
     *
     * @param string      $accountId
     * @param Statement[] $policy
     *
     * @throws GuzzleException
     */
    public function setPolicy(string $accountId, array $policy): void
    {
        $this->sendWithAuth(
            '/api/lapp/ram/policy/set',
            [
                'accountId' => $accountId,
                'policy' => json_encode([
                    "Statement" => map(function ($o) {
                        return $o->data();
                    }, $policy)
                ])
            ]);
    }

    /**
     * 增加子账户权限
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api6
     *
     * @param string      $accountId
     * @param Statement[] $policy
     *
     * @throws GuzzleException
     */
    public function addPolicy(string $accountId, array $policy): void
    {
        $this->sendWithAuth(
            '/api/lapp/ram/policy/add',
            [
                'accountId' => $accountId,
                'policy' => json_encode([
                    "Statement" => map(function ($o) {
                        return $o->data();
                    }, $policy)
                ])
            ]);
    }

    /**
     * 删除子账户权限
     * https://open.ys7.com/doc/zh/book/index/account-api.html#account-api7
     *
     * @param string $accountId
     * @param string $deviceSerial
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function deletePolicy(string $accountId, string $deviceSerial): ResponseInterface
    {
        $this->sendWithAuth(
            '/api/lapp/ram/policy/delete',
            [
                'accountId' => $accountId,
                'deviceSerial' => $deviceSerial
            ]);
    }
}
