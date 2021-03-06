<?php

$config = new PhpCsFixer\Config();

return $config->setRiskyAllowed(true)
	->setRules([
		'@PSR2' => true,

		/**
		 * symfony
		 */
		// Ensure there is no code on the same line as the PHP open tag and it is followed by a blankline.
		'blank_line_after_opening_tag' => true,

		'braces' => [
			'allow_single_line_closure' => true,

			'position_after_functions_and_oop_constructs' => 'same'
		],

		'method_argument_space' => [
			'on_multiline' => 'ensure_fully_multiline',

			'keep_multiple_spaces_after_comma' => false
		],

		// Remove duplicated semicolons.
		'no_empty_statement' => true,

		// PHP multi-line arrays should have a trailing comma.
		'trailing_comma_in_multiline' => false,

		// There should be no empty lines after class opening brace.
		'no_blank_lines_after_class_opening' => true,

		// There should not be blank lines between docblock and the documented element.
		'no_blank_lines_after_phpdoc' => true,

		// Phpdocs short descriptions should end in either a full stop, exclamation mark, or question mark.
		'phpdoc_summary' => true,

		// Phpdocs should start and end with content, excluding the very first and last line of the docblocks.
		'phpdoc_trim' => true,

		// An empty line feed should precede a return statement.
		'blank_line_before_statement' => true,

		// There should be exactly one blank line before a namespace declaration.
		'single_blank_line_before_namespace' => true,

		// Convert double quotes to single quotes for simple strings.
		'single_quote' => true,

		// Unused use statements must be removed.
		'no_unused_imports' => true,

		// Methods must be separated with one blank line.
		'phpdoc_separation' => false,

		// Binary operators should be surrounded by at least one space.
		'binary_operator_spaces' => ['default' => 'align_single_space_minimal'],

		// A single space should be between cast and variable.
		'cast_spaces' => true,

		/**
		 * contrib
		 */
		// Concatenation should be used with at least one whitespace around.
		'concat_space' => ['spacing' => 'one'],

		// Ordering use statements.
		'ordered_imports' => true,

		// PHP arrays should be declared using the configured syntax.
		'array_syntax' => ['syntax' => 'short']
	])
	->setFinder(
		PhpCsFixer\Finder::create()
			->exclude('vendor')
			->exclude('storage')
			->exclude('resources')
			->exclude('public')
			->exclude('config')
			->exclude('bootstrap')
			->exclude('tests')
			->in(__DIR__)
			->name('*.php')
			->ignoreDotFiles(true)
			->ignoreVCS(true)
	)
	->setUsingCache(true);
