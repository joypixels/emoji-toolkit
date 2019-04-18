#Migrating from joypixels/emojione to joypixels/emoji-toolkit

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
    - the new asset repository is located at [https://www.github.com/joypixels/emoji-assets](https://www.github.com/joypixels/emoj-assets)
    - sprite filenames have changed from `emojione-` to `joypixels-`
    - sprite css class names have changed from `emojione-` to `joypixels`