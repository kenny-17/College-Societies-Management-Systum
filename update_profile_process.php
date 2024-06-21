<?php
// Include database configuration
include('includes/db_config.php');

// Retrieve form data
$userID = $_SESSION['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

// Update user information in Users table
$sql = "UPDATE Users SET Name='$name', Email='$email', Password='$password' WHERE UserID='$userID'";

if ($conn->query($sql) === TRUE) {
    // Update successful
    echo "Profile updated successfully.";
} else {
    // Error handling
    echo "Error updating profile: " . $conn->error;
}

// Close database connection
$conn->close();
