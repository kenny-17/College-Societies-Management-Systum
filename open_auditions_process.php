<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.html");
    exit();
}

// Include the database configuration file
include_once "db_config.php";

// Retrieve form data
$societyID = $_POST['society'];
$date = $_POST['date'];
$time = $_POST['time'];
$venue = $_POST['venue'];

// Insert the audition details into the database
$sql_insert = "INSERT INTO Auditions (SocietyID, Date, Time, Venue) VALUES ('$societyID', '$date', '$time', '$venue')";
if ($conn->query($sql_insert) === TRUE) {
    // Audition opened successfully, redirect back to the dashboard
    header("Location: dashboard.php");
} else {
    // Error opening auditions, redirect with error message
    header("Location: open_auditions.php?error=1");
}

// Close the database connection
$conn->close();
?>
