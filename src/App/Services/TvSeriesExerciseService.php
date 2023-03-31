<?php

declare(strict_types=1);

namespace App\Services;

use DateTime;
use TvSeriesExercise\Services\TvSeriesService;

/**
 * Class TvSeriesExerciseService
 *
 * Service to run the TvSeriesExercise and return the result that will be used in the view
 */
class TvSeriesExerciseService
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        try {
            $tvSeriesService = new TvSeriesService();

            $allSeries = $tvSeriesService->dbSeriesRepository->getAllSeries();

            $seriesWithIntervals = $tvSeriesService->dbSeriesRepository->getTvSeriesWithIntervals();

            $nextShowsOrderByShowTime = $tvSeriesService->dbSeriesRepository->getNextShowsOrderByShowTime();

            $closestShow = $tvSeriesService->dbSeriesRepository->getClosestShow();
        } catch (\App\Exceptions\DefaultException $e) {
            exit($e->getMessage());
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

        return [
            'beginDate' => $tvSeriesService->dbSeriesRepository->beginDate ?? new DateTime(),
            'seriesWithIntervals' => $seriesWithIntervals ?? [],
            'allSeries' => $allSeries ?? [],
            'nextShowsOrderByShowTime' => $nextShowsOrderByShowTime ?? [],
            'closestShow' => $closestShow ?? [],
        ];
    }
}
