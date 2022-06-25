<?php

/**
 * This file is part of the BB-One Role Playing Game application.
 *
 * PHP 7.4
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * (c) Longitude One 2020
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
;

$header = <<<'EOF'
This file is part of the Banned Bundle.

PHP 7.4 | 8.0

(c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
(c) Longitude One 2020 - 2021 

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return (new PhpCsFixer\Config())
    ->setCacheFile('.php-cs-fixer.cache')
    ->setRules([
        '@PHPUnit75Migration:risky' => true,
        '@PhpCsFixer' => true,
        '@Symfony' => true,
        '@PSR12' => true,
        'declare_strict_types' => true,
        'header_comment' => [
            'comment_type' => 'PHPDoc',
            'header' => $header,
            'location' => 'after_open',
            'separate' => 'bottom',
        ],
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'constant_public', 'constant_protected', 'constant_private', 'constant',
                'property_public_static', 'property_protected_static', 'property_private_static', 'property_static',
                'property_public', 'property_protected', 'property_private', 'property',
                'construct', 'destruct',
                'phpunit',
                'method_public_static', 'method_protected_static', 'method_private_static', 'method_static',
                'method_public', 'method_protected', 'method_private', 'method', 'magic',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'linebreak_after_opening_tag' => true,
        // 'modernize_types_casting' => true,
        'no_useless_return' => true,
        'no_extra_blank_lines' => ['tokens' => ['case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'square_brace_block', 'switch', 'throw', 'use_trait']],
        // 'phpdoc_add_missing_param_annotation' => true,
        // 'protected_to_private' => true,
        'strict_param' => true,
        'php_unit_test_class_requires_covers' => false,
    ])
    ->setFinder($finder)
    ;
