<?php

namespace App\Validators;

use App\Contracts\RequestValidatorInterface;
use App\Entity\User;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Valitron\Validator;

class UpdateCategoryRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);
        $v->rule('required', ['name', 'id']);
        $v->labels([
            'name' => 'Name',
        ]);
        if (!$v->validate()) {
            throw new ValidationException($v->errors());
        }
        return $data;
    }
}
