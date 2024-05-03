<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        a {
            display: block;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="NSUT_logo.png" alt="College Logo">
    </div>
    <div class="container">
        <h2>View Events</h2>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Society</th>
            </tr>
            <?php
            // Include the database configuration file
            include_once "db_config.php";

            // Fetch events data from the database
            $sql = "SELECT e.Name, e.Date, s.Name AS SocietyName FROM Events e INNER JOIN Societies s ON e.SocietyID = s.SocietyID";
            $result = $conn->query($sql);

            // Check if query executed successfully
            if ($result && $result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["Date"] . "</td>";
                    echo "<td>" . $row["SocietyName"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No events found.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
