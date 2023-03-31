<?php

declare(strict_types=1);

namespace TvSeriesExercise\Models;

use DateTime;

/**
 * Class Serie
 * 
 */
class Serie
{
    public $intervals;

    private array $nextShowTimeCache = [];

    /**
     * Serie constructor.
     *
     * @param  int  $id
     * @param  string  $title
     * @param  string  $channel
     * @param  string  $gender
     */
    public function __construct(public $id, public $title, public $channel, public $gender)
    {
        $this->intervals = [];
    }

    /**
     * @param  DateTime|null  $dateTime
     * @return DateTime|null
     */
    public function nextSerieShowTime(?DateTime $dateTime = null): ?DateTime
    {
        if ($dateTime === null) {
            $dateTime = new DateTime();
        }

        $cacheKey = $dateTime->format('Y-m-d H:i:s');

        if (isset($this->nextShowTimeCache[$cacheKey])) {
            return $this->nextShowTimeCache[$cacheKey];
        }

        $shows = [];
        foreach ($this->intervals as $interval) {
            $shows[] = $interval->nextIntervalShowTime($dateTime);
        }

        $nextShowTime = ! empty($shows) ? min($shows) : null;

        $this->nextShowTimeCache[$cacheKey] = $nextShowTime;

        return $nextShowTime;
    }
}
