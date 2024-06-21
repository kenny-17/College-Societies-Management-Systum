<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <!-- Add your CSS styles here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Create Event</h2>
    <form action="create_event_process.php" method="post">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" required><br>
        
        <label for="eventDate">Event Date:</label>
        <input type="date" id="eventDate" name="eventDate" required><br>
        
        <label for="eventTime">Event Time:</label>
        <input type="time" id="eventTime" name="eventTime" required><br>
        
        <label for="eventDescription">Event Description:</label><br>
        <textarea id="eventDescription" name="eventDescription" rows="4" cols="50" required></textarea><br>
        
        <input type="submit" value="Create Event">
    </form>
</div>

</body>
</html>
