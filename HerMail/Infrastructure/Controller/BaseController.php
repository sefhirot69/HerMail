<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Controller;

use function Lambdish\Phunctional\each;

use Shared\Infrastructure\Exceptions\ExceptionsHttpStatusCodeMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseController extends AbstractController
{
    public function __construct(
        private readonly ExceptionsHttpStatusCodeMapping $exceptionMapping,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator,
    ) {
        each(
            fn (int $httpCode, string $exceptionClass) => $this->exceptionMapping->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;

    protected function validateRequest(Request $request, string $class): mixed
    {
        $dto = $this->deserialize($request->getContent(), $class);

        $errors = $this->validator->validate($dto);

        if ($errors->count() > 0) {
            throw new ValidationFailedException($dto, $errors);
        }

        return $dto;
    }

    private function deserialize(string $content, string $class): mixed
    {
        return $this->serializer->deserialize(
            $content,
            $class,
            'json'
        );
    }
}
