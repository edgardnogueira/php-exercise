<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Helpers\ViewHelper;
use App\Services\AsciiArrayExerciseService;

try {
    $result = (new AsciiArrayExerciseService())(',', '|');
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage();
}

ViewHelper::render('ascii-array/index', [
    'result' => $result ?? null,
    'title' => 'Random ASCII Array',
]);
