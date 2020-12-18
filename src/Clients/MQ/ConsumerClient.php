<?php
namespace Losgif\YS7\Clients\MQ;

use Losgif\YS7\Clients\BaseClient;

/**
 * 消费者
 */
class ConsumerClient extends BaseClient
{
    /**
     * 创建消费者
     *
     * @param  int  $group  1-5
     *
     * @return string consumerId
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(int $group = 1): string
    {
        return $this->sendWithAuth('/api/lapp/mq/v1/consumer/group' . $group)->json()['data']['consumerId'];
    }

    /**
     * 获取消息
     *
     * @param  mixed  $consumerId
     * @param  mixed  $preCommit  true为读时标记为消费
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMessages($consumerId, $preCommit = false)
    {
        $req = [
            'consumerId' => $consumerId,
        ];
        if($preCommit) {
            $req['preCommit'] = 1;
        }
        return $this->sendWithAuth('/api/lapp/mq/v1/consumer/messages', $req)->json()['data'];
    }

    /**
     * 消息已读
     *
     * @param  mixed  $consumerId
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function commit($consumerId)
    {
        $this->sendWithAuth('/api/lapp/mq/v1/consumer/offsets', [
            'consumerId' => $consumerId,
        ]);
    }
}
