<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\Services\CategoryService;
use App\Validators\CreateCategoryRequestValidator;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class CategoiresController
{
    public function __construct(private readonly Twig $twig, private readonly RequestValidatorFactoryInterface $requestValidator, private readonly CategoryService $categoryService)
    {
    }

    public function index(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'categories/index.twig');
    }


    public function store(Request $request, Response $response): Response
    {
        $data = $this->requestValidator->make(CreateCategoryRequestValidator::class)->validate($request->getParsedBody());
        $this->categoryService->create($data['name'], $request->getAttribute('user'));
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    public function delete(Request $request, Response $response): Response
    {
        // TODO: Implement delete() method.
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }
}
