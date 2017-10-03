<?php

return [
    'contact.prefix' => '',
    \Bundles\Contact\ContactBundle::class => DI\object()->constructorParameter('prefix', \DI\get('contact.prefix'))
];
