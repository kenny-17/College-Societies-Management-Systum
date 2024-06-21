<?php
// Database configuration
$servername = "localhost"; // Database host
$username = "root"; // Database username
$password = ""; // Database password
$database = "college_society_management_system"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

