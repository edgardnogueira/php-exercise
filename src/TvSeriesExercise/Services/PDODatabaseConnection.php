<?php

declare(strict_types=1);

namespace TvSeriesExercise\Services;

use PDO;
use TvSeriesExercise\Interfaces\DatabaseConnectionInterface;

/**
 * Class PDODatabaseConnection
 * 
 */
class PDODatabaseConnection implements DatabaseConnectionInterface
{
    private $connection;

    /**
     * PDODatabaseConnection constructor.
     *
     * @param  string  $servername
     * @param  string  $username
     * @param  string  $password
     * @param  string  $dbname
     * @throws \App\Exceptions\DefaultException
     */
    public function __construct($servername, $username, $password, $dbname)
    {
        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            throw new \App\Exceptions\DefaultException('Connection failed (check your connection credentials. For more information README.md): '.$e->getMessage());
        }
    }

    /**
     * @param  string  $sql
     * @return int
     */
    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }
}
