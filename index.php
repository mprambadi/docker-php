<?php
require 'vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$DB_HOST = getenv("DB_HOST");
$DB_PASSWORD = getenv("DB_PASSWORD");
$DB_USERNAME = getenv("DB_USERNAME");
$DB_NAME = getenv("DB_NAME");


try {
    $pdo = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}", $DB_USERNAME, $DB_PASSWORD);

    $sql = "SELECT * FROM WeatherForecasts";
    $query = $pdo->prepare($sql);
    $query->execute();


    $status = $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
} catch (\Throwable $th) {
    $status = "Could not connect to database";
}

$result = [
    "mysql" => $status
];

echo json_encode($result);
