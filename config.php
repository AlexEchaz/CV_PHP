<?php
$host = 'db';
$db = 'cv_db';
$charset = 'utf8mb4';
$user = 'root';
$pass = 'root';

//define('DB_HOST', 'db');
//define('DB_NAME', 'cv_db');
//define('DB_USER', 'root');
//define('DB_PASS', 'root');

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}