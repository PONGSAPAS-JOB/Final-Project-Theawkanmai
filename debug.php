<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Debug Log</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Debug Log</h1>
    <?php
    $log_file = 'debug_log.txt';
    if (file_exists($log_file)) {
        $log_content = file_get_contents($log_file);
        echo '<pre>' . htmlspecialchars($log_content) . '</pre>';
    } else {
        echo '<p>No log file found.</p>';
    }
    ?>
</body>

</html>