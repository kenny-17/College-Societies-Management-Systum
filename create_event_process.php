<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserID"])) {
    // Redirect to the login page if not logged in
    header("Location: login.html");
    exit();
}

// Include the database configuration file
include_once "db_config.php";

// Retrieve form data
$eventName = $_POST['eventName'];
$eventDate = $_POST['eventDate'];
$eventTime = $_POST['eventTime'];
$eventDescription = $_POST['eventDescription'];

// Get the user ID from the session
$userID = $_SESSION["UserID"];

// Insert the event into the Events table
$sql = "INSERT INTO Events (Name, Description, Date, Location) 
        VALUES ('$eventName', '$eventDescription', '$eventDate', '$eventTime')";

if ($conn->query($sql) === TRUE) {
    echo "Event created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
