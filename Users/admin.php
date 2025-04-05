<?php
// admin_dashboard.php
session_start();
require_once '../config.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['userID']) || $_SESSION['username'] !== 'admin') {
    header('Location: ../Users/login.php');
    exit();
}

// Handle delete action
if (isset($_GET['delete'])) {
    $buildID = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM BuildSubmissions WHERE buildID = ?");
    $stmt->bind_param("i", $buildID);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_dashboard.php');
    exit();
}

// Fetch all builds
$builds = [];
$sql = "SELECT B.*, U.username FROM BuildSubmissions B JOIN Users U ON B.userID = U.userID";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $builds[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="add_build.php">Add New Build</a>
    <table border="1">
        <thead>
            <tr>
                <th>Build Name</th>
                <th>Subclass</th>
                <th>Exotic Armor</th>
                <th>Description</th>
                <th>Submitted By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($builds as $build): ?>
                <tr>
                    <td><?= htmlspecialchars($build['buildName']) ?></td>
                    <td><?= htmlspecialchars($build['subclass']) ?></td>
                    <td><?= htmlspecialchars($build['exoticArmor']) ?></td>
                    <td><?= htmlspecialchars($build['description']) ?></td>
                    <td><?= htmlspecialchars($build['username']) ?></td>
                    <td>
                        <a href="edit_build.php?id=<?= $build['buildID'] ?>">Edit</a> |
                        <a href="?delete=<?= $build['buildID'] ?>" onclick="return confirm('Delete this build?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>