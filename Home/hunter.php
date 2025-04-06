<?php
session_start();
require_once '../dbConnect.php'; // DB connection
include '../Components/header.php';
?>
<main class="container">
    <h2>Hunter Builds</h2>
    <p>Explore all submitted Hunter builds. Click any build to view full details.</p>

    <div class="build-list">
        <?php
        $stmt = $pdo->prepare("SELECT b.*, u.username FROM buildSubmissions b 
                                JOIN Users u ON b.userID = u.userID 
                                WHERE class = 'hunter'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
    foreach ($result as $build) {
        include '../Components/buildCard.php';
    }
    } else {
        echo "<p>No hunter builds found yet.</p>";
    }

        ?>
    </div>
</main>

