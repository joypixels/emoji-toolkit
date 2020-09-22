import {asciiList} from './asciiList';
import {emojiList} from './emojiList';

const asciiRegexp =
  "(\\*\\\\0\\/\\*|\\*\\\\O\\/\\*|\\-___\\-|\\:'\\-\\)|'\\:\\-\\)|'\\:\\-D|\\>\\:\\-\\)|>\\:\\-\\)|'\\:\\-\\(|\\>\\:\\-\\(|>\\:\\-\\(|\\:'\\-\\(|O\\:\\-\\)|0\\:\\-3|0\\:\\-\\)|0;\\^\\)|O;\\-\\)|0;\\-\\)|O\\:\\-3|\\-__\\-|\\:\\-Þ|\\:\\-Þ|\\<\\/3|<\\/3|\\:'\\)|\\:\\-D|'\\:\\)|'\\=\\)|'\\:D|'\\=D|\\>\\:\\)|>\\:\\)|\\>;\\)|>;\\)|\\>\\=\\)|>\\=\\)|;\\-\\)|\\*\\-\\)|;\\-\\]|;\\^\\)|'\\:\\(|'\\=\\(|\\:\\-\\*|\\:\\^\\*|\\>\\:P|>\\:P|X\\-P|\\>\\:\\[|>\\:\\[|\\:\\-\\(|\\:\\-\\[|\\>\\:\\(|>\\:\\(|\\:'\\(|;\\-\\(|\\>\\.\\<|>\\.<|#\\-\\)|%\\-\\)|X\\-\\)|\\\\0\\/|\\\\O\\/|0\\:3|0\\:\\)|O\\:\\)|O\\=\\)|O\\:3|B\\-\\)|8\\-\\)|B\\-D|8\\-D|\\-_\\-|\\>\\:\\\\|>\\:\\\\|\\>\\:\\/|>\\:\\/|\\:\\-\\/|\\:\\-\\.|\\:\\-P|\\:Þ|\\:Þ|\\:\\-b|\\:\\-O|O_O|\\>\\:O|>\\:O|\\:\\-X|\\:\\-#|\\:\\-\\)|\\(y\\)|\\<3|<3|\\=D|;\\)|\\*\\)|;\\]|;D|\\:\\*|\\=\\*|\\:\\(|\\:\\[|\\=\\(|\\:@|;\\(|D\\:|\\:\\$|\\=\\$|#\\)|%\\)|X\\)|B\\)|8\\)|\\:\\/|\\:\\\\|\\=\\/|\\=\\\\|\\:L|\\=L|\\:P|\\=P|\\:b|\\:O|\\:X|\\:#|\\=X|\\=#|\\:\\)|\\=\\]|\\=\\)|\\:\\]|\\:D)";
const ascii = false; // change to true to convert ascii smileys
const riskyMatchAscii = false; // set true to match ascii without leading/trailing space char
const regAscii = new RegExp(
  '<object[^>]*>.*?</object>|<span[^>]*>.*?</span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|((\\s|^)' +
    asciiRegexp +
    '(?=\\s|$|[!,.?]))',
  'gi',
);
const regAsciiRisky = new RegExp(
  '<object[^>]*>.*?</object>|<span[^>]*>.*?</span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|(()' +
    asciiRegexp +
    '())',
  'gi',
);

// for converting unicode code points and code pairs to their respective characters
function convert(unicode) {
  if (unicode.indexOf('-') > -1) {
    var parts = [];
    var s = unicode.split('-');
    for (var i = 0; i < s.length; i++) {
      var part: string | number = parseInt(s[i], 16);
      if (part >= 0x10000 && part <= 0x10ffff) {
        var hi = Math.floor((part - 0x10000) / 0x400) + 0xd800;
        var lo = ((part - 0x10000) % 0x400) + 0xdc00;
        part = String.fromCharCode(hi) + String.fromCharCode(lo);
      } else {
        part = String.fromCharCode(part);
      }
      parts.push(part);
    }
    return parts.join('');
  } else {
    var s: any = parseInt(unicode, 16);
    if (s >= 0x10000 && s <= 0x10ffff) {
      var hi = Math.floor((s - 0x10000) / 0x400) + 0xd800;
      var lo = ((s - 0x10000) % 0x400) + 0xdc00;
      return String.fromCharCode(hi) + String.fromCharCode(lo);
    } else {
      return String.fromCharCode(s);
    }
  }
}

