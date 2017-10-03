<?php

return [
    'blog.prefix' => '',
    \Bundles\Blog\BlogBundle::class => DI\object()->constructorParameter('prefix', \DI\get('blog.prefix'))
];
