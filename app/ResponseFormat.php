<?php

declare(strict_types=1);

namespace App;

use App\Contracts\ResponseFormatInterface;
use Psr\Http\Message\ResponseInterface;

class ResponseFormat
{
    public function json(ResponseInterface $response, mixed $data, int $flags = JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR): ResponseInterface
    {
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data, $flags));
        return $response;
    }
}
