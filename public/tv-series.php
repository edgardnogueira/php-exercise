<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Helpers\ViewHelper;
use App\Services\TvSeriesExerciseService;

try {
    $result = (new TvSeriesExerciseService())();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage();
}

ViewHelper::render('tv-series/index', [
    'beginDate' => $result['beginDate'] ?? new DateTime(),
    'allSeriesWithIntervals' => $result['seriesWithIntervals'] ?? [],
    'allSeries' => $result['allSeries'] ?? [],
    'nextShowConsideringAllSeries' => $result['nextShowConsideringAllSeries'] ?? [],
    'nextShowsOrderByShowTime' => $result['nextShowsOrderByShowTime'] ?? [],
    'closestShow' => $result['closestShow'] ?? [],
    'title' => 'TV Series',
]);

/*

echo 'Next show time for each serie: ' . PHP_EOL;

echo PHP_EOL;
echo PHP_EOL;

foreach ($seriesWithInterval as $serie) {
    echo "{$serie->title} next show time:  {$serie->nextSerieShowTime()->format('Y-m-d H:i:s')} on {$serie->channel} " . PHP_EOL;
}

$seriesWithInterval = $tvSeriesFinder->getTvSeriesWithIntervals('Game of Thrones');

echo PHP_EOL;
echo PHP_EOL;

echo 'Next show time on one serie: ' . PHP_EOL;

foreach ($seriesWithInterval as $serie) {
    echo "{$serie->title} next show time:  {$serie->nextSerieShowTime()->format('Y-m-d H:i:s')} on {$serie->channel} " . PHP_EOL;
}

echo PHP_EOL;
echo PHP_EOL;

echo 'Next show time of all: ' . PHP_EOL;




   /* // current datetime + 10 days
    $datePlus10 = new DateTime();
    $datePlus10->add(new DateInterval('P20D'));

    echo "Next show time: " . $serie->nextSerieShowTime($datePlus10)->format('Y-m-d H:i:s') . PHP_EOL;
    foreach ($serie->intervals as $interval) {
        echo "Interval: " . $interval->week_day . " at " . $interval->show_time . PHP_EOL;
    } */
