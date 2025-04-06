<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($email && $user && $pass) {
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO Users (email, username, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$email, $user, $hashedPassword]);
            $_SESSION['message'] = "Account created! You can now log in.";
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Username or email already exists.";
        }
    } else {
        $_SESSION['error'] = "Please fill in all fields.";
    }
}
?>


