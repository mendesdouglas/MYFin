<?php

use MYFin\Application;
use MYFin\MYFin\RoutePlugin;
use MYFin\ServiceContainer;

require_once __DIR__ .'/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);
$app ->plugin(new RoutePlugin());

$app->get('/', function(){
     echo "echo world";
});

$app->start();