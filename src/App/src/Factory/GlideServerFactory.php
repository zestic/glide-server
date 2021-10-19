<?php
declare(strict_types=1);

namespace App\Factory;

use ConfigValue\GatherConfigValues;
use Infinityweb\Glide\Optimizer\OptimizerManipulator;
use League\Glide\Server;
use League\Glide\ServerFactory;
use Psr\Container\ContainerInterface;
use Zestic\Flysystem\Factory\FilesystemFactory;

final class GlideServerFactory
{
    public function __invoke(ContainerInterface $container): Server
    {
        $config = (new GatherConfigValues)($container, 'glide');
        $config['cache'] = (new FilesystemFactory('cache'))($container);
        $config['source'] = (new FilesystemFactory('source'))($container);
        $config['response'] =  new ResponseFactory();

        $server = (new ServerFactory($config))->getServer();

        $manipulators = $server->getApi()->getManipulators();
        $manipulators[] = new OptimizerManipulator();
        $server->getApi()->setManipulators($manipulators);

        return $server;
    }
}
