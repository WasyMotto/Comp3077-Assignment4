<?php
session_start();
require_once '../dbConnect.php'; // DB connection
include '../Components/header.php';
?>

<main class="page-container">
    <h2>Hunter Builds</h2>
    <p>Explore all submitted Hunter builds. Click any build to view full details.</p>

    <div class="build-list">
        <?php
        $stmt = $conn->prepare("SELECT b.*, u.username FROM BuildSubmissions b 
                                JOIN Users u ON b.userID = u.userID 
                                WHERE subclass = 'hunter'");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($build = $result->fetch_assoc()) {
                include '../Components/build-card.php';
            }
        } else {
            echo "<p>No hunter builds found yet.</p>";
        }

        $stmt->close();
        ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
