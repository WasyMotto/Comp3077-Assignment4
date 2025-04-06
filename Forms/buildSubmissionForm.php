<?php
session_start();
require_once '../dbConnect.php'; // uses PDO

// Check if user is logged in (assuming you use session userID)
if (!isset($_SESSION['userID'])) {
    die("You must be logged in to submit a build.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Submit a Build</title>
</head>
    <body>
        <h2>Build Submission Form</h2>
        <form action="submitBuild.php" method="post" enctype="multipart/form-data">
            <label for="buildName">Build Name:</label><br>
            <input type="text" id="buildName" name="buildName" required><br><br>

            <label for="class">Class:</label><br>
            <select id="class" name="class" required>
                <option value="hunter">Hunter</option>
                <option value="warlock">Warlock</option>
                <option value="titan">Titan</option>
            </select><br><br>

            <label for="subclass">Subclass:</label><br>
            <input type="text" id="subclass" name="subclass" required><br><br>

            <label for="exoticArmor">Exotic Armor:</label><br>
            <input type="text" id="exoticArmor" name="exoticArmor" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

             <label for="buildImage">Upload Build Image:</label><br>
            <input type="file" id="buildImage" name="buildImage" accept="image/*"><br><br>


            <input class="button" type="submit" value="Submit Build">
        </form> 
        
    </body>
</html> 