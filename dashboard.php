<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.html");
    exit();
}

// Include the database configuration file
include_once "db_config.php";

// Retrieve user's information from the Users table based on user ID
$userID = $_SESSION["user_id"];
$sql_user = "SELECT Name, Email FROM Users WHERE UserID = $userID";
$result_user = $conn->query($sql_user);

// Check if user information is retrieved successfully
if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
    $userName = $row_user["Name"];
    $userEmail = $row_user["Email"];
} else {
    // User information not found, use default values
    $userName = "User";
    $userEmail = "user@example.com";
}

// Check if the user is a president
$sql_president = "SELECT * FROM Presidents WHERE UserID = $userID";
$result_president = $conn->query($sql_president);
$isPresident = $result_president->num_rows > 0;

// Check if the user is a member
$sql_membership = "SELECT s.Name FROM Memberships m INNER JOIN Societies s ON m.SocietyID = s.SocietyID WHERE m.UserID = $userID";
$result_membership = $conn->query($sql_membership);
$isMember = $result_membership->num_rows > 0;

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Inline CSS styles -->
    <style>
        /* Reset default margin and padding */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100%;
            background-color: lavender; /* Lavender color */
        }

        /* Apply blur effect to background image */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('background.jpg'); /* Replace 'background.jpg' with your image path */
            background-size: cover;
            background-position: center;
            filter: blur(8px); /* Adjust blur intensity as needed */
            z-index: -1;
        }

        /* Container styles */
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Shadow effect */
            z-index: 1;
            position: relative;
        }

        /* Navbar styles */
        .navbar {
            overflow: hidden;
            background-color: #6a5acd; /* Lavender color */
            border-bottom: 2px solid #483d8b; /* Dark lavender color */
        }

        .navbar a {
            float: left;
            display: block;
            color: #fff; /* White color */
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s; /* Smooth transition effect */
        }

        .navbar a:hover {
            background-color: #483d8b; /* Dark lavender color */
        }

        .navbar a:last-child {
            float: right;
        }

        /* Welcome message styles */
        .welcome-message {
            text-align: center;
            margin-top: 20px;
        }

        .welcome-message h2 {
            color: #6a5acd; /* Lavender color */
        }

        /* User info styles */
        .user-info {
            margin-top: 20px;
            padding: 10px;
            background-color: #f0f8ff; /* Alice blue */
            border-radius: 5px;
        }

        .user-info p {
            color: #6a5acd; /* Lavender color */
            margin: 0;
        }

        /* Functionalities styles */
        .functionalities {
            margin-top: 20px;
        }

        .functionalities h3 {
            color: #6a5acd; /* Lavender color */
            margin-bottom: 10px;
        }

        .functionalities ul {
            list-style-type: none;
            padding: 0;
        }

        .functionalities li {
            margin-bottom: 5px;
        }

        .functionalities a {
            display: inline-block;
            background-color: #6a5acd; /* Lavender color */
            color: #fff; /* White color */
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s; /* Smooth transition effect */
        }

        .functionalities a:hover {
            background-color: #483d8b; /* Dark lavender color */
        }

        /* Logout styles */
        .logout {
            text-align: center;
            margin-top: 20px;
        }

        .logout a {
            color: #6a5acd; /* Lavender color */
            text-decoration: none;
            font-weight: bold;
        }

        .logout a:hover {
            color: #483d8b; /* Dark lavender color */
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Home</a>
    <?php if ($isPresident): ?>
        <a href="create_event.php">Create Event</a>
        <a href="add_members.php">Add Members</a>
        <a href="open_auditions.php">Open Auditions</a>
    <?php endif; ?>
    <?php if ($isMember && !$isPresident): ?>
        <a href="my_societies.php">My Societies</a>
    <?php endif; ?>
    <a href="view_events.php">View Events</a>
    <a href="search_events.php">Search Events</a>
    <a href="public_resources.php">Public Resources</a>
    <a href="logout.php" style="float:right">Logout</a>
</div>

<div class="container">
    <div class="welcome-message">
        <h2>Welcome, <?php echo $userName; ?>!</h2>
    </div>

    <div class="user-info">
        <p><strong>Email:</strong> <?php echo $userEmail; ?></p>
    </div>

    <?php if ($isPresident): ?>
        <div class="functionalities">
            <h3>President Functionalities:</h3>
            <ul>
                <li><a href="create_event.php">Create Event</a></li>
                <li><a href="add_members.php">Add Members</a></li>
                <li><a href="open_auditions.php">Open Auditions</a></li>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($isMember && !$isPresident): ?>
        <div class="functionalities">
            <h3>Member Functionalities:</h3>
            <ul>
                <li><a href="my_societies.php">My Societies</a></li>
            </ul>
        </div>
    <?php endif; ?>

    <div class="functionalities">
        <h3>Event Functionalities:</h3>
        <ul>
            <li><a href="view_events.php">View Events</a></li>
            <li><a href="search_events.php">Search Events</a></li>
        </ul>
    </div>

    <div class="functionalities">
        <h3>Public Resources:</h3>
        <ul>
            <li><a href="public_resources.php">View Resources</a></li>
        </ul>
    </div>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
