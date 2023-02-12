<?php

declare(strict_types = 1);

namespace App\DataObjects;

use App\Enum\SameSite;

class RegisterUserData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}