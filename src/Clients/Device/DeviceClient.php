<?php

namespace Losgif\YS7\Clients\Device;

use Losgif\YS7\Clients\BaseClient;

/**
 * 设备
 * https://open.ys7.com/doc/zh/book/index/device.html
 * 仅列举设备管理相关接口,需要传channelNo的请移步camera
 *
 * @property ConfigurationClient $configuration 配置
 * @property CameraClient $camera 摄像头
 * @property FlowClient $flow 人流
 * @property PTZClient $ptz 云台
 * @property VideoClient $video 视频
 */
class DeviceClient extends BaseClient
{
    protected $clients
        = [
            'camera'        => CameraClient::class,
            'configuration' => ConfigurationClient::class,
            'flow'          => FlowClient::class,
            'ptz'           => PTZClient::class,
            'video'         => VideoClient::class
        ];

    /**
     * 添加设备
     * https://open.ys7.com/doc/zh/book/index/device_option.html#device_option-api1
     *
     * @param  mixed  $deviceSerial
     * @param  mixed  $validateCode
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addDevice($deviceSerial, $validateCode): void
    {
        $this->sendWithAuth(
            '/api/lapp/device/add',
            [
                'deviceSerial' => $deviceSerial,
                'validateCode' => $validateCode,
            ]
        );
    }

    /**
     * 删除设备
     * https://open.ys7.com/doc/zh/book/index/device_option.html#device_option-api2
     *
     * @param  mixed  $deviceSerial
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteDevice($deviceSerial): void
    {
        $this->sendWithAuth(
            '/api/lapp/device/delete',
            [
                'deviceSerial' => $deviceSerial
            ]
        );
    }

    /**
     * 获取设备列表
     * https://open.ys7.com/doc/zh/book/index/device_select.html#device_select-api1
     *
     * @param  int  $pageStart
     * @param  int  $pageSize
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(int $pageStart, int $pageSize)
    {
        return $this->sendWithAuth(
            '/api/lapp/device/list',
            [
                'pageStart' => $pageStart ?? 0,
                'pageSize'  => $pageSize ?? 50,
            ]
        )->json()['data'];
    }

    /**
     * 获取单个设备信息
     * https://open.ys7.com/doc/zh/book/index/device_select.html#device_select-api2
     *
     * @param  mixed  $deviceSerial
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function info($deviceSerial)
    {
        return $this->sendWithAuth(
            '/api/lapp/device/info',
            [
                'deviceSerial' => $deviceSerial
            ]
        )->json()['data'];
    }

    /**
     * 根据设备序列号查询设备能力集
     * https://open.ys7.com/doc/zh/book/index/device_select.html#device_select-api5
     *
     * @param  mixed  $deviceSerial
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function capacity($deviceSerial)
    {
        return $this->sendWithAuth(
            '/api/lapp/device/capacity',
            [
                'deviceSerial' => $deviceSerial
            ]
        )->json()['data'];
    }

    /**
     * 获取指定设备的通道信息
     * https://open.ys7.com/doc/zh/book/index/device_select.html#device_select-api6
     *
     * @param  mixed  $deviceSerial
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cameras($deviceSerial)
    {
        return $this->sendWithAuth(
            '/api/lapp/device/camera/list',
            [
                'deviceSerial' => $deviceSerial
            ]
        )->json()['data'];
    }
}
