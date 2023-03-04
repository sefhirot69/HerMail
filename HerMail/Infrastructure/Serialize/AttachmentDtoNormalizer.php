<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Serialize;

use App\Controller\Dto\AttachmentDto;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class AttachmentDtoNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'name'    => $object->name,
            'content' => $object->content,
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof AttachmentDto;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return new AttachmentDto(
            $data['name'],
            $data['content']
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return AttachmentDto::class === $type && is_array($data);
    }
}
