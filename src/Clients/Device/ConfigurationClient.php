<?php

namespace Losgif\YS7\Clients\Device;

use Losgif\YS7\Clients\BaseClient;

/**
 * 配置
 * https://open.ys7.com/doc/zh/book/index/device_switch.html
 */
class ConfigurationClient extends BaseClient
{
    /**
     * 视频加密开关
     * https://open.ys7.com/doc/zh/book/index/device_switch.html#device_switch-api2
     *
     * @param  mixed  $deviceSerial
     * @param  mixed  $validateCode
     * @param  mixed  $on
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setEncrypt($deviceSerial, $validateCode, $on = true): void
    {
        $url = '/api/lapp/device/encrypt/';
        $url .= $on ? 'on' : 'off';
        $this->sendWithAuth($url, [
            'deviceSerial' => $deviceSerial,
            'validateCode' => $validateCode
        ]);
    }

    /**
     * 设置镜头遮蔽开关
     * https://open.ys7.com/doc/zh/book/index/device_switch.html#device_switch-api7
     *
     * @param  mixed  $deviceSerial
     * @param  mixed  $enable
     * @param  mixed  $channelNo  通道号，不传表示设备本身
     */
    public function setScene(
        $deviceSerial,
        $enable = true,
        $channelNo = null
    ): void {
        $req = [
            'deviceSerial' => $deviceSerial,
            'enable'       => $enable ? 1 : 0
        ];
        if ($channelNo) {
            $req['channelNo'] = $channelNo;
        }
        $this->sendWithAuth('/api/lapp/device/scene/switch/set', $req);
    }

    /**
     * 开启或关闭设备下线通知
     * https://open.ys7.com/doc/zh/book/index/device_switch.html#device_switch-api19
     *
     * @param  mixed  $deviceSerial
     * @param  mixed  $enable
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setNotify($deviceSerial, $enable = true)
    {
        $this->sendWithAuth('/api/lapp/device/notify/switch', [
            'deviceSerial' => $deviceSerial,
            'enable'       => $enable ? 1 : 0
        ]);
    }

    /**
     * 设置设备移动跟踪开关
     * https://open.ys7.com/doc/zh/book/index/device_switch.html#device_switch-api23
     *
     * @param  mixed  $deviceSerial
     * @param  mixed  $enable
     * @param  mixed  $channelNo  通道号，不传表示设备本身
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setMobile(
        $deviceSerial,
        $enable = true,
        $channelNo = null
    ): void {
        $req = [
            'deviceSerial' => $deviceSerial,
            'enable'       => $enable ? 1 : 0
        ];
        if ($channelNo) {
            $req['channelNo'] = $channelNo;
        }
        $this->sendWithAuth('/api/lapp/device/mobile/status/set', $req);
    }
}
