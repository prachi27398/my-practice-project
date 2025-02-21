<?php

// Function to parse the log file and extract log details
function parseLogFile($filename) {
    $logEntries = [];

    // Read the log file line by line
    $fileContent = file_get_contents($filename);
    $lines = explode("\n", $fileContent);
    
    // Regular expression to match the log entry format
    $pattern = '/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] \[([A-Z]+)\] \[([a-zA-Z0-9_]+)\] (.+)/';

    foreach ($lines as $line) {
        if (preg_match($pattern, $line, $matches)) {
            $logEntries[] = [
                'datetime' => $matches[1],
                'level' => $matches[2],
                'source' => $matches[3],
                'message' => $matches[4]
            ];
        }
    }
    return $logEntries;
}

// Function to count occurrences of each log level
function countLogLevels($logEntries) {
    $levelCounts = ['INFO' => 0, 'ERROR' => 0, 'WARN' => 0, 'DEBUG' => 0];
    foreach ($logEntries as $entry) {
        $levelCounts[$entry['level']]++;
    }
    return $levelCounts;
}

// Function to find log entries from a specific source
function findLogsBySource($logEntries, $source) {
    $result = [];
    foreach ($logEntries as $entry) {
        if (strtolower($entry['source']) === strtolower($source)) {
            $result[] = $entry;
        }
    }
    return $result;
}

// Function to search for log entries containing specific keywords
function searchLogsByKeyword($logEntries, $keyword) {
    $result = [];
    foreach ($logEntries as $entry) {
        if (strpos(strtolower($entry['message']), strtolower($keyword)) !== false) {
            $result[] = $entry;
        }
    }
    return $result;
}

// Handling file upload and log parsing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['logfile'])) {
    // File upload handling
    $uploadedFile = $_FILES['logfile']['tmp_name'];
    if (move_uploaded_file($uploadedFile, 'uploaded_log.txt')) {
        $logEntries = parseLogFile('uploaded_log.txt');
        $levelCounts = countLogLevels($logEntries);
    } else {
        echo "Error uploading file.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Analyzer</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .result {
            margin-top: 20px;
        }
        .info {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2>Log Analyzer</h2>

<form method="POST" enctype="multipart/form-data">
    <label for="logfile">Upload a log file:</label>
    <input type="file" name="logfile" id="logfile" accept=".txt" required><br><br>
    <input type="submit" value="Upload and Analyze">
</form>

<?php if (isset($logEntries)): ?>
    <div class="result">
        <h3>Log Level Summary</h3>
        <table>
            <tr>
                <th>Log Level</th>
                <th>Occurrences</th>
            </tr>
            <?php foreach ($levelCounts as $level => $count): ?>
                <tr>
                    <td><?php echo $level; ?></td>
                    <td><?php echo $count; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Log Entries</h3>
        <table>
            <tr>
                <th>Date & Time</th>
                <th>Log Level</th>
                <th>Source</th>
                <th>Message</th>
            </tr>
            <?php foreach ($logEntries as $entry): ?>
                <tr>
                    <td><?php echo $entry['datetime']; ?></td>
                    <td><?php echo $entry['level']; ?></td>
                    <td><?php echo $entry['source']; ?></td>
                    <td><?php echo $entry['message']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>

<hr>

<h3>Filter Logs</h3>
<form method="GET">
    <label for="source">Source:</label>
    <input type="text" name="source" id="source"><br><br>
    <label for="keyword">Keyword:</label>
    <input type="text" name="keyword" id="keyword"><br><br>
    <input type="submit" value="Filter Logs">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($logEntries)) {
    if (isset($_GET['source']) && $_GET['source'] != '') {
        $filteredLogs = findLogsBySource($logEntries, $_GET['source']);
        echo "<h3>Logs from Source: " . htmlspecialchars($_GET['source']) . "</h3>";
        displayLogs($filteredLogs);
    }

    if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
        $filteredLogs = searchLogsByKeyword($logEntries, $_GET['keyword']);
        echo "<h3>Logs containing Keyword: " . htmlspecialchars($_GET['keyword']) . "</h3>";
        displayLogs($filteredLogs);
    }
}

function displayLogs($logs) {
    if (empty($logs)) {
        echo "<p>No logs found matching the criteria.</p>";
    } else {
        echo "<table>";
        echo "<tr><th>Date & Time</th><th>Log Level</th><th>Source</th><th>Message</th></tr>";
        foreach ($logs as $entry) {
            echo "<tr>";
            echo "<td>{$entry['datetime']}</td>";
            echo "<td>{$entry['level']}</td>";
            echo "<td>{$entry['source']}</td>";
            echo "<td>{$entry['message']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>

</body>
</html>
