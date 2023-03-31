<?php

use PHPUnit\Framework\TestCase;
use TvSeriesExercise\Models\SerieInterval;

class SerieIntervalTest extends TestCase
{
    public function testNextIntervalShowTime()
    {
        $serieInterval = new SerieInterval(1, 1, '20:00:00'); // Monday 20:00

        $inputDateTime = new DateTime('2023-04-01 12:00:00'); // Saturday
        $expectedNextDateTime = new DateTime('2023-04-03 20:00:00'); // Next Monday 20:00

        $actualNextDateTime = $serieInterval->nextIntervalShowTime($inputDateTime);

        $this->assertEquals($expectedNextDateTime, $actualNextDateTime);
    }
}
