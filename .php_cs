<?php

if (PHP_SAPI !== 'cli') {
    die('This script supports command line usage only. Please check your command.');
}

$finder = PhpCsFixer\Finder::create()
    ->exclude('Configuration')
    ->exclude('Documentation')
    ->exclude('Resources')
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules(array(
        '@PSR2' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_return' => true,
        'method_separation' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_align' => true,
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_indent' => true,
        'phpdoc_inline_tag' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_alias_tag' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => true,
        'phpdoc_return_self_reference' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true
    ))
    ->setFinder($finder)
;
