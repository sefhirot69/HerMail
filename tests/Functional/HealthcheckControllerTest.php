<?php

namespace App\Tests\Functional;

class HealthcheckControllerTest extends AbstractBaseFunctional
{
    /** @test */
    public function itShouldReturnAnOk(): void
    {
        // GIVEN

        // WHEN

        $this->client
            ->request(
                'GET',
                'healthcheck',
            );

        $response = $this->client->getResponse();

        // THEN

        self::assertResponseIsSuccessful();
        self::assertEquals('OK', json_decode($response->getContent(), true)['status']);
    }
}
