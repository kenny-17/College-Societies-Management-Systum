<?php
// Include database configuration
include('db_config.php');

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

// Insert user into Users table
$sql = "INSERT INTO Users (Name, Email, Password) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Registration successful
    // Redirect to login page
    header("Location: login.html");
    exit();
} else {
    // Error handling
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
