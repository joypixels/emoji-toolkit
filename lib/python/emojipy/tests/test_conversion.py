# -*- coding: utf-8; -*-

from __future__ import unicode_literals
from unittest import TestCase
from emojipy import Emoji


class ConversionTests(TestCase):
    """
    Test possible conversions from different kinds of input with
    unicode or shortname at different places
    """
    def setUp(self):
        self.emoji = Emoji
        self.emoji.sprites = False

    def test_single_unicode_char(self):
        unicode = '🐌'
        shortcode = ':snail:'
        image = '<img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/>'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_inside_sentence(self):
        unicode = 'The 🐌 was EmojiOne\'s original mascot.'
        shortcode = 'The :snail: was EmojiOne\'s original mascot.'
        image     = 'The <img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/> was EmojiOne\'s original mascot.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_inside_sentence_with_comma(self):
        unicode = 'The 🐌, was EmojiOne\'s original mascot.'
        shortcode = 'The :snail:, was EmojiOne\'s original mascot.'
        image = 'The <img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/>, was EmojiOne\'s original mascot.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_start_of_sentence(self):
        unicode = '🐌 mail.'
        shortcode = ':snail: mail.'
        image = '<img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/> mail.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_start_of_sentence_with_apostrophe(self):
        unicode = '🐌\'s are cool!'
        shortcode = ':snail:\'s are cool!'
        image = '<img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/>\'s are cool!'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_end_of_sentence(self):
        unicode = 'EmojiOne\'s original mascot was 🐌.'
        shortcode = 'EmojiOne\'s original mascot was :snail:.'
        image = 'EmojiOne\'s original mascot was <img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/>.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_end_of_sentence_with_alternate_punctuation(self):
        unicode = 'EmojiOne\'s original mascot was 🐌!'
        shortcode = 'EmojiOne\'s original mascot was :snail:!'
        image = 'EmojiOne\'s original mascot was <img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/>!'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_end_of_sentence_with_preceeding_colon(self):
        unicode = 'EmojiOne\'s original mascot was: 🐌'
        shortcode = 'EmojiOne\'s original mascot was: :snail:'
        image = 'EmojiOne\'s original mascot was: <img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/>'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_inside_img_tag(self):
        unicode = 'The <img class="joypixels" alt="🐌" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f40c.png"/> was EmojiOne\'s original mascot.';
        self.assertEqual(Emoji.unicode_to_image(unicode), unicode)
        self.assertEqual(Emoji.shortcode_to_image(unicode), unicode)

    def test_ascii_char(self):
        ascii = ">:/"
        image = '<img class="joypixels" alt="😕" src="https://cdn.jsdelivr.net/joypixels/assets/4.5/png/64/1f615.png"/>'
        self.assertEqual(Emoji.ascii_to_image(ascii), image)
