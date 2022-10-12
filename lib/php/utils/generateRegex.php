<?php declare(strict_types=1);

if (php_sapi_name() !== 'cli')
{
	echo "This script must be run in CLI\n";
	exit(1);
}

require __DIR__ . '/../../../vendor/autoload.php';

// List of valid emoji sequences that should be matched
$matches = [];

// Add fully-qualified sequences from emoji.json
$filepath = __DIR__ . '/../../../emoji.json';
foreach (json_decode(file_get_contents($filepath), true) as $emoji)
{
	$matches[] = seqToUtf8($emoji['code_points']['fully_qualified']);
}

// The delimiter and modifiers should match what's used in toShort()
$builder = s9e\RegexpBuilder\Factory\PHP::getBuilder(
	delimiter: '/',
	modifiers: 'ui'
);
// The regexp is used as part of another. Marking it as not "standalone" will cause it to
// be wrapped in a non-capturing group so it doesn't interfere with other alternations
$builder->standalone = false;
$regexp = $builder->build($matches);

patchFile(
	realpath(__DIR__ . '/../src/Client.php'),
	'/public \\$unicodeRegexp = \\K.*(?=;)/',
	var_export($regexp, true)
);

/**
* @param string $filepath    Path to the file
* @param string $regexp      PCRE regexp used to match what needs to be patched
* @param string $replacement Literal string replacement
*/
function patchFile(string $filepath, string $regexp, string $replacement): void
{
	$old = file_get_contents($filepath);
	$new = preg_replace_callback(
		$regexp,
		function () use ($replacement)
		{
			return $replacement;
		},
		$old
	);
	if ($new !== $old)
	{
		file_put_contents($filepath, $new);
		echo "Patched $filepath\n";
	}
	else
	{
		echo "$filepath is already up to date\n";
	}
}

/**
* Convert a sequence of hex codes to UTF-8
*
* @param  string $seq Original sequence, e.g. "263a-fe0f"
* @return string      UTF-8 representation, e.g. "\u{263A}\u{FE0F}"
*/
function seqToUtf8(string $seq): string
{
	$str = '';
	foreach (preg_split('([-_ ])', $seq) as $hex)
	{
		$str .= IntlChar::chr(hexdec($hex));
	}

	return $str;
}