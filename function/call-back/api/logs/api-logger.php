<?php
/**
 * API Logger - Logging utility for call-back API services
 * Tự động rotate log khi đạt kích thước giới hạn
 */

class ApiLogger
{
    private static $logsDir = null;
    private static $maxLogSize = 10 * 1024 * 1024; // 10MB
    private static $maxLogFiles = 5;
    
    public static function init($logsDir = null)
    {
        if ($logsDir) {
            self::$logsDir = rtrim($logsDir, '/') . '/';
            if (!is_dir(self::$logsDir)) {
                @mkdir(self::$logsDir, 0755, true);
            }
        } else {
            self::$logsDir = $_SERVER['DOCUMENT_ROOT'] . '/function/call-back/api/logs/';
        }
    }
    
    public static function setMaxSize($bytes)
    {
        self::$maxLogSize = $bytes;
    }
    
    public static function log($service, $message, $level = 'INFO')
    {
        if (!self::$logsDir) {
            self::init();
        }
        
        $logFile = self::$logsDir . $service . '.log';
        
        // Rotate nếu file quá lớn
        if (file_exists($logFile) && filesize($logFile) > self::$maxLogSize) {
            self::rotate($logFile);
        }
        
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] [$level] $message" . PHP_EOL;
        
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    public static function error($service, $message, $context = [])
    {
        $msg = $message;
        if (!empty($context)) {
            $msg .= ' | Context: ' . json_encode($context, JSON_UNESCAPED_UNICODE);
        }
        self::log($service, $msg, 'ERROR');
    }
    
    public static function warning($service, $message, $context = [])
    {
        $msg = $message;
        if (!empty($context)) {
            $msg .= ' | Context: ' . json_encode($context, JSON_UNESCAPED_UNICODE);
        }
        self::log($service, $msg, 'WARNING');
    }
    
    public static function info($service, $message, $context = [])
    {
        $msg = $message;
        if (!empty($context)) {
            $msg .= ' | Context: ' . json_encode($context, JSON_UNESCAPED_UNICODE);
        }
        self::log($service, $msg, 'INFO');
    }
    
    public static function debug($service, $message, $context = [])
    {
        if (!isset($_GET['debug']) && !isset($_POST['debug'])) {
            return; // Chỉ log debug khi có flag
        }
        self::log($service, $message, 'DEBUG');
    }
    
    private static function rotate($logFile)
    {
        // Xóa file cũ nhất nếu vượt quá giới hạn
        for ($i = self::$maxLogFiles - 1; $i > 0; $i--) {
            $oldFile = $logFile . '.' . $i;
            if (file_exists($oldFile)) {
                if ($i === self::$maxLogFiles - 1) {
                    @unlink($oldFile); // Xóa file cũ nhất
                } else {
                    rename($oldFile, $logFile . '.' . ($i + 1));
                }
            }
        }
        
        // Rotate file hiện tại
        if (file_exists($logFile)) {
            rename($logFile, $logFile . '.1');
        }
    }
    
    public static function clear($service)
    {
        $logFile = self::$logsDir . $service . '.log';
        if (file_exists($logFile)) {
            file_put_contents($logFile, '');
        }
    }
    
    public static function getLogSize($service)
    {
        $logFile = self::$logsDir . $service . '.log';
        if (file_exists($logFile)) {
            return filesize($logFile);
        }
        return 0;
    }
}

// Auto-init khi include
if (!defined('API_LOGGER_INIT')) {
    define('API_LOGGER_INIT', true);
    ApiLogger::init();
}