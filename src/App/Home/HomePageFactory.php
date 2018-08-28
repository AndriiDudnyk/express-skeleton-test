<?php

namespace App\Home;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class HomePageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $dataStore = $container->get('bookHttpStore');
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new HomePageAction($dataStore, $template);
    }
}
