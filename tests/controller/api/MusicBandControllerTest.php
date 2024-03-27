<?php
namespace AppBundle\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MusicBandControllerTest extends WebTestCase
{
    public function testGetMusicBands()
    {
        $response = static::createClient()->request('GET', '/music_bands', ['headers' => ['Accept' => 'application/json']]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('content-type', 'application/json');
    }
}