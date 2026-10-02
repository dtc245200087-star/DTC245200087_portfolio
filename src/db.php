<?php
$host = getenv('DB_HOST') ?: 'db';
$dbname = 'portfolio_db';
$user = 'portfolio_user';
$pass = 'userpassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
} catch (PDOException $e) {
    die("Loi ket noi DB: " . $e->getMessage());
}
