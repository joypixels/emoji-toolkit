const fs = require('fs');


// Load emojis
const emojis = JSON.parse(fs.readFileSync(__dirname + '/../../emoji_strategy.json'), 'utf8');

// Get current version from config
const jp = JSON.parse(fs.readFileSync(__dirname + '/../../joypixels.json'), 'utf8');

// Generate .scss mapping
let mapping = '';

for (let key in emojis) {
    if (emojis.hasOwnProperty(key)) {
        mapping += ('"' + key + '": "' + emojis[key].shortname.slice(1, -1) + "\",\n");
    }
}

// Create output string
let output = '$version: "' + jp.version + "\";\n";
output += "$emoji-map: (\n" + mapping;
output = output.substr(0, output.length - 2) + "\n);";

// Write .scss file
const output_path = __dirname + '/_joypixels-awesome.map.scss';
fs.writeFileSync(output_path, output);

console.log('Generated', output_path);