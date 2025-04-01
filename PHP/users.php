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
    if (isset($data['email']) && isset($data['username']) && isset($data['password'])) {
        // Insert into Users Table
        $stmt = $pdo->prepare("INSERT INTO Users (email, username, password) VALUES (:email, :username, :password)");
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_BCRYPT)); // Hash password
        $stmt->execute();
        echo json_encode(["success" => "User registered successfully."]);
    } 
    else {
        echo json_encode(["error" => "Invalid data format."]);
    }

} catch (PDOException $e) {
    die(json_encode(["error" => "Error inserting data: " . $e->getMessage()]));
}
?>