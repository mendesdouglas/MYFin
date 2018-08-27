<?php

namespace MYFin\Plugins;


use MYFin\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}