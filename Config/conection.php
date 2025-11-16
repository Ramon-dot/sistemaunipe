<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

// Determina a hora da região
date_default_timezone_set('America/Fortaleza');

// A URL base
define('BASE_URL', getenv('APP_BASE_URL') ?: 'http://sistemaunipe.test');

// Conexão com o Banco de dados
define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));

function dbConnect() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die('Conexão com o Banco de dados falhou: ' . $e->getMessage());
    }
}