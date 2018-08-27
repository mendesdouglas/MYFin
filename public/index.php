<?php

use MYFin\Application;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use MYFin\Plugins\RoutePlugin;
use MYFin\ServiceContainer;
use MYFin\Plugins\ViewPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());

$app->get('/', function(ServerRequestInterface $request)use($app){
    $view = $app->service('view.renderer');
    return $view->render('teste.html.twig',['name'=>'Douglas']);
});

$app->get('/home/{name}/{id}', function(ServerRequestInterface $request){
    $response = new Response();
    $response->getBody()->write("response com emiter do diactors");
    return $response;
});
$app->start();