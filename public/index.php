<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Helpers\ViewHelper;

ViewHelper::render('index', [
    'exerciseList' => [
        ['url' => 'prime.php', 'title' => '1. Prime Numbers'],
        ['url' => 'ascii-array.php', 'title' => '2. Random ASCII Array'],
        ['url' => 'tv-series.php', 'title' => '3. TV Series'],
        ['url' => 'ab-testing.php', 'title' => '4. AB Testing'],
    ],
]);
