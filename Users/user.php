<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php'; // Update path as needed

$userID = $_SESSION['userID'];
$username = $_SESSION['username'] ?? 'User';

// Fetch user's builds
$sql = "SELECT * FROM BuildSubmissions WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($username); ?>'s Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="header">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
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
