<?php
$servername = "localhost";
$username = "root";
$password = "august212000";
$dbname = "info";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) { // Check for duplicate entry error
        $errorMessage = "User ID already exists. Please enter a different User ID.";
    } else {
        $errorMessage = "An error occurred: " . $e->getMessage();
    }
}
?>