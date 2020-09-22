import {asciiList} from './asciiList';
import {emojiList} from './emojiList';

const ns: any = {};

const asciiRegexp =
  "(\\*\\\\0\\/\\*|\\*\\\\O\\/\\*|\\-___\\-|\\:'\\-\\)|'\\:\\-\\)|'\\:\\-D|\\>\\:\\-\\)|>\\:\\-\\)|'\\:\\-\\(|\\>\\:\\-\\(|>\\:\\-\\(|\\:'\\-\\(|O\\:\\-\\)|0\\:\\-3|0\\:\\-\\)|0;\\^\\)|O;\\-\\)|0;\\-\\)|O\\:\\-3|\\-__\\-|\\:\\-Þ|\\:\\-Þ|\\<\\/3|<\\/3|\\:'\\)|\\:\\-D|'\\:\\)|'\\=\\)|'\\:D|'\\=D|\\>\\:\\)|>\\:\\)|\\>;\\)|>;\\)|\\>\\=\\)|>\\=\\)|;\\-\\)|\\*\\-\\)|;\\-\\]|;\\^\\)|'\\:\\(|'\\=\\(|\\:\\-\\*|\\:\\^\\*|\\>\\:P|>\\:P|X\\-P|\\>\\:\\[|>\\:\\[|\\:\\-\\(|\\:\\-\\[|\\>\\:\\(|>\\:\\(|\\:'\\(|;\\-\\(|\\>\\.\\<|>\\.<|#\\-\\)|%\\-\\)|X\\-\\)|\\\\0\\/|\\\\O\\/|0\\:3|0\\:\\)|O\\:\\)|O\\=\\)|O\\:3|B\\-\\)|8\\-\\)|B\\-D|8\\-D|\\-_\\-|\\>\\:\\\\|>\\:\\\\|\\>\\:\\/|>\\:\\/|\\:\\-\\/|\\:\\-\\.|\\:\\-P|\\:Þ|\\:Þ|\\:\\-b|\\:\\-O|O_O|\\>\\:O|>\\:O|\\:\\-X|\\:\\-#|\\:\\-\\)|\\(y\\)|\\<3|<3|\\=D|;\\)|\\*\\)|;\\]|;D|\\:\\*|\\=\\*|\\:\\(|\\:\\[|\\=\\(|\\:@|;\\(|D\\:|\\:\\$|\\=\\$|#\\)|%\\)|X\\)|B\\)|8\\)|\\:\\/|\\:\\\\|\\=\\/|\\=\\\\|\\:L|\\=L|\\:P|\\=P|\\:b|\\:O|\\:X|\\:#|\\=X|\\=#|\\:\\)|\\=\\]|\\=\\)|\\:\\]|\\:D)";
const emojiVersion = '6.0';
const emojiSize = '32';
const blacklistChars = '';
const imagePathPNG = 'https://cdn.jsdelivr.net/joypixels/assets/' + emojiVersion + '/png/unicode/';
const defaultPathPNG = imagePathPNG;
const fileExtension = '.png';
const imageTitleTag = true; // set to false to remove title attribute from img tag
const sprites = false; // if this is true then sprite markup will be used
const spriteSize = '32'; // if this is true then sprite markup will be used
const unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
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

