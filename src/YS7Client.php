<?php


namespace Losgif\YS7;

use Losgif\YS7\Auth\BaseAuth;
use Losgif\YS7\Clients\BaseClient;

/**
 * YS7Client
 *
 * @property Clients\AI\AIClient         $ai     AI
 * @property Clients\Device\DeviceClient $device 设备
 * @property Clients\EZOpen              $ezopen ezopen
 * @property Clients\LiveClient          $live   直播
 * @property Clients\MQ\MQClient         $mq     消息
 * @property Clients\RAM\RAMClient       $ram    子账户
 * @property Clients\TokenClient         $token  令牌
 *
 * @method Clients\AI\AIClient ai()
 * @method Clients\Device\DeviceClient device()
 * @method Clients\EZOpen ezopen()
 * @method Clients\LiveClient live()
 * @method Clients\MQ\MQClient mq()
 * @method Clients\RAM\RAMClient ram()
 * @method Clients\TokenClient token()
 */
class YS7Client extends BaseClient
{
    protected $config
        = [
            'base_uri' => 'https://open.ys7.com',
            'timeout'  => 3.0,
        ];

    protected $clients
        = [
            'ai'     => Clients\AI\AIClient::class,
            'device' => Clients\Device\DeviceClient::class,
            'ezopen' => Clients\EZOpen::class,
            'live'   => Clients\LiveClient::class,
            'mq'     => Clients\MQ\MQClient::class,
            'ram'    => Clients\RAM\RAMClient::class,
            'token'  => Clients\TokenClient::class,
        ];

    /**
     * YS7Client constructor.
     *
     * @param  \Losgif\YS7\Auth\BaseAuth  $auth
     */
    public function __construct(BaseAuth $auth)
    {
        parent::__construct($auth, $this->config);
    }
}