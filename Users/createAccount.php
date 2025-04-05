<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $username && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO Users (email, username, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$email, $username, $hashedPassword]);
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

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Create Account</h2>
    <?php if (isset($_SESSION['error'])) echo "<p class='error'>" . $_SESSION['error'] . "</p>"; ?>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Create Account</button>
    </form>
    <a href="login.php">Already have an account? Log in here.</a>
</body>
</html>
