<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Members</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        select,
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
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

    // Retrieve the list of societies
    $userID = $_SESSION["user_id"];
    $sql = "SELECT s.SocietyID, s.Name FROM Societies s JOIN Presidents p ON s.SocietyID = p.SocietyID WHERE p.UserID = $userID";
    $result = $conn->query($sql);

    // Check if societies are retrieved successfully
    if ($result->num_rows > 0) {
        // Display the form to add members
        echo "<h2>Add Members</h2>";
        echo "<form action='add_members_process.php' method='post'>";
        echo "<label for='society'>Select Society:</label>";
        echo "<select name='society' id='society'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["SocietyID"] . "'>" . $row["Name"] . "</option>";
        }
        echo "</select><br>";
        echo "<label for='email'>Email of User to Add:</label>";
        echo "<input type='email' id='email' name='email' required><br>";
        echo "<input type='submit' value='Add Member'>";
        echo "</form>";
    } else {
        echo "You are not the president of any society.";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

</body>
</html>
