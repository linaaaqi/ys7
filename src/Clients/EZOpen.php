<?php

namespace Losgif\YS7\Clients;

/**
 * EZOPEN协议
 * https://open.ys7.com/doc/zh/readme/ezopen.html
 */
class EZOpen extends BaseClient
{
    public static $defaultOptions = [
        'resolution' => '',  // 清晰度,空标准,hd高清
        'baseUrl' => 'ezopen://open.ys7.com/',
    ];

    /**
     * 获取直播地址
     *
     * @param string $deviceSerial
     * @param int    $channelNo
     * @param array  $options
     *
     * @return string
     */
    public function live(string $deviceSerial, $channelNo = 1, $options = []): string
    {
        return $this->getEZUrl($deviceSerial, $channelNo, '.live', $options);
    }

    /**
     * 录制地址
     *
     * @param string $deviceSerial
     * @param int    $channelNo
     * @param null   $start 开始时间时间戳
     * @param null   $end   结束时间时间戳
     * @param array  $options
     *
     * @return string
     */
    public function rec(string $deviceSerial, int $channelNo = 1, $start = null, $end = null, $options = []): string
    {
        if ($start) {
            $options['start'] = (new \DateTime("@$start"))->format('YmdHis');
        }
        if ($end) {
            $options['end'] = (new \DateTime("@$end"))->format('YmdHis');
        }
        return $this->getEZUrl($deviceSerial, $channelNo, '.rec', $options);
    }

    /**
     * @param string $deviceSerial
     * @param int    $channelNo
     * @param        $type
     * @param array  $options
     *
     * @return string
     */
    private function getEZUrl(string $deviceSerial, int $channelNo, $type, $options = []): string
    {
        $options = array_merge(static::$defaultOptions, $options);
        $videoId = $this->getVideoId($deviceSerial, $channelNo);
        $url = $options['baseUrl'] . $videoId;
        if ($options['resolution']) {
            $url .= '.' . $options['resolution'];
        }
        $url .= $type;
        unset($options['baseUrl'], $options['resolution']);

        if ($queryStr = http_build_query($options)) {
            $url .= '?' . $queryStr;
        }

        return $url;
    }

    /**
     * @param $deviceSerial
     * @param $channelNo
     *
     * @return string
     */
    private function getVideoId($deviceSerial, $channelNo): string
    {
        $data = $this->getBaseClient()->live->address($deviceSerial, null, $channelNo);
        $originAddress = $data['liveAddress'];
        $originPath = parse_url($originAddress, PHP_URL_PATH);
        $array = explode('/', $originPath);
        $filename = array_pop($array);
        return explode('.', $filename)[0];
    }
}
