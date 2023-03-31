<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TvSeriesExercise\Models\Serie;
use TvSeriesExercise\Models\SerieInterval;
use TvSeriesExercise\Repositories\DBSerieRepository;
use TvSeriesExercise\Services\LiteDatabaseConnection;

class DBSerieRepositoryTest extends TestCase
{
    private $dbConnection;

    private $dbSerieRepository;

    protected function setUp(): void
    {
        // For testing purposes, we use a lite database connection. (the database is in memory)
        $this->dbConnection = new LiteDatabaseConnection();

        // Import the database.sql file to the database.
        // This file contains the database structure for testing purposes only.
        $this->importMySQLDump(__DIR__.'/../database/database.sql');

        $this->dbSerieRepository = new DBSerieRepository($this->dbConnection);
    }

    public function testGetAllSeries(): void
    {
        $series = $this->dbSerieRepository->getAllSeries();

        $this->assertIsArray($series);
        $this->assertInstanceOf(Serie::class, $series[0]);
    }

    public function testGetTvSeriesWithIntervals(): void
    {
        $seriesWithIntervals = $this->dbSerieRepository->getTvSeriesWithIntervals();

        $this->assertIsArray($seriesWithIntervals);
        $this->assertInstanceOf(Serie::class, $seriesWithIntervals[0]);
        $this->assertContainsOnlyInstancesOf(SerieInterval::class, $seriesWithIntervals[0]->intervals);
    }

    public function testGetClosestShow(): void
    {
        $closestShow = $this->dbSerieRepository->getClosestShow();

        $this->assertEquals('Halt and Catch Fire', $closestShow->title);
        $this->assertEquals('2023-03-31 14:00:00', $closestShow->nextSerieShowTime()->format('Y-m-d H:i:s'));
        $this->assertInstanceOf(Serie::class, $closestShow);
    }

    public function testGetClosestShowWithTitle(): void
    {
        $closestShow = $this->dbSerieRepository->filter('tv_series.title', 'Game of Thrones')->getClosestShow();

        $this->assertEquals('Game of Thrones', $closestShow->title);
        $this->assertInstanceOf(Serie::class, $closestShow);
    }

    public function testGetClosestShowWithBeginDate(): void
    {
        $closestShow = $this->dbSerieRepository->setBeginDate(new DateTime('2023-04-30 00:00:00'))->getClosestShow();

        $this->assertEquals('Game of Thrones', $closestShow->title);
        $this->assertEquals('2023-04-30 21:00:00', $closestShow->nextSerieShowTime(new DateTime('2023-04-30 00:00:00'))->format('Y-m-d H:i:s'));
        $this->assertInstanceOf(Serie::class, $closestShow);
    }

    public function testGetClosestShowCheckConsideringTime(): void
    {
        $closestShow = $this->dbSerieRepository->setBeginDate(new DateTime('2023-03-31 14:00:00'))->getClosestShow();

        $this->assertEquals('Game of Thrones', $closestShow->title);
        $this->assertEquals('2023-03-31 18:00:00', $closestShow->nextSerieShowTime(new DateTime('2023-03-31 14:00:00'))->format('Y-m-d H:i:s'));
        $this->assertInstanceOf(Serie::class, $closestShow);

        $closestShow = $this->dbSerieRepository->setBeginDate(new DateTime('2023-03-31 13:59:00'))->getClosestShow();

        $this->assertEquals('Halt and Catch Fire', $closestShow->title);
        $this->assertEquals('2023-03-31 14:00:00', $closestShow->nextSerieShowTime(new DateTime('2023-03-31 13:59:00'))->format('Y-m-d H:i:s'));
    }

    private function importMySQLDump(string $filePath): void
    {
        $sql = file_get_contents($filePath);

        if ($sql === false) {
            throw new Exception("Failed to read the contents of the SQL dump file: {$filePath}");
        }

        $this->dbConnection->exec($sql);
    }
}
