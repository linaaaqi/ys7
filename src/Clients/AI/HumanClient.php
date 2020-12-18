<?php

namespace Losgif\YS7\Clients\AI;

use Losgif\YS7\Clients\BaseClient;

/**
 * 人体人形识别
 * https://open.ys7.com/doc/zh/book/index/ai/body.html
 */
class HumanClient extends BaseClient
{
    /**
     * 检测人数
     * https://open.ys7.com/doc/zh/book/index/ai/body.html#body-api2
     *
     * @param  mixed  $image
     *
     * @return int
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detectNum($image): int
    {
        return $this->sendWithAuth('/api/lapp/intelligence/human/analysis/detect',
            [
                'image'     => $this->handleImage($image),
                'dataType'  => 1,
                'operation' => 'number'
            ])->json()['data']['number'];
    }

    /**
     * 标记人坐标
     * https://open.ys7.com/doc/zh/book/index/ai/body.html#body-api2
     *
     * @param $image
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detectRect($image)
    {
        return $this->sendWithAuth('/api/lapp/intelligence/human/analysis/detect',
            [
                'image'     => $this->handleImage($image),
                'dataType'  => 1,
                'operation' => 'rect'
            ])->json()['data']['locations'];
    }

    /**
     * @param $image
     *
     * @return string
     */
    protected function handleImage($image): string
    {
        if (\is_string($image)) {
            $image = file_get_contents($image);
        }
        return base64_encode($image);
    }
}
