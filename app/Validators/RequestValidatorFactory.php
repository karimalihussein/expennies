<?php

namespace App\Validators;

use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\RequestValidatorInterface;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Valitron\Validator;

class RequestValidatorFactory implements RequestValidatorFactoryInterface
{
    public function __construct(private readonly ContainerInterface $container)
    {
    }

    public function make(string $class): RequestValidatorInterface
    {
        $validator = $this->container->get($class);

        if ($validator instanceof RequestValidatorInterface) {
            return $validator;
        }

        throw new \RuntimeException('Failed to instantiate the request validator class "' . $class . '"');
    }
}
