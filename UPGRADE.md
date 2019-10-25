# Migrating from joypixels/emojione to joypixels/emoji-toolkit

* EmojiOne has officially rebranded to JoyPixels
* The joypixels/emojione repository will no longer be updated and will eventually be deprecated
* See what's changed below


## What's Changed?
**Libraries**
- This repository retains all PHP and JS library functionality, with renamed classes, attributes, and variables
    - PHP namespace/classes changed from `Emojione` to `JoyPixels`
    - JS library name has changed `joypixels.js` (`joypixels.min.js`)
    - CSS filename has changed to `joypixels.css` (`joypixels.min.css`)
    - emojione-awesome is now joypixels-awesome
        - implementation class names have changed from `e1a-` to `jpa-` (e.g. `e1a-sm e1a-grinning` is now `jpa-sm jpa-grinning`)
- The joypixels/emoji-toolkit repository deprecates existing libraries:
    - ios
    - android
    - swift
- These libraries have been replaced by standalone projects:
    - ios [https://www.github.com/joypixels/emoji-toolkit-ios](https://www.github.com/joypixels/emoji-toolkit-ios)
    - android [https://www.github.com/joypixels/emoji-toolkit-android](https://www.github.com/joypixels/emoji-toolkit-android)
    
 
**Emoji Assets**
    - the new asset repository is located at [https://www.github.com/joypixels/emoji-assets](https://www.github.com/joypixels/emoji-assets)
    - sprite filenames have changed from `emojione-` to `joypixels-`
    - sprite css class names have changed from `emojione-` to `joypixels`
    
    

# Upgrading to 5.0 brings additional data structure changes
The emoji.json file for 5.0 has several key changes from previous versions.

* added `humanform` attribute (Integer, 0/1)
* added `diversity_base` attribute (Integer, 0/1)
* changed `diversity` attribute from String to Array (still default `NULL`) to allow for multiple diversity variants per emoji
* changed `diversities` attribute name to `diversity_children`
* changed `gender` attribute from String to Array (still default `NULL`) to allow for multiple gender variants per emoji
* changed `genders` attribute name to `gender_children`
* updated `code_points` object. `base` is (still) the code point stripped of VS16 and ZWJ and `fully_qualified` includes everything needed for full matching and output
  * removed `non_fully_qualified` code point attribute
  * removed `output` code point attribute (duplicate of `fully_qualified`)
  * added `diversity_parent` code point attribute
  * added `gender_parent` code point attribute
