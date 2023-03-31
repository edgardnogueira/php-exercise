<?php

namespace TvSeriesExercise\Interfaces;

/**
 * Interface SerieRepositoryInterface
 */
interface SerieRepositoryInterface
{
    /**
     * @return array Array of Serie objects and their intervals
     */
    public function getTvSeriesWithIntervals(); // return an array of Serie objects
}
