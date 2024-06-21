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
$email = $_POST['email'];

// Check if the user is a president of the selected society
$userID = $_SESSION["user_id"];
$sql = "SELECT * FROM Presidents WHERE UserID = $userID AND SocietyID = $societyID";
$result = $conn->query($sql);

// Check if the user is a president of the selected society
if ($result->num_rows > 0) {
    // Check if the user with the provided email exists
    $sql_user = "SELECT UserID FROM Users WHERE Email = '$email'";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
        $userID = $row_user["UserID"];

        // Check if the user is already a member of the selected society
        $sql_membership = "SELECT * FROM Memberships WHERE UserID = $userID AND SocietyID = $societyID";
        $result_membership = $conn->query($sql_membership);

        if ($result_membership->num_rows == 0) {
            // Add the user as a member of the selected society
            $sql_add_member = "INSERT INTO Memberships (UserID, SocietyID) VALUES ($userID, $societyID)";
            if ($conn->query($sql_add_member) === TRUE) {
                echo "User added successfully as a member.";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "User is already a member of the selected society.";
        }
    } else {
        echo "User with the provided email does not exist.";
    }
} else {
    echo "You are not authorized to add members to this society.";
}

// Close the database connection
$conn->close();
?>
