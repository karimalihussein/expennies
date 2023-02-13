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
        $category->setUser($user);
        return $this->update($category, $name);
    }

    public function getAll(): array
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }

    public function delete(int $id): void
    {
        $category = $this->entityManager->getRepository(Category::class)->find($id);
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }

    public function findById(int $id): ?Category
    {
        return $this->entityManager->getRepository(Category::class)->find($id);
    }

    public function update(Category $category, string $name): Category
    {
        $category->setName($name);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;
    }
}
