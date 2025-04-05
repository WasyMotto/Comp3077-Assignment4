<?php
session_start();
session_unset();   // Remove all session variables
session_destroy(); // Destroy the session
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
    <meta http-equiv="refresh" content="3;url=login.php"> <!-- Redirect after 3 seconds -->
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="logout-message">
        <h2>You have been logged out.</h2>
        <p>Redirecting you to the login page...</p>
        <p>If you're not redirected, <a href="login.php">click here</a>.</p>
    </div>
</body>
</html>
