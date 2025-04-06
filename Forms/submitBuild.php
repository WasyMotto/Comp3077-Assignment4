<?php
session_start();
require_once '../dbConnect.php'; // includes database connection (PDO)

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    die("You must be logged in to submit a build.");
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $userID = $_SESSION['userID'];
    $buildName = $_POST['buildName'];
    $class = $_POST['class'];
    $subclass = $_POST['subclass'];
    $exoticArmor = $_POST['exoticArmor'];
    $description = $_POST['description'];

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
        // Set image file destination
        $targetDir = '../Images/';
        $imageName = basename($_FILES['imagePath']['name']);
        $imagePath = $targetDir . $imageName;
        
        // Move the uploaded image to the desired directory
        if (!move_uploaded_file($_FILES['imagePath']['tmp_name'], $imagePath)) {
            die("Error uploading image.");
        }
    }

    // Insert build data into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO buildSubmissions (userID, buildName, class, subclass, exoticArmor, description, imagePath)
                               VALUES (:userID, :buildName, :class, :subclass, :exoticArmor, :description, :imagePath)");
        
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':buildName', $buildName);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':subclass', $subclass);
        $stmt->bindParam(':exoticArmor', $exoticArmor);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':imagePath', $imagePath);

        // Execute the statement
        $stmt->execute();

        // Redirect after successful submission
        header('Location: ../Users/user.php');
        exit();

    } catch (PDOException $e) {
        die("Error inserting build: " . $e->getMessage());
    }
}
?>
