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

// Retrieve the list of societies the user is president of
$userID = $_SESSION["user_id"];
$sql_societies = "SELECT s.SocietyID, s.Name FROM Presidents p INNER JOIN Societies s ON p.SocietyID = s.SocietyID WHERE p.UserID = $userID";
$result_societies = $conn->query($sql_societies);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Auditions</title>
    <!-- Add your CSS styles here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Open Auditions</h2>
    <form action="open_auditions_process.php" method="post">
        <label for="society">Select Society:</label>
        <select name="society" id="society">
            <?php while ($row = $result_societies->fetch_assoc()): ?>
                <option value="<?php echo $row['SocietyID']; ?>"><?php echo $row['Name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <label for="date">Audition Date:</label>
        <input type="date" id="date" name="date" required><br>
        <label for="time">Audition Time:</label>
        <input type="time" id="time" name="time" required><br>
        <label for="venue">Audition Venue:</label>
        <input type="text" id="venue" name="venue" required><br>
        <input type="submit" value="Open Auditions">
    </form>
</div>

</body>
</html>
