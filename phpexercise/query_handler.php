<?php

// Function to sanitize user inputs
function sanitize_input($data) {
    return htmlspecialchars(trim($data)); // Sanitize input to prevent XSS attacks
}

// Retrieve query parameters from the URL using $_GET
$queryParameters = $_GET;

// Error handling: Check if query parameters exist
if (empty($queryParameters)) {
    echo "<h2>No query parameters provided.</h2>";
} else {
    echo "<h2>Query Parameters:</h2>";
    echo "<ul>";
    // Iterate through each query parameter and display its name and value
    foreach ($queryParameters as $key => $value) {
        // Sanitize both key and value before displaying
        $sanitizedKey = sanitize_input($key);
        $sanitizedValue = sanitize_input($value);
        echo "<li><strong>$sanitizedKey</strong>: $sanitizedValue</li>";
    }
    echo "</ul>";
}
 
?>
         