<?php

namespace MYFin\Plugins;


use MYFin\ServiceContainerInteface;

interface PluginInterface
{
    public function register(ServiceContainerInteface $container);
}