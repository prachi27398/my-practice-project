<?php

// Starting a session to demonstrate $_SESSION
session_start();

// Set a default message for displaying user name from session (if available)
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';

// Error handling function for sanitizing inputs
function sanitize_input($data) {
    return htmlspecialchars(trim($data)); // Remove unnecessary spaces and convert special characters to HTML entities
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superglobals Explorer</title>
</head>
<body>

    <h1>PHP Superglobals Explorer</h1>

    <!-- Displaying $_SERVER superglobal -->
    <h2>1. $_SERVER Information</h2>
    <ul>
        <li><strong>Server Software:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
        <li><strong>Request Method:</strong> <?php echo $_SERVER['REQUEST_METHOD']; ?></li>
        <li><strong>Client IP Address:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
        <li><strong>Request URI:</strong> <?php echo $_SERVER['REQUEST_URI']; ?></li>
    </ul>

    <!-- Displaying $_REQUEST superglobal -->
    <h2>2. $_REQUEST Information</h2>
    <p>When you submit the form below, the data will be captured using $_REQUEST.</p>

    <form action="superglobals_explorer.php" method="get">
        <label for="name">Enter your name (GET):</label>
        <input type="text" id="name" name="name">
        <input type="submit" value="Submit with GET">
    </form>

    <form action="superglobals_explorer.php" method="post">
        <label for="age">Enter your age (POST):</label>
        <input type="text" id="age" name="age">
        <input type="submit" value="Submit with POST">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['name'])) {
        // Demonstrating GET input using $_REQUEST
        $name = sanitize_input($_GET['name']);
        echo "<p>GET Request: Hello, $name! This is data from GET.</p>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['age'])) {
        // Demonstrating POST input using $_REQUEST
        $age = sanitize_input($_POST['age']);
        echo "<p>POST Request: You entered age $age. This is data from POST.</p>";
    }
    ?>

    <!-- Displaying $_POST superglobal -->
    <h2>3. $_POST Information</h2>
    <p>When you use the POST method, data is sent through the body of the request.</p>
    <pre><?php print_r($_POST); ?></pre>

    <!-- Displaying $_GET superglobal -->
    <h2>4. $_GET Information</h2>
    <p>Data sent via the GET method is visible in the URL query string.</p>
    <pre><?php print_r($_GET); ?></pre>

    <!-- Demonstrating $_SESSION superglobal -->
    <h2>5. $_SESSION Information</h2>
    <p>Session: Welcome, <?php echo $userName; ?>!</p>
    
    <!-- Set session with user input -->
    <form action="superglobals_explorer.php" method="post">
        <label for="username">Enter your name to save in session:</label>
        <input type="text" id="username" name="username">
        <input type="submit" value="Set Session Name">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
        // Save username into session
        $_SESSION['user_name'] = sanitize_input($_POST['username']);
        echo "<p>Session updated! Welcome, " . $_SESSION['user_name'] . ".</p>";
    }
    ?>

    <!-- Demonstrating $_COOKIE superglobal -->
    <h2>6. $_COOKIE Information</h2>
    <p>Creating and retrieving cookies:</p>

    <form action="superglobals_explorer.php" method="post">
        <label for="cookie_name">Enter a name for your cookie:</label>
        <input type="text" id="cookie_name" name="cookie_name">
        <input type="submit" value="Set Cookie">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cookie_name'])) {
        // Set cookie
        $cookieName = sanitize_input($_POST['cookie_name']);
        setcookie('user_cookie', $cookieName, time() + 3600); // Expires in 1 hour
        echo "<p>Cookie set! You can retrieve it below.</p>";
    }

    if (isset($_COOKIE['user_cookie'])) {
        // Display cookie value if available
        echo "<p>Cookie: Welcome back, " . $_COOKIE['user_cookie'] . "!</p>";
    }
    ?>

    <!-- Security Tip: Input sanitization (XSS prevention) and cookie security -->
    <h2>7. Security Considerations</h2>
    <p>Always sanitize user inputs using htmlspecialchars() to prevent XSS attacks.</p>
    <p>For cookies, always set the 'Secure' and 'HttpOnly' flags to ensure security:</p>
    <pre>
    setcookie('user_cookie', $cookieName, time() + 3600, '', '', true, true); // Secure and HttpOnly
    </pre>

</body>
</html>
