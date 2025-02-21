<?php

// Function to validate email addresses
function validateEmail($email, $strict = false) {
    // Regular expression for basic email validation
    $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$/";

    // Check if the email matches the pattern
    if (!preg_match($emailPattern, $email)) {
        return ["valid" => false, "message" => "Invalid email format."];
    }

    // Strict mode check: Disallow consecutive dots in the username part
    if ($strict && preg_match("/\.\./", strstr($email, '@', true))) {
        return ["valid" => false, "message" => "Username contains consecutive dots."];
    }

    return ["valid" => true, "message" => "Valid email."];
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emails = explode("\n", trim($_POST['emails']));
    $strict = isset($_POST['strict']) ? true : false;
    $results = [];

    foreach ($emails as $email) {
        $email = trim($email);
        $validationResult = validateEmail($email, $strict);
        $results[] = [
            'email' => $email,
            'valid' => $validationResult['valid'],
            'message' => $validationResult['message']
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Validator</title>
    <style>
        .valid {
            color: green;
        }
        .invalid {
            color: red;
        }
        .message {
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<h2>Email Address Validator</h2>

<form method="POST">
    <label for="emails">Enter email addresses (one per line):</label><br>
    <textarea id="emails" name="emails" rows="10" cols="30" required></textarea><br><br>
    
    <label for="strict">Strict mode (disallow consecutive dots in username):</label>
    <input type="checkbox" id="strict" name="strict"><br><br>
    
    <input type="submit" value="Validate Emails">
</form>

<?php
if (isset($results)) {
    echo "<h3>Validation Results:</h3>";

    foreach ($results as $result) {
        $class = $result['valid'] ? 'valid' : 'invalid';
        $message = $result['valid'] ? '' : "<span class='message'>{$result['message']}</span>";
        echo "<p class='{$class}'>{$result['email']} {$message}</p>";
    }
}
?>

</body>
</html>
