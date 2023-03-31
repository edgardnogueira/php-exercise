<?php

declare(strict_types=1);

namespace TvSeriesExercise\Models;

use DateTime;
use TvSeriesExercise\Helpers\ScheduleHelper;

/**
 * Class SerieInterval
 */
class SerieInterval
{
    /**
     * SerieInterval constructor.
     *
     * @param  int  $id_tv_series
     * @param  string  $week_day
     * @param  string  $show_time
     */
    public function __construct(public $id_tv_series, public $week_day, public $show_time)
    {
    }

    /**
     * @param  DateTime|null  $dateTime
     * @return DateTime|null
     */
    public function nextIntervalShowTime(?DateTime $dateTime = new DateTime()): ?DateTime
    {
        return ScheduleHelper::getScheduleTimeUsingWeekDay($dateTime, $this->week_day, $this->show_time);
    }
}
