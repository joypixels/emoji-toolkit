<?php declare(strict_types=1);

namespace JoyPixels\Test;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use JoyPixels\Client;
use JoyPixels\Ruleset;

final class JoyPixelsTest extends TestCase
{

    private $emojiVersion;
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client(new Ruleset());

        $file = __DIR__ . '/../../../joypixels.json';

        $string = file_get_contents($file);

        $json = json_decode($string);

        $this->emojiVersion = $json->version;
    }

    public static function emojiProvider(): array
    {
        $file = __DIR__ . '/../../../emoji.json';

        $string = file_get_contents($file);

        $json = json_decode($string, true);

        $data = [];

        foreach ($json as $emoji) {
            if (count($emoji['ascii']) > 0) {

                foreach($emoji['ascii'] as $ascii) {
                    $data[] = [
                        $ascii,
                        $emoji['shortname']
                    ];
                }
            }
        }

        return $data;
    }

    /**
     * test $this->client->toImage()
     *
     * @return void
     */
    public function testToImage(): void
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <img class="joypixels" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f604.png"/> <img class="joypixels" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f604.png"/>';

        $this->assertEquals($expected, $this->client->toImage($test));
    }

    /**
     * test $this->client->unifyUnicode()
     *
     * @return void
     */
    public function testUnifyUnicode(): void
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals($expected, $this->client->unifyUnicode($test));
    }

    /**
     * test $this->client->shortnameToUnicode()
     *
     * @return void
     */
    public function testShortnameToUnicode(): void
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals($expected, $this->client->shortnameToUnicode($test));
    }

    /**
     * entries can contain some :xxx: words which are not valid shortnames. They must not break anything
     *
     * @return void
     */
    public function testShortnameToUnicodeAcceptWrongShortname(): void
    {
        $test     = 'Hello :world:! 😄 :smile:';
        $expected = 'Hello :world:! 😄 😄';

        $this->assertEquals($expected, $this->client->shortnameToUnicode($test));
    }

    /**
     * test $this->client->shortnameToAscii()
     *
     * @return void
     */
    public function testShortnameToAscii(): void
    {
        $test     = 'Hello world! 🙂 :slight_smile:';
        $expected = 'Hello world! 🙂 :]';

        $this->assertEquals($expected, $this->client->shortnameToAscii($test));
    }

    /**
     * test $this->client->shortnameToImage()
     *
     * @return void
     */
    public function testShortnameToImage(): void
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <img class="joypixels" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/unicode/32/1f604.png"/>';

        $this->assertEquals($expected, $this->client->shortnameToImage($test));
    }

    /**
     * test $this->client->toShort()
     *
     * @return void
     */
    public function testToShort(): void
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! :smile: :smile:';

        $this->assertEquals($expected, $this->client->toShort($test));
    }
    /**
     *
     * test $this->client->asciiToShortname()
     *
     * @return void
     */
    public function testAsciiToShortname(): void
    {
        $test     = 'Hello world! :) :-D ;) :smile:';
        $expected = 'Hello world! :slight_smile: :smiley: :wink: :smile:';

        $this->assertEquals($expected, $this->client->asciiToShortname($test));
    }

    /**
     * Test Ascii to shortnames with DataProvider
     */
    #[DataProvider('emojiProvider')]
    public function testAsciiToShortnameWithDataProvider(string $ascii, string $shortname): void
    {
        $this->assertEquals($shortname, trim($this->client->asciiToShortname($ascii)));
    }
}
