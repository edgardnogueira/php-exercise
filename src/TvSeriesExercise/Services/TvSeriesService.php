<?php

declare(strict_types=1);

namespace TvSeriesExercise\Services;

use DateTime;
use TvSeriesExercise\Repositories\DBSerieRepository;

/**
 * Class TvSeriesService
 */
class TvSeriesService
{
    public $dbSeriesRepository;

    /**
     * TvSeriesService constructor.
     */
    public function __construct()
    {
        // Load config
        $config = require_once __DIR__.'/../../../config/config.php';

        // Create the database connection
        $connect = new PDODatabaseConnection($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

        $this->dbSeriesRepository = new DBSerieRepository($connect);

        if (! empty($_GET['filter_datetime'])) {
            $dateTime = new DateTime($_GET['filter_datetime']);
            $this->dbSeriesRepository->setBeginDate($dateTime ?? null);
        }

        if (! empty($_GET['serie'])) {
            $this->dbSeriesRepository->filter('tv_series.title', $_GET['serie']);
        }
    }
}
