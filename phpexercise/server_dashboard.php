<?php

// Function to sanitize user input for security
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Function to parse the User-Agent string
function parse_user_agent($user_agent) {
    // Use regular expressions to extract basic browser and OS information
    if (preg_match('/(Firefox|Chrome|Safari|Edge|Opera)\/([0-9\.]+)/', $user_agent, $matches)) {
        return "Browser: $matches[1], Version: $matches[2]";
    } elseif (preg_match('/(MSIE|Trident)\/([0-9\.]+)/', $user_agent, $matches)) {
        return "Browser: Internet Explorer, Version: $matches[2]";
    } else {
        return "Unable to parse the browser details.";
    }
}

// Get server information using the $_SERVER superglobal
$serverSoftware = sanitize_input($_SERVER['SERVER_SOFTWARE']);
$serverIpAddress = sanitize_input($_SERVER['SERVER_ADDR']);
$serverPort = sanitize_input($_SERVER['SERVER_PORT']);
$scriptName = sanitize_input($_SERVER['SCRIPT_NAME']);
$clientIpAddress = sanitize_input($_SERVER['REMOTE_ADDR']);
$userAgent = sanitize_input($_SERVER['HTTP_USER_AGENT']);

// Display server info using $_SERVER
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: #3498db;
        }
        .section ul {
            list-style-type: none;
            padding: 0;
        }
        .section li {
            padding: 5px 0;
        }
        .section .info {
            font-weight: bold;
        }
        .phpinfo {
            background-color: #e7e7e7;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Server Dashboard</h1>

        <!-- Displaying Server Information -->
        <div class="section">
            <h2>Server Information</h2>
            <ul>
                <li><span class="info">Server Software and Version:</span> <?php echo $serverSoftware; ?></li>
                <li><span class="info">Server IP Address:</span> <?php echo $serverIpAddress; ?></li>
                <li><span class="info">Server Port:</span> <?php echo $serverPort; ?></li>
                <li><span class="info">Current Script Name:</span> <?php echo $scriptName; ?></li>
                <li><span class="info">Client's IP Address:</span> <?php echo $clientIpAddress; ?></li>
                <li><span class="info">User Agent (Browser Info):</span> <?php echo parse_user_agent($userAgent); ?></li>
            </ul>
        </div>

        <!-- Displaying Environment Variables -->
        <div class="section">
            <h2>Environment Variables</h2>
            <pre><?php print_r($_ENV); ?></pre>
        </div>

        <!-- Displaying PHP Info (cautious usage in production) -->
        <div class="section phpinfo">
            <h2>PHP Configuration Information</h2>
            <p>Be cautious about using this in a production environment as it can reveal sensitive information about your server configuration.</p>
            <?php
                // Display PHP configuration information
                phpinfo(INFO_GENERAL | INFO_CONFIGURATION | INFO_MODULES);
            ?>
        </div>
    </div>

</body>
</html>
