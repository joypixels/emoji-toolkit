<?php

/*
Tests based on lib/tests.md
*/

namespace JoyPixels\Test;

use JoyPixels\JoyPixels;

class ConversionTest extends \PHPUnit_Framework_TestCase
{

    private $emojiVersion = '6.0';

    /**
     * test single unicode character
     *
     * @return void
     */
    public function testSingleUnicodeCharacter()
    {
        $unicode   = '🐌';
        $shortname = ':snail:';
        $image     = '<img class="joypixels" alt="🐌" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>';
        $image_fix = '<img class="joypixels" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * test shortname mid sentence
     *
     * @return void
     */
    public function testShortnameInsideSentence()
    {
        $unicode   = 'The 🦄 was EmojiOne\'s official mascot.';
        $shortname = 'The :unicorn: was EmojiOne\'s official mascot.';
        $image     = 'The <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/> was EmojiOne\'s official mascot.';
        $image_fix = 'The <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/> was EmojiOne\'s official mascot.';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * test shortname mid sentence with a comma
     *
     * @return void
     */
    public function testShortnameInsideSentenceWithComma()
    {
        $unicode   = 'The 🦄, was EmojiOne\'s official mascot.';
        $shortname = 'The :unicorn:, was EmojiOne\'s official mascot.';
        $image     = 'The <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>, was EmojiOne\'s official mascot.';
        $image_fix = 'The <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>, was EmojiOne\'s official mascot.';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at start of sentence
     *
     * @return void
     */
    public function testShortnameAtStartOfSentence()
    {
        $unicode   = '🐌 mail.';
        $shortname = ':snail: mail.';
        $image     = '<img class="joypixels" alt="🐌" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/> mail.';
        $image_fix = '<img class="joypixels" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/> mail.';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at start of sentence with apostrophe
     *
     * @return void
     */
    public function testShortnameAtStartOfSentenceWithApostrophe()
    {
        $unicode   = '🐌\'s are cool!';
        $shortname = ':snail:\'s are cool!';
        $image     = '<img class="joypixels" alt="🐌" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>\'s are cool!';
        $image_fix = '<img class="joypixels" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>\'s are cool!';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at end of sentence
     *
     * @return void
     */
    public function testShortnameAtEndOfSentence()
    {
        $unicode   = 'EmojiOne\'s official mascot was 🦄.';
        $shortname = 'EmojiOne\'s official mascot was :unicorn:.';
        $image     = 'EmojiOne\'s official mascot was <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>.';
        $image_fix = 'EmojiOne\'s official mascot was <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>.';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at end of sentence with alternate punctuation
     *
     * @return void
     */
    public function testShortnameAtEndOfSentenceWithAlternatePunctuation()
    {
        $unicode   = 'EmojiOne\'s official mascot was 🦄!';
        $shortname = 'EmojiOne\'s official mascot was :unicorn:!';
        $image     = 'EmojiOne\'s official mascot was <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>!';
        $image_fix = 'EmojiOne\'s official mascot was <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>!';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at end of sentence with preceeding colon
     *
     * @return void
     */
    public function testShortnameAtEndOfSentenceWithPreceedingColon()
    {
        $unicode   = 'EmojiOne\'s official mascot was: 🦄';
        $shortname = 'EmojiOne\'s official mascot was: :unicorn:';
        $image     = 'EmojiOne\'s official mascot was: <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>';
        $image_fix = 'EmojiOne\'s official mascot was: <img class="joypixels" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>';

        $this->assertEquals(JoyPixels::toShort($unicode), $shortname);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($unicode), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image_fix);
    }

    /**
     * shortname inside of IMG tag
     *
     * @return void
     */
    public function testShortnameInsideOfImgTag()
    {
        $unicode   = 'The <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png" /> was EmojiOne\'s official mascot.';
        $shortname = 'The <img class="joypixels" alt=":unicorn:" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f984.png" /> was EmojiOne\'s official mascot.';

        $this->assertEquals(JoyPixels::toShort($unicode), $unicode);
        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $shortname);
        $this->assertEquals(JoyPixels::shortnameToUnicode($shortname), $shortname);
        $this->assertEquals(JoyPixels::unicodeToImage($unicode), $unicode);
        $this->assertEquals(JoyPixels::toImage($unicode), $unicode);
        $this->assertEquals(JoyPixels::toImage($shortname), $shortname);
    }

    /**
     * test single ascii character
     *
     * @return void
     */
    public function testSingleSmiley()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii       = ':-)';
        $unicode     = '🙂';
        $unicode_fix = '&#x1f642;';
        $shortname   = ':slight_smile:';
        $image       = '<img class="joypixels" alt="&#x1f642;" title=":slight_smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f642.png"/>';

        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image);
        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image);
        $this->assertEquals(JoyPixels::toImage($ascii), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($shortname), ':]');
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test single smiley with incorrect case (shouldn't convert)
     *
     * @return void
     */
    public function testSingleSmileyWithIncorrectCase()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii = ':d';

        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $ascii);
        $this->assertEquals(JoyPixels::toImage($ascii), $ascii);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $ascii);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test multiple smileys
     *
     * @return void
     */
    public function testMultipleSmilies()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii       = ';) :p :*';
        $ascii_fix   = ';^) d: :^*';
        $unicode     = '😉 😛 😘';
        $unicode_fix = '&#x1f609; &#x1f61b; &#x1f618;';
        $shortname   = ':wink: :stuck_out_tongue: :kissing_heart:';
        $image       = '<img class="joypixels" alt="&#x1f609;" title=":wink:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f609.png"/> <img class="joypixels" alt="&#x1f61b;" title=":stuck_out_tongue:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f61b.png"/> <img class="joypixels" alt="&#x1f618;" title=":kissing_heart:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f618.png"/>';

        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image);
        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image);
        $this->assertEquals(JoyPixels::toImage($ascii), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test smiley to start a sentence
     *
     * @return void
     */
    public function testSmileyAtSentenceStart()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii       = ':\\ is our confused smiley.';
        $ascii_fix   = '=L is our confused smiley.';
        $unicode     = '😕 is our confused smiley.';
        $unicode_fix = '&#x1f615; is our confused smiley.';
        $shortname   = ':confused: is our confused smiley.';
        $image       = '<img class="joypixels" alt="&#x1f615;" title=":confused:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f615.png"/> is our confused smiley.';

        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image);
        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image);
        $this->assertEquals(JoyPixels::toImage($ascii), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test smiley to end a sentence
     *
     * @return void
     */
    public function testSmileyAtSentenceEnd()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii       = 'Our smiley to represent joy is :\')';
        $ascii_fix   = 'Our smiley to represent joy is :\'-)';
        $unicode     = 'Our smiley to represent joy is 😂';
        $unicode_fix = 'Our smiley to represent joy is &#x1f602;';
        $shortname   = 'Our smiley to represent joy is :joy:';
        $image       = 'Our smiley to represent joy is <img class="joypixels" alt="&#x1f602;" title=":joy:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f602.png"/>';

        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image);
        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image);
        $this->assertEquals(JoyPixels::toImage($ascii), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test smiley to end a sentence with puncuation
     *
     * @return void
     */
    public function testSmileyAtSentenceEndWithPunctuation()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii       = 'The reverse is the joy smiley is the cry smiley :\'(.';
        $ascii_fix   = 'The reverse is the joy smiley is the cry smiley ;-(.';
        $unicode     = 'The reverse is the joy smiley is the cry smiley 😢.';
        $unicode_fix = 'The reverse is the joy smiley is the cry smiley &#x1f622;.';
        $shortname   = 'The reverse is the joy smiley is the cry smiley :cry:.';
        $image       = 'The reverse is the joy smiley is the cry smiley <img class="joypixels" alt="&#x1f622;" title=":cry:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f622.png"/>.';

        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image);
        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image);
        $this->assertEquals(JoyPixels::toImage($ascii), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test smiley to end a sentence with preceeding puncuration
     *
     * @return void
     */
    public function testSmileyAtSentenceEndWithPreceedingPunctuation()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii       = 'This is the "flushed" smiley: :$.';
        $ascii_fix   = 'This is the "flushed" smiley: =$.';
        $unicode     = 'This is the "flushed" smiley: 😳.';
        $unicode_fix = 'This is the "flushed" smiley: &#x1f633;.';
        $shortname   = 'This is the "flushed" smiley: :flushed:.';
        $image       = 'This is the "flushed" smiley: <img class="joypixels" alt="&#x1f633;" title=":flushed:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f633.png"/>.';

        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image);
        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image);
        $this->assertEquals(JoyPixels::toImage($ascii), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test smiley inside of an IMG tag  (shouldn't convert anything inside of the tag)
     *
     * @return void
     */
    public function testSmileyInsideAnImgTag()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $image = 'Smile <img class="joypixels" alt=":)" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f642.png" /> because it\'s going to be a good day.';

        $this->assertEquals(JoyPixels::shortnameToImage($image), $image);
        $this->assertEquals(JoyPixels::toImage($image), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($image), $image);
        $this->assertEquals(JoyPixels::unifyUnicode($image), $image);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test typical username password fail  (shouldn't convert the user:pass, but should convert the last :p)
     *
     * @return void
     */
    public function testTypicalUsernamePasswordFail()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii       = 'Please log-in with user:pass as your credentials :P.';
        $ascii_fix   = 'Please log-in with user:pass as your credentials d:.';
        $unicode     = 'Please log-in with user:pass as your credentials 😛.';
        $unicode_fix = 'Please log-in with user:pass as your credentials &#x1f61b;.';
        $shortname   = 'Please log-in with user:pass as your credentials :stuck_out_tongue:.';
        $image       = 'Please log-in with user:pass as your credentials <img class="joypixels" alt="&#x1f61b;" title=":stuck_out_tongue:" src="https://cdn.jsdelivr.net/joypixels/assets/' . $this->emojiVersion . '/png/32/1f61b.png"/>.';

        $this->assertEquals(JoyPixels::shortnameToImage($shortname), $image);
        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $image);
        $this->assertEquals(JoyPixels::toImage($shortname), $image);
        $this->assertEquals(JoyPixels::toImage($ascii), $image);
        $this->assertEquals(JoyPixels::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(JoyPixels::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }

    /**
     * test shouldn't replace an ascii smiley in a URL (shouldn't replace :/)
     *
     * @return void
     */
    public function testSmileyInAnUrl()
    {
        // enable ASCII conversion
        $default_ascii = JoyPixels::$ascii;
        JoyPixels::$ascii = true;

        $ascii = 'Check out http://www.joypixels.com';

        $this->assertEquals(JoyPixels::shortnameToImage($ascii), $ascii);
        $this->assertEquals(JoyPixels::toImage($ascii), $ascii);
        $this->assertEquals(JoyPixels::shortnameToAscii($ascii), $ascii);
        $this->assertEquals(JoyPixels::unifyUnicode($ascii), $ascii);

        // back to default ASCII conversion
        JoyPixels::$ascii = $default_ascii;
    }
}
