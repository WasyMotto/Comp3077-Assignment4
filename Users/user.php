<?php
session_start();
include '../Components/header.php';
require_once '../dbConnect.php'; // Ensure path is correct

// Redirect to login page if user is not logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['userID'];
$user = $_SESSION['username'] ?? 'User';  // Default to 'User' if no username in session

// Fetch user's builds using PDO
try {
    $sql = "SELECT * FROM buildSubmissions WHERE userID = 11";  // Correct table name and use a placeholder
    $stmt = $pdo->prepare($sql);
    $stmt->execute();  // Execute query with the userID parameter
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch all results as associative array

    
} catch (PDOException $e) {
    // Handle PDO error, if any
    die("Error fetching builds: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($user); ?>'s Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="header">
        <h1>Welcome, <?php echo htmlspecialchars($user); ?>!</h1>
    </div>

    <div class="theme-selector">
        <label for="theme">Select Theme:</label>
        <select id="theme">
            <option value="light">Light</option>
            <option value="dark">Dark</option>
            <option value="solarized">Solarized</option>
        </select>
    </div>

<h2>Your Submitted Builds</h2>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="build-card">
                <h3><?php echo htmlspecialchars($row['buildName']); ?></h3>
                <p><strong>Subclass:</strong> <?php echo htmlspecialchars($row['subclass']); ?></p>
                <p><strong>Exotic Armor:</strong> <?php echo htmlspecialchars($row['exoticArmor']); ?></p>
                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You haven't submitted any builds yet.</p>
    <?php endif; ?>

    <form action="logout.php" method="post" class="logout-btn">
        <button type="submit">Log Out</button>
    </form>

    <script src="../scripts.js"></script>
</body>
</html>
