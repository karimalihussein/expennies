<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\ResponseFormat;
use App\Services\CategoryService;
use App\Validators\CreateCategoryRequestValidator;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class CategoiresController
{
    public function __construct(
        private readonly Twig $twig, 
        private readonly RequestValidatorFactoryInterface $requestValidator, 
        private readonly CategoryService $categoryService,
        private readonly ResponseFormat $responseFormat
        )
    {
    }

    public function index(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'categories/index.twig', [
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        $category = $this->categoryService->findById((int) $args['id']);
        if(!$category) {
            return $response->withHeader('Location', '/categories')->withStatus(302);
        }
        $data = [
            'id' => $category->getId(),
            'name' => $category->getName(),
        ];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }


    public function store(Request $request, Response $response): Response
    {
        $data = $this->requestValidator->make(CreateCategoryRequestValidator::class)->validate($request->getParsedBody());
        $this->categoryService->create($data['name'], $request->getAttribute('user'));
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $this->categoryService->delete((int) $args['id']);
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }
}
