<?php

namespace App\Tests\Unit\Application\Command;

use HerMail\Application\Command\SendMailCommandHandler;
use HerMail\Domain\Mail\MailerInterface;
use HerMail\Domain\Mail\MailParameter;
use HerMail\Domain\MailInfo\EmailStatus;
use HerMail\Domain\MailInfo\InfoMail;
use HerMail\Domain\MailInfo\InfoMailRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SendMailCommandHandlerTest extends TestCase
{
    private MailerInterface|MockObject $mailer;
    private MockObject|InfoMailRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->mailer     = $this->createMock(MailerInterface::class);
        $this->repository = $this->createMock(InfoMailRepositoryInterface::class);
    }

    /** @test */
    public function itShouldSendMail(): void
    {
        // GIVEN
        $command = SendMailCommandMother::random();

        // WHEN

        $this->repository
            ->expects(self::once())
            ->method('save')
            ->with(
                self::callback(static function (InfoMail $infoMail): bool {
                    self::assertNotNull($infoMail->getDate()->getCreatedAt());
                    self::assertNotNull($infoMail->getId());
                    self::assertEquals(EmailStatus::NOT_SENT, $infoMail->getStatus());

                    return true;
                })
            );

        $this->mailer
            ->expects(self::once())
            ->method('send')
            ->with(
                self::callback(static function (MailParameter $parameter) use ($command): bool {
                self::assertEquals($command->getTo(), (string) $parameter->getRecipient());
                self::assertEquals($command->getSubject(), (string) $parameter->getSubject());
                self::assertEquals($command->getBody(), (string) $parameter->getBody());

                return true;
            })
            );

        $commandHandler = new SendMailCommandHandler($this->repository, $this->mailer);

        // THEN
        ($commandHandler)($command);
    }
}
