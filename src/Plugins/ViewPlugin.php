<?php
declare(strict_types=1);


namespace MYFin\Plugins;


use Interop\Container\ContainerInterface;
use MYFin\ServiceContainerInterface;
#use MYFin\View\Twig\TwigGlobals;
use MYFin\View\ViewRenderer;



//use Psr\Container\ContainerInterface;

class ViewPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig',function(ContainerInterface $container){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
            $twig = new \Twig_Environment($loader);
            
            return $twig;
        });
        $container->addLazy('view.render', function(ContainerInterface $container){
            $twigEnviroment = $container->get('twig');
            return new ViewRenderer($twigEnviroment);
        });
        
    }
  
}