const regUnicode = new RegExp(
  '<object[^>]*>.*?</object>|<span[^>]*>.*?</span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|(?:[\u1F91D[\u1F3FB-\u1F3FF]\u200D\u1F9F1\u200D\u1F91D[\u1F3FB-\u1F3FF]])|(?:\uD83C\uDFF3)\uFE0F?\u200D?(?:\uD83C\uDF08)|(?:\uD83D\uDC41)\uFE0F?\u200D?(?:\uD83D\uDDE8)\uFE0F?|[#-9]\uFE0F?\u20E3|(?:(?:\uD83C\uDFF4)(?:\uDB40[\uDC60-\uDCFF]){1,6})|(?:\uD83C[\uDDE0-\uDDFF]){2}|(?:\uD83D[\uDC68\uDC69])\uFE0F?(?:\uD83C[\uDFFA-\uDFFF])?\u200D?(?:[\u2695\u2696\u2708]|\uD83C[\uDF3E-\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92])|(?:\uD83D[\uDC68\uDC69]|\uD83E[\uDDD0-\uDDDF])(?:\uD83C[\uDFFA-\uDFFF])?\u200D?[\u2640\u2642\u2695\u2696\u2708]?\uFE0F?|(?:(?:\u2764|\uD83D[\uDC66-\uDC69\uDC8B])[\u200D\uFE0F]{0,2}){1,3}(?:\u2764|\uD83D[\uDC66-\uDC69\uDC8B])|(?:(?:\u2764|\uD83D[\uDC66-\uDC69\uDC8B])\uFE0F?){2,4}|(?:\uD83D[\uDC68\uDC69\uDC6E\uDC71-\uDC87\uDD75\uDE45-\uDE4E]|\uD83E[\uDD26\uDD37]|\uD83C[\uDFC3-\uDFCC]|\uD83E[\uDD38-\uDD3E]|\uD83D[\uDEA3-\uDEB6]|\u26f9|\uD83D\uDC6F)\uFE0F?(?:\uD83C[\uDFFB-\uDFFF])?\u200D?[\u2640\u2642]?\uFE0F?|(?:[\u261D\u26F9\u270A-\u270D]|\uD83C[\uDF85-\uDFCC]|\uD83D[\uDC42-\uDCAA\uDD74-\uDD96\uDE45-\uDE4F\uDEA3-\uDECC]|\uD83E[\uDD18-\uDD3E])\uFE0F?(?:\uD83C[\uDFFB-\uDFFF])|(?:[\u2194-\u2199\u21a9-\u21aa]\uFE0F?|[\u0023\u002a]|[\u3030\u303d]\uFE0F?|(?:\ud83c[\udd70-\udd71]|\ud83c\udd8e|\ud83c[\udd91-\udd9a])\uFE0F?|\u24c2\uFE0F?|[\u3297\u3299]\uFE0F?|(?:\ud83c[\ude01-\ude02]|\ud83c\ude1a|\ud83c\ude2f|\ud83c[\ude32-\ude3a]|\ud83c[\ude50-\ude51])\uFE0F?|[\u203c\u2049]\uFE0F?|[\u25aa-\u25ab\u25b6\u25c0\u25fb-\u25fe]\uFE0F?|[\u00a9\u00ae]\uFE0F?|[\u2122\u2139]\uFE0F?|\ud83c\udc04\uFE0F?|[\u2b05-\u2b07\u2b1b-\u2b1c\u2b50\u2b55]\uFE0F?|[\u231a-\u231b\u2328\u23cf\u23e9-\u23f3\u23f8-\u23fa]\uFE0F?|\ud83c\udccf|[\u2934\u2935]\uFE0F?)|[\u2700-\u27bf]\uFE0F?|[\ud800-\udbff][\udc00-\udfff]\uFE0F?|[\u2600-\u26FF]\uFE0F?|[\u0030-\u0039]\uFE0F',
  'g',
);

// for converting unicode code points and code pairs to their respective characters
ns.convert = function (unicode) {
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
};

const shortnameLookup = [];
const altShortNames = [];
let unicodeCharRegexCached = null;
var tmpShortNames = [],
  emoji;
for (emoji in emojiList) {
  if (emojiList.hasOwnProperty(emoji) || emoji === '') {
    tmpShortNames.push(emoji.replace(/[+]/g, '\\$&'));
    var cp = ns.convert(emojiList[emoji].uc_full),
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

// Primes cache with unicode char regex to reduce lag at first runtime
export function init() {
  unicodeCharRegex();
}

export function toImage(str) {
  str = toShort(str);
  str = shortnameToImage(str);
  return str;
}

export function unicodeToImage(str) {
  return str;
}

// Uses toShort to transform all unicode into a standard shortname
// then transforms the shortname into unicode
// This is done for standardization when converting several unicode types
export function unifyUnicode(str) {
  str = toShort(str);
  str = shortnameToUnicode(str);
  return str;
}

// Replace shortnames (:wink:) with Ascii equivalents ( ;^) )
// Useful for systems that dont support unicode nor images
export function shortnameToAscii(str) {
  var unicode,
    // something to keep in mind here is that array flip will destroy
    // half of the ascii text "emojis" because the unicode numbers are duplicated
    // this is ok for what it's being used for
    unicodeToAscii = objectFlip(asciiList);

  str = str.replace(regShortNames, function (shortname) {
    if (typeof shortname === 'undefined' || shortname === '' || !(shortname in emojiList)) {
      // if the shortname doesnt exist just return the entire match
      return shortname;
    } else {
      unicode = emojiList[shortname].uc_full;
      if (typeof unicodeToAscii[unicode] !== 'undefined') {
        return unicodeToAscii[unicode];
      } else {
        return shortname;
      }
    }
  });
  return str;
}

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
    return ns.convert(unicode);
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
      return m2 + ns.convert(unicode);
    });
  }

  return str;
}

