<?php

$finder = PhpCsFixer\Finder::create()
    ->in("src")
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setUsingCache(false)
    ->setFinder($finder)
;
