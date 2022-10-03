// New tests can be added to validate.json
// Regenerate the tests.html file with the following command 'node generate.js'
// underscore.js is required. It can be installed with 'npm install underscore'

const fs = require('fs');
const  _ = require('underscore');


// Get current version from config
const jp = JSON.parse(fs.readFileSync(__dirname + '/../../../joypixels.json'), 'utf8');

// Load emojis
const testData = fs.readFileSync(__dirname + '/validate.json', { encoding: 'utf8' });

// Replace the version tokens with the current value
const testDataReplaced = testData.replaceAll('{{version}}', jp.version);

const tests = JSON.parse(testDataReplaced, 'utf8');

// Load template
const data = fs.readFileSync(__dirname + '/template.html', { encoding: 'utf8' });

const template = _.template(data);

const testFile = template(tests);

// Write test file
const output_path = __dirname + '/tests.html';
fs.writeFileSync(output_path, testFile);

console.log('Generated', output_path);