export function shortnameToImage(str) {
  // replace regular shortnames first
  var replaceWith, shortname, unicode, fname, alt, category, title, size, ePath;
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

    unicode = emojiList[shortname].uc_full;
    fname = emojiList[shortname].uc_base;
    category = fname.indexOf('-1f3f') >= 0 ? 'diversity' : emojiList[shortname].category;
    title = imageTitleTag ? 'title="' + shortname + '"' : '';
    size = spriteSize == '32' || spriteSize == '64' ? spriteSize : '32';
    //if the emoji path has been set, we'll use the provided path, otherwise we'll use the default path
    ePath = defaultPathPNG !== imagePathPNG ? imagePathPNG : defaultPathPNG + emojiSize + '/';

    // depending on the settings, we'll either add the native unicode as the alt tag, otherwise the shortname
    alt = unicodeAlt ? ns.convert(unicode.toUpperCase()) : shortname;

    if (sprites) {
      replaceWith =
        '<span class="joypixels joypixels-' +
        size +
        '-' +
        category +
        ' _' +
        fname +
        '" ' +
        title +
        '>' +
        alt +
        '</span>';
    } else {
      replaceWith =
        '<img class="joypixels" alt="' + alt + '" ' + title + ' src="' + ePath + fname + fileExtension + '"/>';
    }

    return replaceWith;
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
      unicode = asciiList[m3];

      var mappedUnicode = mapUnicodeToShort();
      shortname = mappedUnicode[unicode];
      category = unicode.indexOf('-1f3f') >= 0 ? 'diversity' : emojiList[shortname].category;
      title = imageTitleTag ? 'title="' + escapeHTML(m3) + '"' : '';
      size = spriteSize == '32' || spriteSize == '64' ? spriteSize : '32';
      //if the emoji path has been set, we'll use the provided path, otherwise we'll use the default path
      ePath = defaultPathPNG !== imagePathPNG ? imagePathPNG : defaultPathPNG + emojiSize + '/';

      // depending on the settings, we'll either add the native unicode as the alt tag, otherwise the shortname
      alt = unicodeAlt ? ns.convert(unicode.toUpperCase()) : escapeHTML(m3);
      unicode = unicode.replace('-fe0f', '');

      if (sprites) {
        replaceWith =
          m2 +
          '<span class="joypixels joypixels-' +
          size +
          '-' +
          category +
          ' _' +
          unicode +
          '"  ' +
          title +
          '>' +
          alt +
          '</span>';
      } else {
        replaceWith =
          m2 + '<img class="joypixels" alt="' + alt + '" ' + title + ' src="' + ePath + unicode + fileExtension + '"/>';
      }

      return replaceWith;
    });
  }

  return str;
}

// this is really just unicodeToShortname() but I opted for the shorthand name to match toImage()
export function toShort(str) {
  var find = unicodeCharRegex();
  str = replaceAll(str, find);
  return str;
}

export function escapeHTML(string) {
  var escaped = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;',
  };

  return string.replace(/[&<>"']/g, function (match) {
    return escaped[match];
  });
}

export function unescapeHTML(string) {
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

export function shortnameConversionMap() {
  var map = [],
    emoji;
  for (emoji in emojiList) {
    if (!emojiList.hasOwnProperty(emoji) || emoji === '') continue;
    map[ns.convert(emojiList[emoji].uc_full)] = emoji;
  }
  return map;
}

export function unicodeCharRegex() {
  if (!unicodeCharRegexCached) {
    var map = [];
    for (emoji in emojiList) {
      if (!emojiList.hasOwnProperty(emoji) || emoji === '') continue;
      map.push(ns.convert(emojiList[emoji].uc_full));
    }
    unicodeCharRegexCached = map.join('|');
  }

  return unicodeCharRegexCached;
}

export function mapEmojiList(addToMapStorage) {
  for (var shortname in emojiList) {
    if (!emojiList.hasOwnProperty(shortname)) {
      continue;
    }
    var unicode = emojiList[shortname].uc_full;
    addToMapStorage(unicode, shortname);
  }
}

export function mapUnicodeToShort() {
  if (!ns.memMapShortToUnicode) {
    ns.memMapShortToUnicode = {};
    mapEmojiList(function (unicode, shortname) {
      ns.memMapShortToUnicode[unicode] = shortname;
    });
  }
  return ns.memMapShortToUnicode;
}

export function memorizeReplacement() {
  if (!ns.unicodeReplacementRegEx || !ns.memMapShortToUnicodeCharacters) {
    var unicodeList = [];
    ns.memMapShortToUnicodeCharacters = {};
    mapEmojiList(function (unicode, shortname) {
      var emojiCharacter = ns.convert(unicode);
      ns.memMapShortToUnicodeCharacters[emojiCharacter] = shortname;
      unicodeList.push(emojiCharacter);
    });
    ns.unicodeReplacementRegEx = unicodeList.join('|');
  }
}

export function mapUnicodeCharactersToShort() {
  memorizeReplacement();
  return ns.memMapShortToUnicodeCharacters;
}

//reverse an object
export function objectFlip(obj) {
  var key,
    tmp_obj = {};

  for (key in obj) {
    if (obj.hasOwnProperty(key)) {
      tmp_obj[obj[key]] = key;
    }
  }

  return tmp_obj;
}

export function escapeRegExp(string) {
  return string.replace(/[-[\]{}()*+?.,;:&\\^$#\s]/g, '\\$&');
}

export function replaceAll(string, find) {
  var escapedFind = escapeRegExp(find); //sorted largest output to smallest output
  var search = new RegExp(
    '<object[^>]*>.*?</object>|<span[^>]*>.*?</span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|(' +
      escapedFind +
      ')',
    'gi',
  );
  // callback prevents replacing anything inside of these common html tags as well as between an <object></object> tag
  var replace = function (entire, m1) {
    return typeof m1 === 'undefined' || m1 === '' ? entire : shortnameLookup[m1];
  };
  return string.replace(search, replace);
}
