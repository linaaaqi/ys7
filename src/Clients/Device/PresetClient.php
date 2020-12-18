<?php
namespace Losgif\YS7\Clients\Device;

use Losgif\YS7\Clients\BaseClient;

/**
 * 预置点
 * https://open.ys7.com/doc/zh/book/index/device_ptz.html
 */
class PresetClient extends BaseClient
{
    /**
     * 增加预置点
     * https://open.ys7.com/doc/zh/book/index/device_ptz.html#device_ptz-api4
     *
     * @param  mixed  $deviceSerial
     * @param  mixed  $channelNo
     *
     * @return int index
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add($deviceSerial, $channelNo = 1)
    {
        return $this->sendWithAuth('/api/lapp/device/preset/add', [
            'deviceSerial' => $deviceSerial,
            'channelNo' => $channelNo
        ])->json()['data']['index'];
    }

    /**
     * 调用预置点
     * https://open.ys7.com/doc/zh/book/index/device_ptz.html#device_ptz-api5
     *
     * @param  mixed  $deviceSerial
     * @param  int  $index
     * @param  mixed  $channelNo
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function move($deviceSerial, $index = 1, $channelNo = 1)
    {
        $this->sendWithAuth('/api/lapp/device/preset/move', [
            'deviceSerial' => $deviceSerial,
            'channelNo' => $channelNo,
            'index' => $index
        ]);
    }

    /**
     * 清除预置点
     * https://open.ys7.com/doc/zh/book/index/device_ptz.html#device_ptz-api6
     *
     * @param  mixed  $deviceSerial
     * @param  int  $index
     * @param  mixed  $channelNo
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function clear($deviceSerial, $index = 1, $channelNo = 1)
    {
        $this->sendWithAuth('/api/lapp/device/preset/clear', [
            'deviceSerial' => $deviceSerial,
            'channelNo' => $channelNo,
            'index' => $index
        ]);
    }
}
