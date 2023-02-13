<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Config;
use App\Entity\Category;
use App\ResponseFormat;
use App\Services\CategoryService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryServiceTest extends TestCase
{
    public function testShow()
    {
        // $request = $this->createMock(Request::class);
        // $response = $this->createMock(Response::class);
        // $args = ['id' => 1];
        // $categoryService = $this->createMock(CategoryService::class);
        // $responseFormat = $this->createMock(ResponseFormat::class);
        // $user = $this->createMock(User::class);
        // $category = new Category();
        // $category->setName('Test');
        // $categoryService->expects($this->once())
        //     ->method('findById')
        //     ->with((int) $args['id'])
        //     ->willReturn($category);
        // $responseFormat->expects($this->once())
        //     ->method('json')
        //     ->with(
        //         $this->equalTo($response),
        //         $this->equalTo(['id' => 1, 'name' => 'Test'])
        //     )
        //     ->willReturn($response);
        // $categoryController = new CategoryController($categoryService, $responseFormat);
        // $actualResponse = $categoryController->show($request, $response, $args);
        // $this->assertSame($response, $actualResponse);
    }
}
