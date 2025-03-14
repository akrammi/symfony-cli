<?php

# DB info 
$host = '127.0.0.1';
$db = 'sprint3';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, # to display exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, # the return data will be an associative array
    PDO::ATTR_EMULATE_PREPARES => false, # use the real prepared statement
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
