<?php

namespace Losgif\YS7\Policy;

/**
 * 资源
 */
class Resource
{
    public const TYPE_DEV = 'dev';
    public const TYPE_CAM = 'cam';

    public $type;
    public $deviceSerial;
    public $channelNo;

    /**
     * @param      $deviceSerial
     * @param null $channelNo
     *
     * @return Resource
     */
    public static function create($deviceSerial, $channelNo = null): Resource
    {
        return new Resource($deviceSerial, $channelNo);
    }

    public function __construct($deviceSerial, $channelNo = null)
    {
        $this->deviceSerial = $deviceSerial;
        $this->channelNo = $channelNo;
        $this->type = $channelNo ? static::TYPE_CAM : static::TYPE_DEV;
    }

    public function __toString(): string
    {
        $rv = "{$this->type}:{$this->deviceSerial}";
        if ($this->channelNo) {
            $rv .= ":{$this->channelNo}";
        }
        return $rv;
    }
}
