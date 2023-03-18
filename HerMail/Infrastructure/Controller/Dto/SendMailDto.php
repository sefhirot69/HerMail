<?php

declare(strict_types=1);

namespace HerMail\Infrastructure\Controller\Dto;

use HerMail\Application\Command\AttachmentCommand;
use HerMail\Application\Command\SendMailCommand;

use function Lambdish\Phunctional\map;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SendMailDto
{
    public function __construct(
        private readonly string $to,
        private readonly string $subject,
        private readonly string $body,
        /**
         * @var ?array<int, AttachmentDto>
         */
        public readonly ?array $attachments = null,
    ) {
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('to', new NotBlank());
        $metadata->addPropertyConstraint('to', new Email());
        $metadata->addPropertyConstraint('subject', new NotBlank());
        $metadata->addPropertyConstraint('body', new NotBlank());
        $metadata->addPropertyConstraint('attachments', new Valid());
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return ?array<int, AttachmentDto>
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    public function mapToSendMailCommand(string $idInfo): SendMailCommand
    {
        return SendMailCommand::create(
            $idInfo,
            $this->getTo(),
            $this->getSubject(),
            $this->getBody(),
            map(
                fn (AttachmentDto $attachmentDto) => AttachmentCommand::create(
                    $attachmentDto->getName(),
                    $attachmentDto->getContent()
                ),
                $this->getAttachments() ?? []
            )
        );
    }
}
