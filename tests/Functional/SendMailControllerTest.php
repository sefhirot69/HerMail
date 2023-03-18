<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Component\HttpFoundation\Response;

final class SendMailControllerTest extends AbstractBaseFunctional
{
    /** @test */
    public function itShouldSendMailSuccess(): void
    {
        // GIVEN

        $request = [
            'to'          => 'jane.doe@example.com',
            'subject'     => '¡Hola Jane!',
            'body'        => "¡Hola Jane!\n\nEspero que estés teniendo un buen día.\n\nSaludos cordiales,\nJohn",
            'attachments' => [
                [
                    'name'    => 'filename.csv',
                    'content' => base64_encode(file_get_contents('tests/Common/file.csv')),
                ],
            ],
        ];

        // WHEN

        $this->client->request(
            'POST',
            '/send',
            [],
            [],
            ['Content-Type' => 'application/json'],
            json_encode($request, JSON_THROW_ON_ERROR)
        );

        // THEN

        self::assertResponseIsSuccessful();
    }

    /** @test */
    public function itShouldSendMailBadRequest(): void
    {
        // GIVEN

        $request = [
            'to'          => 'janeexample.com',
            'subject'     => '',
            'body'        => '',
            'attachments' => [
                [
                    'name'    => '',
                    'content' => '',
                ],
            ],
        ];

        // WHEN

        $this->client->request(
            'POST',
            '/send',
            [],
            [],
            ['Content-Type' => 'application/json'],
            json_encode($request, JSON_THROW_ON_ERROR)
        );

        // THEN

        self::assertSame(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }
}
