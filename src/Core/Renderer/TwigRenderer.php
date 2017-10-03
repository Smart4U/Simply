<?php

namespace Core\Renderer;

class TwigRenderer implements RendererInterface
{

    private $twig;
    private $loader;

    public function __construct(string $defaultPath)
    {
        $this->loader = new \Twig_Loader_Filesystem($defaultPath);
        $this->twig = new \Twig_Environment($this->loader, []);
    }

    public function addViewPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }

    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view, $params);
    }

    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}
