<?php

// Function to sanitize inputs for security
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Handle form submission
$matches = [];
$numMatches = 0;
$error = null;
$sampleText = '';
$regex = '';
$modifiers = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $sampleText = isset($_POST['sample_text']) ? sanitize_input($_POST['sample_text']) : '';
    $regex = isset($_POST['regex']) ? sanitize_input($_POST['regex']) : '';
    $modifiers = isset($_POST['modifiers']) ? sanitize_input($_POST['modifiers']) : '';

    // Try to find all matches using preg_match_all
    try {
        // Validate the regular expression using preg_match
        if (@preg_match($regex, '') === false) {
            throw new Exception('Invalid regular expression');
        }

        // Find all matches
        $pattern = "/$regex/$modifiers"; // Construct the pattern with modifiers
        preg_match_all($pattern, $sampleText, $matches, PREG_OFFSET_CAPTURE);

        // Count the matches
        $numMatches = count($matches[0]); // The first element contains the full matches
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Common regex patterns explanations
$regex_explanations = [
    "/^abc/" => "Matches text that starts with 'abc'.",
    "/abc$/" => "Matches text that ends with 'abc'.",
    "/a.b/" => "Matches 'a', followed by any character, and then 'b'.",
    "/a(b|c)d/" => "Matches 'ad' or 'acd'.",
    "/\\d+/" => "Matches one or more digits.",
    "/\\w+/" => "Matches one or more word characters (letters, numbers, and underscores).",
    "/\\s+/" => "Matches one or more whitespace characters."
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regex Matcher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
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
        textarea, input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error {
            color: red;
        }
        .results {
            background-color: #e7e7e7;
            padding: 10px;
            border-radius: 5px;
        }
        pre {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 5px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Regex Matcher</h1>

        <!-- Display error message if any -->
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Form for user input -->
        <form action="regex_matcher.php" method="POST">
            <div class="section">
                <label for="sample_text">Sample Text:</label>
                <textarea name="sample_text" id="sample_text" rows="6"><?php echo $sampleText; ?></textarea>
            </div>

            <div class="section">
                <label for="regex">Regular Expression:</label>
                <input type="text" name="regex" id="regex" value="<?php echo $regex; ?>" />
            </div>

            <div class="section">
                <label for="modifiers">Modifiers:</label>
                <select name="modifiers" id="modifiers">
                    <option value="">None</option>
                    <option value="i" <?php if ($modifiers === 'i') echo 'selected'; ?>>i (case-insensitive)</option>
                    <option value="m" <?php if ($modifiers === 'm') echo 'selected'; ?>>m (multiline)</option>
                    <option value="s" <?php if ($modifiers === 's') echo 'selected'; ?>>s (dot matches newline)</option>
                    <option value="u" <?php if ($modifiers === 'u') echo 'selected'; ?>>u (unicode)</option>
                </select>
            </div>

            <button type="submit">Submit</button>
        </form>

        <!-- Display match results -->
        <?php if ($numMatches > 0): ?>
            <div class="section results">
                <h2>Results</h2>
                <p><strong><?php echo $numMatches; ?> match(es) found:</strong></p>
                <ul>
                    <?php foreach ($matches[0] as $index => $match): ?>
                        <li>
                            <strong>Match <?php echo $index + 1; ?>:</strong> 
                            <?php echo $match[0]; ?> 
                            <em>(Position: <?php echo $match[1]; ?>)</em>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Display regex pattern explanations -->
        <div class="section">
            <h2>Common Regex Patterns</h2>
            <ul>
                <?php foreach ($regex_explanations as $pattern => $explanation): ?>
                    <li><strong><?php echo $pattern; ?>:</strong> <?php echo $explanation; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</body>
</html>
 