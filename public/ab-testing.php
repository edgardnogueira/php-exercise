<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Helpers\ViewHelper;
use App\Services\ABTestingExerciseService;

try {
    $result = (new ABTestingExerciseService())();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage();
}

ViewHelper::render('ab-testing/index', [
    'result' => $result ?? null,
    'promoId' => $result['promoId'] ?? null,
    'title' => 'AB Testing',
]);
