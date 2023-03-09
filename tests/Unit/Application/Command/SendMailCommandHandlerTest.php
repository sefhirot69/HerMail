<?php

namespace App\Tests\Unit\Application\Command;

use HerMail\Application\Command\SendMailCommandHandler;
use HerMail\Domain\Mail\MailerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SendMailCommandHandlerTest extends TestCase
{
    private MailerInterface|MockObject $mailer;

    protected function setUp(): void
    {
        $this->mailer = $this->createMock(MailerInterface::class);
    }

    /** @test */
    public function itShouldSendMail(): void
    {
        // GIVEN
        $command = SendMailCommandMother::random();

        // WHEN

        $this->mailer
            ->expects(self::once())
            ->method('send')
            ->with(
                $command->getTo(),
                $command->getSubject(),
                $command->getBody(),
                $command->getAttachments()
            );

        $commandHandler = new SendMailCommandHandler($this->mailer);

        // THEN
        ($commandHandler)($command);
    }
}
