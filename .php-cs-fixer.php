<?php

declare(strict_types=1);

/**
 * PhpCsFixer.
 *
 * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/index.rst 内置规则
 */

$header = <<<'EOF'
EOF;

return (new PhpCsFixer\Config())
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('public')
            ->exclude('runtime')
            ->exclude('vendor')
            ->in(__DIR__)
    )
    ->setRules([
        '@PSR2' => true, // 遵循 PSR2
        '@Symfony' => true,
        '@DoctrineAnnotation' => true,
        '@PhpCsFixer' => true,
        'header_comment' => [
            'comment_type' => 'PHPDoc',
            'header' => $header,
            'separate' => 'none',
            'location' => 'after_declare_strict',
        ],
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'list_syntax' => [
            'syntax' => 'short',
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'blank_line_before_statement' => [
            'statements' => [
                'declare',
            ],
        ],
        // phpDocs 中应该省略已经配置的注释
        'general_phpdoc_annotation_remove' => [
            'annotations' => [
                'author',
            ],
        ],
        // use 排序
        'ordered_imports' => [
            'imports_order' => [
                'class', 'function', 'const',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'single_line_comment_style' => [
            'comment_types' => [
            ],
        ],
        'yoda_style' => [
            'always_move_variable' => false,
            'equal' => false,
            'identical' => false,
        ],
        'phpdoc_align' => [
            'align' => 'vertical', // 注释对齐方式
        ],
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'constant_case' => [
            'case' => 'lower',
        ],
        'class_attributes_separation' => true,
        'combine_consecutive_unsets' => true, // 多个 unset 合并成一个
        'declare_strict_types' => true,
        'linebreak_after_opening_tag' => true,
        'lowercase_static_reference' => true,
        'no_useless_else' => true, // 删除无用的 else
        'no_unused_imports' => true, // 删除未使用的 use 语句
        'not_operator_with_successor_space' => true,
        'not_operator_with_space' => false,
        'ordered_class_elements' => true, // class elements 排序
        'php_unit_strict' => false,
        'phpdoc_separation' => false,
        'single_quote' => true,  // 简单字符串应该使用单引号代替双引号
        'standardize_not_equals' => true,
        'multiline_comment_opening_closing' => true,
    ])
    ->setRiskyAllowed(true)
    ->setUsingCache(false);
