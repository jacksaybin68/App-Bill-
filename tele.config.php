<?php
// Load environment variables from .env file
$envFile = __DIR__ . '/.env';
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
define("BOT_API", "https://api.telegram.org");
define("BOT_TOKEN", getenv('TELEGRAM_BOT_TOKEN') ?: '');
define("CHAT_ID", getenv('TELEGRAM_CHAT_ID') ?: '');

// Warning if token is not set
if (empty(BOT_TOKEN)) {
    error_log("WARNING: TELEGRAM_BOT_TOKEN not set in .env file!");
}