<?php
session_start();
require_once '../dbConnect.php';
include '../Component/header.php';

// Check if buildID is set
if (!isset($_GET['buildID']) || !is_numeric($_GET['buildID'])) {
    echo "<p>Invalid build ID.</p>";
    include '../includes/footer.php';
    exit;
}

$buildID = intval($_GET['buildID']);

// Fetch the build details
$stmt = $conn->prepare("SELECT b.*, u.username FROM BuildSubmissions b 
                        JOIN Users u ON b.userID = u.userID 
                        WHERE b.buildID = ?");
$stmt->bind_param("i", $buildID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Build not found.</p>";
    include '../includes/footer.php';
    exit;
}

$build = $result->fetch_assoc();
?>

<main class="page-container">
    <h2><?= htmlspecialchars($build['buildName']) ?> (<?= ucfirst($build['subclass']) ?>)</h2>
    <p><strong>Submitted by:</strong> <?= htmlspecialchars($build['username']) ?></p>
    <p><strong>Exotic Armor:</strong> <?= htmlspecialchars($build['exoticArmor']) ?></p>

    <section class="build-description">
        <h3>Description</h3>
        <p><?= nl2br(htmlspecialchars($build['description'])) ?></p>
    </section>

    <a href="../<?= $build['subclass'] ?>.php" class="button">← Back to <?= ucfirst($build['subclass']) ?> Builds</a>
</main>

<?php
$stmt->close();
include '../includes/footer.php';
?>
