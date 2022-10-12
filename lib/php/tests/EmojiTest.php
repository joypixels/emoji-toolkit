<?php declare(strict_types=1);

namespace JoyPixels\Test;

use PHPUnit\Framework\TestCase;
use JoyPixels\Client;
use JoyPixels\Ruleset;

/**
 * Tests all emojis from emoji.json
 */
final class EmojiTest extends TestCase
{

    private $client;
    private $stop = false;
    private static $data;

    public function setUp(): void
    {
        $this->client = new Client(new Ruleset());
    }

    public static function setUpBeforeClass(): void
    {
        $file = __DIR__ . '/../../../emoji.json';

        $string = file_get_contents($file);

        $json = json_decode($string);

        $data = [];

        foreach ($json as $emoji) {
            $data[$emoji->shortname] = [
                $emoji->code_points->fully_qualified,
                $emoji->code_points->base
            ];

            foreach($emoji->shortname_alternates as $alternate) {
                $data[$alternate] = [
                    $emoji->code_points->fully_qualified,
                    $emoji->code_points->base
                ];
            }
        }

        self::$data = $data;
    }

    /**
     * test Ruleset data
     *
     * @return void
     */
    public function testRulesetData()
    {
        $shortcode_replace = $this->client->getRuleset()->getShortcodeReplace();
        $unicode_replace = $this->client->getRuleset()->getUnicodeReplace();

        $unicodes = [];

        foreach (self::$data as $shortname => $codePoints) {

            // Check that all emoji.json shortnames have
            //   an entry in the replace variables
            $this->assertTrue(isset($shortcode_replace[$shortname]));
            $this->assertTrue(isset($unicode_replace[$shortname]));

            // Check for a fully qualified codepoint value
            $this->assertEquals($codePoints[0], $shortcode_replace[$shortname][0], $shortname);
            // Check for a base codepoint value
            $this->assertEquals($codePoints[1], $shortcode_replace[$shortname][1], $shortname);

            $unicode = $this->client->shortnameToUnicode($shortname);

            $unicodes[] = $unicode;

            // Check that the unicode character is in the array
            $this->assertTrue(in_array($unicode, $unicode_replace), $unicode);

            // Check that the shortname has a corresponding unicode entry
            $this->assertEquals($unicode, $unicode_replace[$shortname], $shortname);

            $inRegEx = preg_match('/' . $this->client->unicodeRegexp . '/ui', $unicode);

            $this->assertEquals(1, $inRegEx, $shortname);

            $inRegEx = preg_match('/' . $this->client->ignoredRegexp . '|(' . $this->client->shortcodeRegexp . ')/Siu', $shortname);

            $this->assertEquals(1, $inRegEx, $shortname);
        }

        $tripleUnicodeCount = abs(count($unicodes) / 3);

        // Check that a group of three unicode characters
        //   can be matched through the unicode regex
        for ($x = 0; $x < $tripleUnicodeCount; $x++) {

            $str = $unicodes[$x] . $unicodes[$x + 1] . $unicodes[$x + 2];

            preg_match_all('/' . $this->client->unicodeRegexp . '/ui', $str, $matches, PREG_UNMATCHED_AS_NULL);

            $this->assertEquals(3, count($matches[0]), $str);

        }
    }

    /**
     * test that all shortcodes return an image
     *
     * @return void
     */
    public function testToImage()
    {
        $file = __DIR__ . '/../../../joypixels.json';

        $string = file_get_contents($file);

        $json = json_decode($string);

        $emojiVersion = $json->version;

        foreach (self::$data as $shortname => $codePoints) {
            $convert_unicode = strtolower($this->client->convert($codePoints[0]));

            $image = '<img class="joypixels" alt="' . $convert_unicode . '" title="' . htmlspecialchars($shortname) . '" src="https://cdn.jsdelivr.net/joypixels/assets/' . $emojiVersion . '/png/unicode/32/' . $codePoints[1] . '.png"/>';

            $this->assertEquals($image, $this->client->toImage($shortname));
        }
    }
}
