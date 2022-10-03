<?php declare(strict_types=1);

namespace JoyPixels\Test;

use PHPUnit\Framework\TestCase;
use JoyPixels\Client;
use JoyPixels\Ruleset;

final class SpriteTest extends TestCase
{

    private $emojiVersion;
    private $client;

    public function setUp(): void
    {
        $this->client = new Client(new Ruleset());
        $this->client->sprites = true;

        $file = __DIR__ . '/../../../joypixels.json';

        $string = file_get_contents($file);

        $json = json_decode($string);

        $this->emojiVersion = $json->version;
    }

    /**
     * test $this->client->toImage()
     *
     * @return void
     */
    public function testToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span> <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals($expected, $this->client->toImage($test));
    }

    /**
     * test $this->client->shortnameToImage()
     *
     * @return void
     */
    public function testShortnameToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals($expected, $this->client->shortnameToImage($test));
    }
}
