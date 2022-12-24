<?php

declare(strict_types=1);

namespace App\Handler;

use League\Glide\Server;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GlideHandler implements RequestHandlerInterface
{
    public function __construct(
        private Server $server,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $filename = $request->getAttribute('filename') . '.' . $request->getAttribute('ext');

        return $this->server->getImageResponse($filename, $_GET);
    }
}
