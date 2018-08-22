<?php

namespace  MYFin;

use Xtreamwayz\Pimple\Container;
use MYFin\ServiceContainerInteface;


class ServiceContainer implements ServiceContainerInteface
{
    private $container;
    /**
     * ServiceContainer constructor.
     *
     * @param $container
     */
    public function __construct()
    {
        $this->container = new Container();
    }
    public function add(string $name, $service)
    {
        $this->container[$name] = $service;
    }
    public function addLazy(string $name, callable $callable)
    {
        $this->container[$name] = $this->container->factory($callable);
    }
    public function get(string $name)
    {
        return $this->container->get($name);
    }
    public function has(string $name)
    {
        return $this->container->has($name);
    }
}