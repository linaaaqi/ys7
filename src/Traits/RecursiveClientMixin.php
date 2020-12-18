<?php

namespace Losgif\YS7\Traits;

use InvalidArgumentException;
use Losgif\YS7\Clients\BaseClient;
use ReflectionException;

/**
 * Trait RecursiveClientMixin
 *
 * @property $clients
 *
 * @package Losgif\YS7\Traits
 */
trait RecursiveClientMixin
{
    /**
     * @param         $cls
     * @param  array  $args
     *
     * @return object
     * @throws ReflectionException
     */
    protected function createChildClient($cls, $args = []): object
    {
        $reflectionClass = new \ReflectionClass($cls);
        if ($reflectionClass->isSubclassOf(BaseClient::class)
            && is_a($this, BaseClient::class)
        ) {
            $args = array_merge([$this->getAuth()], $args);
        }
        $client = $reflectionClass->newInstanceArgs($args);
        $client->setHttpClient($this->getHttpClient());
        $client->setAuth($this->getAuth());

        return $client;
    }

    /**
     * @param $name
     *
     * @return mixed|object
     * @throws ReflectionException
     */
    public function __get($name): object
    {
        if (!array_key_exists($name, $this->clients)) {
            throw new InvalidArgumentException('invalid api client: '.$name);
        }

        if (is_string($this->clients[$name])) {
            $cls = $this->clients[$name];
            $this->clients[$name] = $this->createChildClient($cls);
        }

        return $this->clients[$name];
    }

    /**
     * @param $name
     * @param $client
     */
    public function __set($name, BaseClient $client): void
    {
        if (!array_key_exists($name, $this->clients)) {
            throw new InvalidArgumentException('invalid api client: '.$name);
        }

        $this->clients[$name] = $client;
    }

    /**
     * @param $name
     */
    public function __isset($name)
    {
        // TODO: Implement __isset() method.
    }

    /**
     * @param $name
     * @param $args
     *
     * @return mixed|object
     * @throws ReflectionException
     */
    public function __call($name, $args): object
    {
        if (!\array_key_exists($name, $this->clients)) {
            throw new InvalidArgumentException('invalid api client: '.$name);
        }

        $key = $name.implode(
                ',',
                array_map(
                    static function ($o) {
                        if (is_object($o)) {
                            return spl_object_hash($o);
                        }

                        if (is_array($o)) {
                            return json_encode($o);
                        }

                        return (string)$o;
                    },
                    $args
                )
            );

        if (!isset($this->clients[$key])) {
            $cls = $this->clients[$name];
            $this->clients[$key] = $this->createChildClient($cls, $args);
        }

        if(is_string($this->clients[$name])) {
            $cls = $this->clients[$name];
            $this->clients[$name] = $this->createChildClient($cls);
        }

        return $this->clients[$key];
    }
}
