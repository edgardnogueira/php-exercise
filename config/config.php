<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/../', '.env');
$dotenv->load();

return [
    'db_host' => $_ENV['DB_HOST'],
    'db_user' => $_ENV['DB_USER'],
    'db_pass' => $_ENV['DB_PASS'],
    'db_name' => $_ENV['DB_NAME'],
];
