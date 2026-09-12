<?php
class CallbackAuth extends DatabaseConnection
{
    public static function validate(): void
    {
        $token = $_SERVER['HTTP_X_CALLBACK_TOKEN'] ?? $_GET['callback_token'] ?? '';
        $expected = self::getToken();

        if (empty($token) || !hash_equals($expected, $token)) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo JSON_FORMATTER([
                'status' => -1,
                'msg' => 'Forbidden: Invalid callback token'
            ]);
            exit;
        }
    }

    public static function getToken(): string
    {
        $token = getenv('CALLBACK_TOKEN');
        if (!empty($token)) {
            return $token;
        }

        $serverAddr = $_SERVER['SERVER_ADDR'] ?? '127.0.0.1';
        $salt = getenv('CALLBACK_TOKEN_SALT') ?: '';
        return hash('sha256', $serverAddr . $salt);
    }
}
