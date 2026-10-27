<?php

$host = getenv('DB_HOST') ?: '127.0.0.1';
$dbname = getenv('DB_NAME') ?: 'mvc_blog_system';
$username = getenv('DB_USER') ?: 'mvc_blog';
$password = getenv('DB_PASSWORD');
$port = (int)(getenv('DB_PORT') ?: 3306);

if ($password === false) {
    http_response_code(500);
    exit('Set the DB_PASSWORD environment variable before starting the application.');
}

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed.');
}