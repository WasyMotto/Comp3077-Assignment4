<?php
// Include the database connection (replace with your actual DB connection details)
include('db_connection.php');

// Initialize variables to store form data
$name = $email = $message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '';
    $message = htmlspecialchars($_POST['message']);
    
    if ($email) {
        try {
            // Prepare the insert query
            $query = "INSERT INTO contact_me (username, email, message) VALUES (:name, :email, :message)";
            $stmt = $pdo->prepare($query);

            // Bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);

            // Execute the query
            if ($stmt->execute()) {
                echo "<script>alert('Message sent successfully!'); window.location.href = 'thankyou.html';</script>";
            } else {
                echo "<script>alert('Error sending message. Please try again later.'); window.location.href = 'contact.html';</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'contact.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid email address. Please provide a valid email.'); window.location.href = 'contact.html';</script>";
    }
}
?>
