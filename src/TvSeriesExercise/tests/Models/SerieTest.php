<?php

use PHPUnit\Framework\TestCase;
use TvSeriesExercise\Models\Serie;
use TvSeriesExercise\Models\SerieInterval;

class SerieTest extends TestCase
{
    public function testNextSerieShowTime()
    {
        $serie = new Serie(1, 'Test Show', 'Channel 1', 'Drama');
        $serie->intervals = [
            new SerieInterval(1, 1, '20:00:00'), // Monday 20:00
            new SerieInterval(1, 3, '21:00:00'), // Wednesday 21:00
        ];

        $inputDateTime = new DateTime('2023-04-01 12:00:00'); // Saturday
        $expectedNextDateTime = new DateTime('2023-04-03 20:00:00'); // Next Monday 20:00

        $actualNextDateTime = $serie->nextSerieShowTime($inputDateTime);

        $this->assertEquals($expectedNextDateTime, $actualNextDateTime);
    }
}
