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

// Get the user ID from the session
$userID = $_SESSION["user_id"];

// Retrieve societies where the user is a member
$sql = "SELECT s.Name, s.Description FROM Memberships m 
        INNER JOIN Societies s ON m.SocietyID = s.SocietyID 
        WHERE m.UserID = $userID";
$result = $conn->query($sql);

// Check if societies are retrieved successfully
if ($result->num_rows > 0) {
    // Display the list of societies
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>My Societies</title>";
    echo "<style>";
    echo "body {";
    echo "    font-family: Arial, sans-serif;";
    echo "    background-color: lavender;";
    echo "}";
    echo ".container {";
    echo "    max-width: 800px;";
    echo "    margin: 0 auto;";
    echo "    padding: 20px;";
    echo "}";
    echo ".society-card {";
    echo "    background-color: white;";
    echo "    padding: 20px;";
    echo "    border-radius: 8px;";
    echo "    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);";
    echo "    flex: 1 1 300px;";
    echo "}";
    echo ".society-card h3 {";
    echo "    margin-top: 0;";
    echo "    color: #333;";
    echo "}";
    echo ".society-card p {";
    echo "    color: #666;";
    echo "}";
    echo "</style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='container'>";
    echo "<h2 style='text-align: center; color: white;'>My Societies</h2>";
    echo "<div style='display: flex; flex-wrap: wrap; gap: 20px;'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='society-card'>";
        echo "<h3>" . $row["Name"] . "</h3>";
        echo "<p>" . $row["Description"] . "</p>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    echo "<img src='NSUT_logo.png' alt='NSUT Logo' style='display: block; margin: 20px auto;'>";
    echo "</body>";
    echo "</html>";
} else {
    echo "You are not a member of any society.";
}

// Close the database connection
$conn->close();
?>
