<?php
session_start();
require_once '../dbConnect.php'; // Include the DB connection

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include header
include '../Components/header.php';

// Check if buildID is set
if (!isset($_GET['buildID']) || !is_numeric($_GET['buildID'])) {
    echo "<p>Invalid build ID.</p>";
    include '../includes/footer.php';
    exit;
}

$buildID = intval($_GET['buildID']);

// Fetch the build details using PDO
try {
    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT b.*, u.username FROM buildSubmissions b 
                            JOIN Users u ON b.userID = u.userID 
                            WHERE b.buildID = :buildID");
    
    // Bind the parameter to prevent SQL injection
    $stmt->bindParam(':buildID', $buildID, PDO::PARAM_INT);
    
    // Execute the query
    $stmt->execute();

    // Check if any build was returned
    if ($stmt->rowCount() === 0) {
        echo "<p>Build not found.</p>";
        include '../includes/footer.php';
        exit;
    }

    // Fetch the build data
    $build = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle any errors that occur during the query
    echo "Error fetching build: " . $e->getMessage();
    include '../includes/footer.php';
    exit;
}

?>

<main class="page-container">
    <h2><?= htmlspecialchars($build['buildName']) ?> (<?= ucfirst($build['class']) ?>)</h2>
    <p><strong>Submitted by:</strong> <?= htmlspecialchars($build['username']) ?></p>
    <p><strong>Exotic Armor:</strong> <?= htmlspecialchars($build['exoticArmor']) ?></p>

    <section class="build-description">
        <h3>Description</h3>
        <p><?= nl2br(htmlspecialchars($build['description'])) ?></p>
    </section>

    <a href="../Home/<?= $build['class'] ?>.php" class="button">← Back to <?= ucfirst($build['class']) ?> Builds</a>
</main>

