<?php

namespace Core\Renderer;

class Renderer
{


    const DEFAULT_NAMESPACE = '__NAMESPACE_BY_DEFAULT__';

    /**
     * @var array
     */
    private $paths = [];

    /**
     * @var array
     */
    private $globals = [];

    /**
     * Add new folder path
     *
     * @param string $namespace
     * @param null|string $path
     */
    public function addViewPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }

    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view);
        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] . '/' . $view;
        }
        ob_start();
        $renderer = $this;
        extract($this->globals);
        extract($params);
        require($path);
        return ob_get_clean();
    }

    /**
     * Add
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value): void
    {
        $this->globals[$key] = $value;
    }

    /**
     * Detect if has a custom path register
     *
     * @param string $view
     * @return bool
     */
    private function hasNamespace(string $view) : bool
    {
        return $view[0] === '@';
    }

    /**
     * Get the current namespace
     *
     * @param string $view
     * @return string
     */
    private function getNamespace(string $view) : string
    {
        return substr($view, 1, strpos($view, '/') -1);
    }

    /**
     * Return the namespace
     *
     * @param string $view
     * @return string
     */
    private function replaceNamespace(string $view) : string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }
}
