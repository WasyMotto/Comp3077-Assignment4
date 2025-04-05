<?php
// Database connection
$host = "localhost";
$dbname = "wasylyz_Destiny101";
$username = "wasylyz_Destiny101";
$password = "UUzHdf4MysS35GVtQz6d"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["error" => "Connection failed: " . $e->getMessage()]));
}

// Retrieve JSON payload
$data = json_decode(file_get_contents('php://input'), true);

// Debugging: Check if data is received
if (!$data) {
    die(json_encode(["error" => "No valid data received."]));
}

try {
    if (isset($data['userID']) && isset($data['buildName']) && isset($data['subclass']) && isset($data['exoticArmor']) && isset($data['description'])) {
        // Insert into BuildSubmissions Table
        $stmt = $pdo->prepare("INSERT INTO BuildSubmissions (userID, buildName, subclass, exoticArmor, description) VALUES (:userID, :buildName, :subclass, :exoticArmor, :description)");
        $stmt->bindParam(':userID', $data['userID']);
        $stmt->bindParam(':buildName', $data['buildName']);
        $stmt->bindParam(':subclass', $data['subclass']);
        $stmt->bindParam(':exoticArmor', $data['exoticArmor']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();
        echo json_encode(["success" => "Build submission added successfully."]);
    } 
    else {
        echo json_encode(["error" => "Invalid data format."]);
    }

} catch (PDOException $e) {
    die(json_encode(["error" => "Error inserting data: " . $e->getMessage()]));
}
?>