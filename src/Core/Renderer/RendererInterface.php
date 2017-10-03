<?php

namespace Core\Renderer;

interface RendererInterface
{
    public function addViewPath(string $namespace, ?string $path = null): void;

    public function render(string $view, array $params = []): string;

    public function addGlobal(string $key, $value): void;
}
