<?php
namespace Losgif\YS7\Clients\Device;

use Losgif\YS7\Clients\BaseClient;

/**
 * https://open.ys7.com/doc/zh/book/index/device.html
 */
class VideoClient extends BaseClient
{
    /**
     * @param $deviceSerial
     * @param  null  $startTime
     * @param  null  $endTime
     * @param  int  $channelNo
     * @param  int  $recType
     *
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function records($deviceSerial, $startTime = null, $endTime = null, $channelNo = 1, $recType = 0): array
    {
        $req = [
            'deviceSerial' => $deviceSerial,
            'channelNo' => $channelNo,
            'recType' => $recType
        ];
        if($startTime) {
            $req['startTime'] = $startTime * 1000;
        }
        if($endTime) {
            $req['endTime'] = $endTime * 1000;
        }
        return $this->sendWithAuth('/api/lapp/video/by/time', $req)->json()['data']?: [];
    }
}
