<?php

declare(strict_types=1);

namespace TvSeriesExercise\Services;

use PDO;
use TvSeriesExercise\Interfaces\DatabaseConnectionInterface;

/**
 * Class LiteDatabaseConnection
 * 
 * This class is used to connect to a SQLite in-memory database. (For testing purposes only)
 */
class LiteDatabaseConnection implements DatabaseConnectionInterface
{
    private $connection;

    private $db;

    private $pdo;

    /**
     * LiteDatabaseConnection constructor.
     */
    public function __construct()
    {
        // Replace 'sqlite_memory_db' with the appropriate DSN for your SQLite in-memory database
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * @param  string  $sql
     * @return PDOStatement
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * @param  string  $sql
     * @return int
     */
    public function exec($sql)
    {
        return $this->pdo->exec($sql);
    }
}
