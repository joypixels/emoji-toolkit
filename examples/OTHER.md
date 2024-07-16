# JoyPixels

## **Additional Implementation Examples**

The following code snippets demonstrate common usages of JoyPixels within your project.

----------

## Alternate Alt Tags

By default, both the Javascript and PHP toolkits we've provided will use the native unicode character as the alt tag for converted <IMG> tags. Doing this makes it so that if you copy and paste the converted text, in most cases, it will copy the native unicode emoji instead of the image. You can optionally turn this off by setting **unicodeAlt** to **false**. If set to false, the toolkits will use the :shortname: as the alternate text instead.

**HTML Output (default)**
```html
<p id="example-png">
	PNG: Hello world! <img class="joypixels" alt="😄" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/9.0/png/unicode/32/1f604.png">
</p>
```

**Javascript For Shortname Alt**
```javascript
$(document).ready(function() {
	// turn unicode alternate text off
	joypixels.unicodeAlt = false;
	
	var input = $('#example-png').html();
	var replaced = joypixels.toImage(input);
	$('#example-png').html(replaced);
});
```

**HTML Output For Shortname Alt**
```html
<p id="example-png">
	PNG: Hello world! <img class="joypixels" alt=":smile:" title=":smile:" src="https://cdn.jsdelivr.net/joypixels/assets/9.0/png/unicode/32/1f604.png">
</p>
```

----------

## Shortname AutoComplete

To get this working correctly you'll needed to include a few extra pieces, including:

**Required Extras**
 - <a href="https://jquery.com/" target="_blank">jQuery</a>
 - <a href="https://github.com/yuku-t/jquery-textcomplete" target="_blank">jquery-textcomplete</a>
 - Custom JS (shown below)
 - Custom CSS (shown below)
 
**Custom Javascript**
```javascript
// emoji strategy for .textcomplete() (latest version available in our repo: emoji_strategy.json)
var emojiStrategy = PASTE THE CONTENTS OF emoji_strategy.json HERE;

$(document).ready(function() {

    $("textarea").textcomplete([ {
        match: /\B:([\-+\w]*)$/,
        search: function (term, callback) {
            var results = [];
            var results2 = [];
            var results3 = [];
            $.each(emojiStrategy,function(unicode,data) {
                if(unicode.indexOf(term) > -1) { results.push(emojiStrategy[unicode].shortname); }
                else {
                    if((data.aliases !== null) && (data.aliases.indexOf(term) > -1)) {
                        results2.push(shortname);
                    }
                    else if((data.keywords !== null) && (data.keywords.indexOf(term) > -1)) {
                        results3.push(shortname);
                    }
                }
            });

            if(term.length >= 3) {
                results.sort(function(a,b) { return (a.length > b.length); });
                results2.sort(function(a,b) { return (a.length > b.length); });
                results3.sort();
            }
            var newResults = results.concat(results2).concat(results3);

            callback(newResults);
        },
        template: function (shortname) {
            return '<img class="joypixels" src="https://cdn.jsdelivr.net/joypixels/assets/9.0/png/unicode/32/'+unicode+'.png"/> :'+emojiStrategy[shortname].unicode+':';
        },
        replace: function (shortname) {
            return ':'+shortname+': ';
        },
        index: 1,
        maxCount: 10
    }
    ],{
        footer: ''
    });
});
 ```
 
 **Custom CSS**
 ```css
 /* AutoComplete styles for Emoji One */

.dropdown-menu {
  list-style: none;
  padding: .3em 0 0;
  margin: 0;
  border: 1px solid #6E6E6E;
  background-color: white;
  border-radius: 5px;
  overflow: hidden;
  font-size: inherit;
  letter-spacing: .025em;
  box-shadow: 3px 3px 3px rgba(0,0,0,.2);
}
.dropdown-menu a:hover {
  cursor: pointer;
}
.dropdown-menu li {
  letter-spacing: 0;
  display: block;
  float: none;
  margin: 0;
  padding: 0;
  border:none;
}
.dropdown-menu li:before {
  display: none;
}
.dropdown-menu .textcomplete-footer {
  margin-top: .3em;
  background: #e6e6e6;
}
.dropdown-menu .textcomplete-footer a {
  color: #999999;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: .05em;
  line-height: 2.1818em;
  padding-left: 1.8181em;
  font-size: .84em;
}
.dropdown-menu .textcomplete-footer .arrow {
  margin-left: .8em;
  font-size: 1.3em;
}
.dropdown-menu li .joypixels {
  vertical-align: middle;
  font-size: 1.23em;
  width: 1em;
  height: 1em;
  top: -1px;
  margin: 0 .3em 0 0;
}
.dropdown-menu li a {
  display: block;
  height: 100%;
  line-height: 1.8em;
  padding: 0 1.54em 0 .615em;
  color: #4f4f4f;
}
.dropdown-menu .active,
.dropdown-menu li:hover {
  background: #6E6E6E;
  color: white;
}
.dropdown-menu .active a,
.dropdown-menu li:hover a {
  color: inherit;
}
```
 
