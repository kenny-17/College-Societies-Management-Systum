<?php
// Include database configuration
include('db_config.php');

// Check if form data is set
if (isset($_POST['email'], $_POST['password'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT UserID, Password FROM Users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user with the provided email exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userID, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password correct, start session and redirect to dashboard
            session_start();
            $_SESSION['user_id'] = $userID;
            $stmt->close();
            header("Location: dashboard.php");
            exit();
        } else {
            // Incorrect password
            header("Location: login.html?error=1");
            exit();
        }
    } else {
        // User not found
        header("Location: login.html?error=2");
        exit();
    }
} else {
    // Form data not set
    header("Location: login.html");
    exit();
}