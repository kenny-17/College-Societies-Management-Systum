<?php
// Include the database configuration file if needed
// include_once "db_config.php";

// You can fetch resources from the database if you have them stored there

// Sample array of public resources
$publicResources = array(
    array("title" => "Presentation Slides", "link" => "presentation_slides.pdf"),
    array("title" => "Code Examples", "link" => "code_examples.zip"),
    array("title" => "Useful Links", "link" => "useful_links.txt"),
    // Add more resources as needed
);

// You can also fetch resources from a database table if you have one
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Resources</title>
    <!-- Add your CSS styles here -->
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
            text-align: center;
        }
        h2 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Public Resources</h2>
    <ul>
        <?php foreach ($publicResources as $resource): ?>
            <li><a href="<?php echo $resource['link']; ?>" target="_blank"><?php echo $resource['title']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
