<?php
// Load environment variables from .env file
$envFile = __DIR__ . '/../../.env';
if (file_exists($envFile)) {
    $envLines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        $line = trim($line);
        // Skip comments and empty lines
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }
        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

// Get configuration from environment variables
$config = [
    'server' => getenv('DB_SERVER') ?: 'localhost',
    'username' => getenv('DB_USERNAME') ?: 'billviet',
    'password' => getenv('DB_PASSWORD') ?: '',
    'database' => getenv('DB_DATABASE') ?: 'billviet',
];

// Warning if password is not set
if (empty($config['password'])) {
    error_log("WARNING: DB_PASSWORD not set in .env file!");
}
