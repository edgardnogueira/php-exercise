<?php

declare(strict_types=1);

namespace TvSeriesExercise\Repositories;

use DateTime;
use PDO;
use TvSeriesExercise\Interfaces\DatabaseConnectionInterface;
use TvSeriesExercise\Interfaces\SerieRepositoryInterface;
use TvSeriesExercise\Models\Serie;
use TvSeriesExercise\Models\SerieInterval;

/**
 * Class DBSerieRepository
 * 
 */
class DBSerieRepository implements SerieRepositoryInterface
{
    private array $filters = [];

    public $beginDate;

    /**
     * DBSerieRepository constructor.
     *
     * @param  DatabaseConnectionInterface  $connection
     */
    public function __construct(private DatabaseConnectionInterface $connection)
    {
    }

    /**
     * @param  string  $field
     * @param  string  $value
     * @return DBSerieRepository
     */
    public function filter($field, $value): self
    {
        $this->filters[][$field] = $value;

        return $this;
    }

    /**
     * @param  DateTime|null  $dateTime
     * @return DBSerieRepository
     */
    public function setBeginDate(?DateTime $dateTime = null): self
    {
        $this->beginDate = $dateTime;

        return $this;
    }

    /**
     * @return Serie|null
     */
    public function getClosestShow(): ?Serie
    {
        return $this->getNextShowsOrderByShowTime()[0] ?? null;
    }

    /**
     * @return array
     */
    public function getNextShowsOrderByShowTime()
    {
        $series = $this->getTvSeriesWithIntervals();

        $dateTime = $this->beginDate ?? new DateTime();

        usort($series, function ($a, $b) use ($dateTime) {
            return $a->nextSerieShowTime($dateTime) <=> $b->nextSerieShowTime($dateTime);
        });

        return $series ?? [];
    }

    /**
     * @return array
     */
    public function getAllSeries(): array
    {
        $sql = 'SELECT * FROM tv_series order by id';

        $query = $this->connection->prepare($sql);
        $query->execute();

        $series = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $series[] = new Serie($row['id'], $row['title'], $row['channel'], $row['gender']);
        }

        return $series;
    }

    public function getTvSeriesWithIntervals(): array
    {
        $sql = '
            SELECT
                tv_series.id,
                tv_series.title,
                tv_series.channel,
                tv_series.gender,
                tv_series_intervals.week_day,
                tv_series_intervals.show_time
            FROM
                tv_series
            INNER JOIN
                tv_series_intervals
            ON
                tv_series.id = tv_series_intervals.tv_series_id
        ';

        if (count($this->filters) > 0) {
            foreach ($this->filters as $filter) {
                $field = array_key_first($filter);
                $sql .= " WHERE {$field} = ?";
            }
        }

        $query = $this->connection->prepare($sql);

        if (count($this->filters) > 0) {
            foreach ($this->filters as $filter) {
                $value = array_values($filter)[0];
                $query->bindValue(1, $value, PDO::PARAM_STR);
            }
        }

        $query->execute();

        $seriesWithIntervals = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $seriesId = $row['id'];
            $interval = new SerieInterval($seriesId, $row['week_day'], $row['show_time']);

            if (! isset($seriesWithIntervals[$seriesId])) {
                $seriesWithIntervals[$seriesId] = new Serie($seriesId, $row['title'], $row['channel'], $row['gender']);
                $seriesWithIntervals[$seriesId]->intervals = [];
            }

            $seriesWithIntervals[$seriesId]->intervals[] = $interval;
        }

        return array_values($seriesWithIntervals);
    }
}
