<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserInterface;
use App\DataObjects\RegisterUserData;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class CategoryService
{
    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function create(string $name, User $user): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setUser($user);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;
    }
}