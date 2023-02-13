<?php

namespace App\Validators;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Valitron\Validator;

class LoginUserRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);
        $v->rule('required', ['email', 'password']);
        $v->rule('email', 'email');
        $v->labels([
            'email' => 'Email',
            'password' => 'Password',
        ]);
        if (!$v->validate()) {
            throw new ValidationException($v->errors());
        }
        return $data;
    }
}
