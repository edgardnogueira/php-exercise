<?php

declare(strict_types=1);

namespace TvSeriesExercise\Interfaces;

/**
 * Interface DatabaseConnectionInterface
 */
interface DatabaseConnectionInterface
{
    public function prepare($sql);
}
