<?php

declare(strict_types=1);

namespace App\Controller;

use App\Shared\ExceptionsHttpStatusCodeMapping;

use function Lambdish\Phunctional\each;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

abstract class BaseController extends AbstractController
{
    public function __construct(
        private readonly ExceptionsHttpStatusCodeMapping $exceptionMapping,
        private readonly SerializerInterface $serializer,
    ) {
        each(
            fn (int $httpCode, string $exceptionClass) => $this->exceptionMapping->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;

    protected function deserialize(string $content, string $class): mixed
    {
        return $this->serializer->deserialize(
            $content,
            $class,
            'json',
            [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                    return $object->getName();
                },
            ]
        );
    }
}
