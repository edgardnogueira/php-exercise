<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Helpers\ViewHelper;
use App\Services\PrimeExerciseService;

try {
    $result = (new PrimeExerciseService())(1, 100);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage();
}

ViewHelper::render('prime/index', [
    'result' => $result ?? null,
    'title' => 'Prime Numbers',
]);
