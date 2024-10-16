<?php
$host = 'db';
$db = 'cv_db';
$user = 'root'; // Update this with your MySQL username
$pass = 'root';     // Update this with your MySQL password
$charset = 'utf8mb4';

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

define('DB_HOST', 'cv_db');
define('DB_NAME', 'cv_php');
define('DB_USER', 'votre_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');