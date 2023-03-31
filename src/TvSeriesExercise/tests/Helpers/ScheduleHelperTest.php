<?php

use PHPUnit\Framework\TestCase;
use TvSeriesExercise\Helpers\ScheduleHelper;

class ScheduleHelperTest extends TestCase
{
    public function testGetScheduleTimeUsingWeekDay()
    {
        $startDate = new DateTime('2023-04-01 12:00:00'); // Saturday
        $weekDay = 1; // Monday
        $scheduleTime = '20:00:00';

        $expectedNextDateTime = new DateTime('2023-04-03 20:00:00');
        $actualNextDateTime = ScheduleHelper::getScheduleTimeUsingWeekDay($startDate, $weekDay, $scheduleTime);

        $this->assertEquals($expectedNextDateTime, $actualNextDateTime);
    }
}
