<?php

namespace Core\Twig;

class DateTimeTwigExtension extends \Twig_Extension
{

    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter('ago', [$this, 'ago'])
        ];
    }

    public function ago(string $datetime, int $maxLength = 140) :string
    {
    }
}