----------
 
## ASCII Smileys

It's turned off by default, but by flipping one simple switch you can enable ASCII smiley conversion.

>**Note:** Enabling ASCII smiley conversion may have unwanted results in your application. We've done our best to make sure that ASCII smileys are only converted when intended, but we cannot be sure. Everyone gets annoyed when regular phrases are automatically converted to smileys so please consider that before enabling this feature

**Javascript Snippet**
```javascript
joypixels.ascii = true; // (default: false)

// to enable ASCII conversion in the PHP toolkit you would do:
// JoyPixels::$ascii = true;

function convert() {
	var input = document.getElementById('inputText').value;
	var output = joypixels.shortnameToImage(input);
	document.getElementById('outputText').innerHTML = output;
}
```

----------

## Live Preview Box

Start typing shortnames (:smile:, :blush:, :heart:, etc.) or entering native emojis from a compatible device.

**Required Extras**
 - <a href="https://jquery.com/" target="_blank">jQuery</a>
 - Custom JS (shown below)
 
**jQuery Snippet**
```javascript
$(document).ready(function() {
	$("#inputText").on('keyup change input',function(e) {
	  var source = $('#inputText').val();
	  var preview = joypixels.toImage(source);
	  $('#outputText').html(preview);
	});
});
```

----------

## Conversion HTML Class

Using jQuery, this demo shows you how you can stick a class of **.convert-emoji** on any HTML element and automatically convert native unicode emoji and/or shortnames to images after page load.

**Required Extras**
To get this working correctly we need to include a few extras, including:
 - <a href="https://jquery.com/" target="_blank">jQuery</a>
 - Custom JS (shown below)
 
**jQuery Snippet**
```javascript
$(document).ready(function() {
	$(".convert-emoji").each(function() {
		var original = $(this).html();
		// use .shortnameToImage if only converting shortnames (for slightly better performance)
		var converted = joypixels.toImage(original);
		$(this).html(converted);
	});
});
```

**HTML Input**
```html
<p class"convert-emoji">
    Welcome to this JoyPixels :snail: demo! 😄
    I hope you like what we've put together here for you. :thumbsup: :smile:
</p>
```

**HTML Output**
```html
<p class="convert-emoji">
	Welcome to this JoyPixels <img class="joypixels" alt="🐌" title=":snail:" src="./assets/png/1f40c.png"> demo! <img class="joypixels" alt="😄" title=":smile:" src="./assets/png/1f604.png">
	I hope you like what we've put together here for you. <img class="joypixels" alt="👍" title=":thumbsup:" src="./assets/png/1f44d.png"> <img class="joypixels" alt="😄" title=":smile:" src="./assets/svg/1f604.png">
</p>
```

----------

## PNG Sprite

We've setup a collection of <a href="https://github.com/joypixels/emoji-assets/blob/master/sprites/">spritesheets</a> for people to use. These sprites are split by category (plus diversity) and come in 32px and 64px sizes.

**Some Considerations**
 - <a href="https://caniuse.com/css-zoom" target="_blank">zoom</a> or <a href="https://caniuse.com/transforms2d" target="_blank">transform: scale()</a> can be used for custom scaling. transform: scale() is more widely supported.
 - Depending on the number of emoji being used on a page, loading an entire spritesheet here could be overkill.
 
**1. Attach Sprite CSS Stylesheet:**

To get PNG sprites working you first need to link the Sprites stylesheet in your &lt;head&gt;. This file is available in our <a href="https://github.com/joypixels/emoji-assets/blob/master/sprites/joypixels-sprite-32.min.css">emoji-assets git repo under /sprites</a>. Make sure to include the accompanying **sprite png** files in the same directory, or update its path in the css file if you move it.

`<link rel="stylesheet" href="path/to/joypixels.sprites.css"/>`

**2. Enable PNG Sprite Mode**

Once the stylesheet is attached, it's just a matter of enabling PNG Sprites in your JoyPixels configuration:

**Javascript Snippet**
```javascript
joypixels.sprites = true;
```

**PHP Snippet**
```php
$client = new Client(new Ruleset());
$client->sprites = true;
```

If you're not using our conversion scripts, PNG sprites can be implemented using the following markup structure. In this example we're using the unicode symbol 1F433:

**HTML Markup**
```html
<span class="joypixels joypixels-32-nature _1f433">
  &#x1f433;
</span>
```