<?php
declare(strict_type=1);

namespace MYFin\Plugins;

use Aura\Router\RouterContainer;
use MYFin\ServiceContainerInteface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequestFactory;
use Psr\Container\ContainerInterface;

class RouterPlugin implements PluginInterface
{
    public function register(ServiceContainerInteface $container)
    {
        $routerContainer = new RouterContainer();
        /* Register the routes of application */
        $map = $routerContainer->getMap();
        /* Have the function of identify the route that is accessed */
        $matcher = $routerContainer->getMatcher();

        /*Have the funtion to create base link in the registrated routes*/    
        $generator = $routerContainer->getGenerator();
        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator',$generator);
        $container->add(RequestInterface::class,$request);
        
        $container->addLazy('route', function(ContainerInterface $container){
            $matcher = $container->get('routing.matcher');
            $request = $container->get(RequestInterface::class);
            $matcher->match($request);
        });

    }
    protected function getRequest():RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILE
        );

    }

}