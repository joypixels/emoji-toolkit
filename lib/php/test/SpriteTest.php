<?php

namespace JoyPixels\Test;

use JoyPixels\JoyPixels;
use JoyPixels\Client;

class SpriteTest extends \PHPUnit_Framework_TestCase
{

    /**
     * prepare SpriteTest
     */
    protected function setUp()
    {
        $client = new Client;
        $client->sprites = true;
        $client->unicodeAlt = true;
        JoyPixels::setClient($client);
    }

    /**
     * prepare SpriteTest
     */
    protected function tearDown()
    {
        JoyPixels::setClient(new Client);
    }

    /**
     * test JoyPixels::toImage()
     *
     * @return void
     */
    public function testToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <span class="joypixels joypixels-32-people _1f604" title=":smile:">😄</span> <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals(JoyPixels::toImage($test), $expected);
    }

    /**
     * test JoyPixels::shortnameToImage()
     *
     * @return void
     */
    public function testShortnameToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <span class="joypixels joypixels-32-people _1f604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals(JoyPixels::shortnameToImage($test), $expected);
    }

    /**
     * test JoyPixels::unicodeToImage()
     *
     * @return void
     */
    public function testUnicodeToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <span class="joypixels joypixels-32-people _1f604" title=":smile:">😄</span> :smile:';

        $this->assertEquals(JoyPixels::unicodeToImage($test), $expected);
    }
}
