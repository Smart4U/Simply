<?php

namespace Core\Routing;

/**
 * Class Route
 * Represents a valid route
 */
class Route
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var callable
     */
    private $callback;

    /**
     * @var array
     */
    private $params;

    /**
     * Route constructor.
     * @param string $name
     * @param callable|string $callback
     * @param array $params
     */
    public function __construct(string $name, $callback, array $params = [])
    {
        $this->name = $name;
        $this->callback = $callback;
        $this->params = $params;
    }

    /**
     * Get the name of the route
     * @return string
     */
    public function getRouteName() :string
    {
        return $this->name;
    }

    /**
     * Get the callback
     * @return callable|string
     */
    public function getRouteCallback()
    {
        return $this->callback;
    }

    /**
     * Generate the path of the route named
     * @return array
     */
    public function getRouteParams(): array
    {
        return $this->params;
    }
}
