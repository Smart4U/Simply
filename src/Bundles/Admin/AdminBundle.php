<?php

namespace Bundles\Admin;


use Core\Bundle\Bundle;
use Core\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;

class AdminBundle extends Bundle
{

    const DEFINITIONS = __DIR__ . '/settings.php';

    private $renderer;

    public function __construct(ContainerInterface $container)
    {
        $container->get(RendererInterface::class)->renderer->addViewPath('admin', __DIR__ . '/Views');
    }

}