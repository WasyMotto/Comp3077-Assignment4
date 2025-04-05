<?php
$host = 'localhost';     // Change if hosted remotely
$db   = 'wasylykz_Destiny101';
$user = 'wasylykz_Destiny101';
$pass = 'UUzHdf4MysS35GVtQz6d';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>