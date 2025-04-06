<?php  
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../dbConnect.php'; // DB connection

try {  
    $connect = new PDO("mysql:host=$host; dbname=$db", $user, $pass);  
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    if ($_SERVER["REQUEST_METHOD"] === "POST") {  
        // Debugging: Check POST data
        echo "Login POST received<br>";
        print_r($_POST);
        
        if(empty($_POST["username"]) || empty($_POST["password"])) {  
            $message = '<label>All fields are required</label>';  
        } else {  
            // Get the user by username only
            $query = "SELECT * FROM Users WHERE username = :username";
            $statement = $connect->prepare($query);
            $statement->execute(['username' => $_POST["username"]]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            
            // Debugging: Check if user is found
            var_dump($user);

            if ($user && password_verify($_POST["password"], $user["password"])) {
                $_SESSION["userID"] = $user["userID"];
                $_SESSION["username"] = $user["username"];
                
                // Debugging: Check session variables
                var_dump($_SESSION);
                
                header("Location: user.php");
                exit();
            } else {
                echo "Incorrect username or password";
            }
        }  
    }  
} catch(PDOException $error) {  
    $message = $error->getMessage();  
    echo "Error: " . $message;  // Debugging: Output any caught errors
}  
?>  
