## Unicode Conversion

```
# single character
🐌

# character mid sentence
The 🦄 was EmojiOne's official mascot.

# character mid sentence with a comma
The 🦄, was EmojiOne's official mascot.

# character at start of sentence
🐌 mail.

# character at start of sentence with apostrophe
🐌's are cool!

# character at end of sentence
EmojiOne's official mascot was 🦄.

# character at end of sentence with alternate puncuation
EmojiOne's official mascot was 🦄!

# character at end of sentence with preceeding colon
EmojiOne's official mascot was: 🦄

# character inside of IMG tag
The <img class="joypixels" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/6.0/png/unicode/32/1f984.png" /> was EmojiOne's official mascot.

```


## Shortname Conversion

```
# single shortname
:snail:

# shortname mid sentence
The :unicorn: was EmojiOne's official mascot.

# shortname mid sentence with a comma
The :unicorn:, was EmojiOne's official mascot.

# shortname at start of sentence
:snail: mail.

# shortname at start of sentence with apostrophe
:snail:'s are cool!

# shortname at end of sentence
EmojiOne's official mascot was :unicorn:.

# shortname at end of sentence with alternate puncuation
EmojiOne's official mascot was :unicorn:!

# shortname at end of sentence with preceeding colon
EmojiOne's official mascot: :unicorn:

# shortname inside of IMG tag
The <img class="joypixels" alt=":unicorn:" title=":unicorn:" src="https://cdn.jsdelivr.net/joypixels/assets/6.0/unicode/png/32/1f984.png" /> is EmojiOne's official mascot.

```

## ASCII Conversion

```html
# single smiley
:D

# single smiley with incorrect case (shouldn't convert)
:d

# multiple smileys
;) :p :*

# smiley to start a sentence
:\ is our confused smiley.

# smiley to end a sentence
Our smiley to represent joy is :')

# smiley to end a sentence with punctuation
The reverse of the joy smiley is the cry smiley :'(.

# smiley to end a sentence with preceeding punctuation
This is the "flushed" smiley: :$.

# smiley inside of an IMG tag  (shouldn't convert anything inside of the tag)
Smile <img class="joypixels" alt=":)" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/6.0/png/unicode/32/1f604.png" /> because it's going to be a good day.

# typical username password fail  (shouldn't convert the user:pass, but should convert the last :p)
Please log-in with user:pass as your credentials :P.

# shouldn't replace an ascii smiley in a URL (shouldn't replace :/)
Check out https://www.joypixels.com

```
