<?php

namespace JoyPixels\Test;

use JoyPixels\JoyPixels;

class JoyPixelsTest extends \PHPUnit_Framework_TestCase
{

    private $emojiVersion = '6.0';

    public function emojiProvider()
    {
        $file = dirname (__FILE__).'/../../../emoji.json';

        $string = file_get_contents($file);

        $json = json_decode($string, true);

        $data = array();

        foreach($json as $emoji)
        {
            if(isset($emoji['aliases_ascii']) && is_array($emoji['aliases_ascii'])){
                foreach($emoji['aliases_ascii'] as $ascii)
                $data[] = array(
                    $ascii,
                    $emoji['shortname']
                );
            }
        }
        return $data;
    }

    /**
     * test JoyPixels::toImage()
     *
     * @return void
     */
    public function testToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <img class="joypixels" alt="😄" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f604.png"/> <img class="joypixels" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f604.png"/>';

        $this->assertEquals(JoyPixels::toImage($test), $expected);
    }

    /**
     * test JoyPixels::unifyUnicode()
     *
     * @return void
     */
    public function testUnifyUnicode()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals(JoyPixels::unifyUnicode($test), $expected);
    }

    /**
     * test JoyPixels::shortnameToUnicode()
     *
     * @return void
     */
    public function testShortnameToUnicode()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals(JoyPixels::shortnameToUnicode($test), $expected);
    }


    /**
     * test JoyPixels::shortnameToAscii()
     *
     * @return void
     */
    public function testShortnameToAscii()
    {
        $test     = 'Hello world! 🙂 :slight_smile:';
        $expected = 'Hello world! 🙂 :]';

        $this->assertEquals(JoyPixels::shortnameToAscii($test), $expected);
    }

    /**
     * test JoyPixels::shortnameToImage()
     *
     * @return void
     */
    public function testShortnameToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <img class="joypixels" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f604.png"/>';

        $this->assertEquals(JoyPixels::shortnameToImage($test), $expected);
    }

    /**
     * test JoyPixels::toShort()
     *
     * @return void
     */
    public function testToShort()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! :smile: :smile:';

        $this->assertEquals(JoyPixels::toShort($test), $expected);
    }
    /**
     *
     * test JoyPixels::asciiToShortname()
     *
     * @return void
     */
    public function testAsciiToShortname()
    {
        $test     = 'Hello world! :) :D ;) :smile:';
        $expected = 'Hello world! :slight_smile: :smiley: :wink: :smile:';

        $this->assertEquals(JoyPixels::asciiToShortname($test), $expected);
    }

    /**
     * Test Ascii to shortnames with dataProvider
     *
     * @dataProvider emojiProvider
     */
    public function testAsciiToShortnameWithDataProvider($ascii, $shortname)
    {
        $this->assertEquals($shortname, JoyPixels::asciiToShortname($ascii));
    }

    /**
     * test JoyPixels::unicodeToImage()
     *
     * @return void
     */
    public function testUnicodeToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <img class="joypixels" alt="😄" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f604.png"/> :smile:';

        $this->assertEquals(JoyPixels::unicodeToImage($test), $expected);
    }
}
