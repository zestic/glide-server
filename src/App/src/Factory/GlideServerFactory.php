<?php
declare(strict_types=1);

namespace App\Factory;

use ConfigValue\GatherConfigValues;
use League\Glide\Server;
use League\Glide\ServerFactory;
use Psr\Container\ContainerInterface;

final class GlideServerFactory
{
    public function __invoke(ContainerInterface $container): Server
    {
        $config = (new GatherConfigValues)($container, 'glide');
        $config['cache'] = (new \Zestic\Flysystem\Factory\FilesystemFactory('cache'))($container);
        $config['source'] = (new \Zestic\Flysystem\Factory\FilesystemFactory('source'))($container);
        $config['response'] =  new ResponseFactory();

        return (new ServerFactory($config))->getServer();
    }
}
