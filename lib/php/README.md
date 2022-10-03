# PHP

### Tests

There are various tests included in the tests folder. They validate different parts of the project like library methods and ruleset data. To run them first load the necessary Composer packages in the root of the project.

`composer install`

Then run the tests.

`composer tests`

### Unicode regular expression generation

The Client.php file is ready to use once the toolkit has been downloaded. If there's a need to modify the library, specifically any fully qualified codepoints in the emoji.json file, you will need to generate a new $unicodeRegexp value in Client.php.
To do so first load the necessary Composer packages in the root of the project.

`composer install`

Then run the generator script.

`composer generate-regex`

**Note:** The script will modify and overwrite the current file.