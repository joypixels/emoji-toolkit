# PHP

The minimum PHP version required to install this library is >=7.1  
This conflicts with the requirements of the dev tools included in the composer.json file, which require a minimum version >=8.1  
The minimum version for this library was left at a lower level to allow for as much of the community to use the latest version of our library as possible.  
The packages used for tests and unicode expression generation are not required to use this library so the choice was made to allow for their higher version requirement in order to provide more current, supported tools. Those who need or wish to modify this library, and use the tools we've provided, will need to be able to support the minimum required version of PHP for those tools.

### Tests

There are various tests included in the tests folder. They validate different parts of the project like library methods and ruleset data. To run them first load the necessary Composer packages in the root of the project.

`composer install`

Then run the tests.

`composer tests`

### Unicode regular expression generation

The Client.php file is ready to use once the toolkit has been downloaded. If there's a need to modify the library, specifically any fully qualified codepoints in the emoji.json file, you will need to generate a new $unicodeRegexp value in Client.php.
To do so first load the necessary Composer packages in the root of the project.

`composer install`

Then run the Client.php update script.

`composer update-client`

**Note:** The script will modify and overwrite the current file.