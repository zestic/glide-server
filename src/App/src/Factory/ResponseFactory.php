<?php
declare(strict_types=1);

namespace App\Factory;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use League\Glide\Responses\PsrResponseFactory;

class ResponseFactory extends PsrResponseFactory
{
    protected $response;
    protected $streamCallback;

    /**
     * Create ZendResponseFactory instance.
     */
    public function __construct()
    {
        $this->response = new Response();
        $this->streamCallback = function ($stream) {
            return new Stream($stream);
        };
    }
}
