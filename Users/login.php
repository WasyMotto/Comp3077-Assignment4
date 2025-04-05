<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../Users/user.php"); // Redirect to user page
        exit;
    } else {
        $_SESSION['error'] = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($_SESSION['error'])) echo "<p class='error'>" . $_SESSION['error'] . "</p>"; ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="create_account.php">Need an account? Create one here.</a>
</body>
</html>
