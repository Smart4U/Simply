<?php

require __DIR__ . '/public/index.php';

$migrations = [];
$seeds = [];

foreach ($bundles as $bundle) {
    if ($bundle::MIGRATIONS) {
        $migrations[] = $bundle::MIGRATIONS;
    }
    if ($bundle::SEEDS) {
        $seeds[] = $bundle::SEEDS;
    }
}

return [

    'paths' => [
        'migrations' => $migrations,
        'seeds'      => $seeds
    ],

    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',

        'development' => [
            'adapter'    => 'mysql',
            'host'       => $app->getContainer()->get('db.host'),
            'name'       => $app->getContainer()->get('db.name'),
            'user'       => $app->getContainer()->get('db.user'),
            'pass'       => $app->getContainer()->get('db.pass'),
            'port'       => $app->getContainer()->get('db.port')
        ]

    ]

];