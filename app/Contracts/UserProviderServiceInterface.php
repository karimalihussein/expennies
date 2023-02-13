<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DataObjects\RegisterUserData;

interface UserProviderServiceInterface
{
    public function getById(int $id): ?UserInterface;

    public function getByCredentials(array $credentials): ?UserInterface;

    public function create(RegisterUserData $data): UserInterface;
}