const shortnameLookup = [];
const altShortNames = [];
var tmpShortNames = [],
  emoji;
for (emoji in emojiList) {
  if (emojiList.hasOwnProperty(emoji) || emoji === '') {
    tmpShortNames.push(emoji.replace(/[+]/g, '\\$&'));
    var cp = convert(emojiList[emoji].uc_full),
      i = 0;
    shortnameLookup[cp] = emoji.replace(/[+]/g, '\\$&');

    for (i = 0; i < emojiList[emoji].shortnames.length; i++) {
      tmpShortNames.push(emojiList[emoji].shortnames[i].replace(/[+]/g, '\\$&'));
      altShortNames[emojiList[emoji].shortnames[i]] = emoji;
    }
  }
}

const shortnames = tmpShortNames.join('|');
const regShortNames = new RegExp(
  '<object[^>]*>.*?</object>|<span[^>]*>.*?</span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|(' + shortnames + ')',
  'gi',
);

// will output unicode from shortname
// useful for sending emojis back to mobile devices
export function shortnameToUnicode(str) {
  // replace regular shortnames first
  var unicode, fname;
  str = str.replace(regShortNames, function (shortname) {
    if (typeof shortname === 'undefined' || shortname === '') {
      // if the shortname is empty, return the entire match
      return shortname;
    }
    if (!(shortname in emojiList)) {
      // if the shortname does not exist as primary, check alternates
      if (!(shortname in altShortNames)) {
        // if the shortname doesnt exist, return the entire match
        return shortname;
      }
      //set shortname as parent
      shortname = altShortNames[shortname];
    }
    unicode = emojiList[shortname].uc_full.toUpperCase();
    fname = emojiList[shortname].uc_base;
    return convert(unicode);
  });

  // if ascii smileys are turned on, then we'll replace them!
  if (ascii) {
    var asciiRX = riskyMatchAscii ? regAsciiRisky : regAscii;

    str = str.replace(asciiRX, function (entire, m1, m2, m3) {
      if (typeof m3 === 'undefined' || m3 === '' || !(unescapeHTML(m3) in asciiList)) {
        // if the ascii doesnt exist just return the entire match
        return entire;
      }

      m3 = unescapeHTML(m3);
      unicode = asciiList[m3].toUpperCase();
      return m2 + convert(unicode);
    });
  }

  return str;
}

function unescapeHTML(string) {
  var unescaped = {
    '&amp;': '&',
    '&#38;': '&',
    '&#x26;': '&',
    '&lt;': '<',
    '&#60;': '<',
    '&#x3C;': '<',
    '&gt;': '>',
    '&#62;': '>',
    '&#x3E;': '>',
    '&quot;': '"',
    '&#34;': '"',
    '&#x22;': '"',
    '&apos;': "'",
    '&#39;': "'",
    '&#x27;': "'",
  };

  return string.replace(/&(?:amp|#38|#x26|lt|#60|#x3C|gt|#62|#x3E|apos|#39|#x27|quot|#34|#x22);/gi, function (match) {
    return unescaped[match];
  });
}

export function convertToUnicode(string) {
  // If we do not find the special `＃` symbol, then we assume that there is no
  // need to make any conversion. Return the string as is.
  if (string.indexOf('＃') == -1) {
    return string;
  }
  // Remove the pound if it exists.
  string = string.replace(/＃/g, '');
  return string.replace(/\\u(\w\w\w\w)/g, (a, b: string) => {
    const charcode = parseInt(b, 16);
    return String.fromCharCode(charcode);
  });
}
