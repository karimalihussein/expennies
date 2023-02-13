<?php

namespace App\Validators;

use App\Contracts\RequestValidatorInterface;
use App\Entity\User;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Valitron\Validator;

class RegisterUserRequestValidator implements RequestValidatorInterface
{
    public function __construct(private readonly EntityManager $entityManager)
    {
        // TODO: inject dependencies    
    }

    public function validate(array $data): array
    {
        $v = new Validator($data);
        $v->rule('required', ['name', 'email', 'password', 'confirmPassword']);
        $v->rule('email', 'email');
        $v->rule('lengthMin', 'password', 6);
        $v->rule('equals', 'password', 'confirmPassword');
        $v->rule(fn ($field, $value, $params, $fields) => !$this->entityManager->getRepository(User::class)->count(['email' => $value]), 'email')->message('User with the given email address already exists');
        $v->labels([
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
        ]);
        if (!$v->validate()) {
            throw new ValidationException($v->errors());
        }
        return $data;
    }
}
