<?php

declare(strict_types=1);

use Laminas\ServiceManager\ServiceManager;

(new Symfony\Component\Dotenv\Dotenv())
    ->usePutenv()
    ->load(__DIR__.'/../.env');

// Load configuration
$config = require __DIR__ . '/config.php';

$dependencies                       = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);
