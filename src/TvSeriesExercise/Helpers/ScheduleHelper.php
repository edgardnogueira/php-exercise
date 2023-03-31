<?php

namespace TvSeriesExercise\Helpers;

use DateInterval;
use DateTime;

/**
 * Class ScheduleHelper
 * 
 * This class generates the next schedule time for a given date and time
 */
class ScheduleHelper
{
    /**
     * @param  DateTime  $startDate
     * @param  int  $weekDay (0 = Sunday, 1 = Monday, 2 = Tuesday, 3 = Wednesday, 4 = Thursday, 5 = Friday, 6 = Saturday)
     * @param  string  $scheduleTime (HH:MM:SS)
     * @return DateTime
     */
    public static function getScheduleTimeUsingWeekDay(DateTime $startDate, $weekDay, $scheduleTime): DateTime
    {
        $currentWeekDay = $startDate->format('w');
        $currentTime = $startDate->format('H:i:s');

        $daysToAdd = $weekDay - $currentWeekDay;

        // If the day is today and show time has passed, add 7 days
        if ($daysToAdd < 0 || ($daysToAdd == 0 && $currentTime >= $scheduleTime)) {
            $daysToAdd += 7;
        }

        $nextDateTime = clone $startDate;

        if ($daysToAdd > 0) {
            // Add the days to the date
            $nextDateTime->add(new DateInterval("P{$daysToAdd}D"));
        }

        $nextDateTime->modify($scheduleTime);

        return $nextDateTime;
    }
}
