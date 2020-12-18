<?php

namespace Losgif\YS7\Policy;

/**
 * 策略
 */
class Statement
{
    public $permissions;
    public $resources;

    /**
     * @param $permissions
     * @param $resources
     *
     * @return \Losgif\YS7\Policy\Statement
     */
    public static function create($permissions, $resources): Statement
    {
        return new static($permissions, $resources);
    }

    /**
     * @param string[]   $permissions
     * @param Resource[] $resources
     */
    public function __construct(array $permissions, array $resources)
    {
        $this->permissions = $permissions;
        $this->resources = $resources;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return [
            'Permission' => implode(",", $this->permissions),
            'Resource' => array_map('str', $this->resources)
        ];
    }
}
