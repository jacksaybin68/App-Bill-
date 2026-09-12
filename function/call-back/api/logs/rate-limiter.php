<?php
/**
 * Rate Limiter - Giới hạn tần suất request cho các API spam
 * Sử dụng file-based storage để không phụ thuộc Redis/Memcached
 */

class RateLimiter
{
    private static $storageDir = null;
    private static $defaultMaxRequests = 100; // Mặc định 100 request
    private static $defaultWindowSeconds = 3600; // Mặc định 1 giờ
    
    public static function init($storageDir = null)
    {
        if ($storageDir) {
            self::$storageDir = rtrim($storageDir, '/') . '/';
            if (!is_dir(self::$storageDir)) {
                @mkdir(self::$storageDir, 0755, true);
            }
        } else {
            self::$storageDir = $_SERVER['DOCUMENT_ROOT'] . '/function/call-back/api/logs/rate-limit/';
        }
    }
    
    /**
     * Kiểm tra xem request có được phép không
     * @param string $key Unique key cho rate limit (ví dụ: ip_address, user_id, service_name)
     * @param int $maxRequests Số request tối đa trong window
     * @param int $windowSeconds Cỡ thời gian window (mặc định 3600s = 1 giờ)
     * @return array ['allowed' => bool, 'remaining' => int, 'reset_at' => int, 'total' => int]
     */
    public static function check($key, $maxRequests = null, $windowSeconds = null)
    {
        if (!self::$storageDir) {
            self::init();
        }
        
        $maxRequests = $maxRequests ?? self::$defaultMaxRequests;
        $windowSeconds = $windowSeconds ?? self::$defaultWindowSeconds;
        
        $now = time();
        $windowStart = $now - $windowSeconds;
        
        $storageFile = self::$storageDir . md5($key) . '.rate';
        
        // Đọc dữ liệu hiện tại
        $data = self::readData($storageFile);
        
        // Lọc các timestamp trong window hiện tại
        $timestamps = array_filter($data['timestamps'], function($ts) use ($windowStart) {
            return $ts >= $windowStart;
        });
        
        $currentCount = count($timestamps);
        $remaining = max(0, $maxRequests - $currentCount);
        
        $result = [
            'allowed' => $currentCount < $maxRequests,
            'remaining' => $remaining,
            'reset_at' => $now + $windowSeconds,
            'total' => $currentCount,
            'limit' => $maxRequests
        ];
        
        // Nếu được phép, thêm timestamp hiện tại
        if ($result['allowed']) {
            $timestamps[] = $now;
            $data['timestamps'] = $timestamps;
            self::writeData($storageFile, $data);
        }
        
        return $result;
    }
    
    /**
     * Kiểm tra và reject nếu vượt giới hạn
     * @return array ['allowed' => bool, 'message' => string, 'retry_after' => int]
     */
    public static function limit($key, $maxRequests = null, $windowSeconds = null, $retryAfterSeconds = 60)
    {
        $result = self::check($key, $maxRequests, $windowSeconds);
        
        if (!$result['allowed']) {
            $retryAfter = $result['reset_at'] - time();
            return [
                'allowed' => false,
                'message' => "Rate limit exceeded. Please try again in {$retryAfter} seconds.",
                'retry_after' => $retryAfter,
                'limit' => $result['limit'],
                'remaining' => 0
            ];
        }
        
        return [
            'allowed' => true,
            'message' => 'Request allowed',
            'retry_after' => $windowSeconds
        ];
    }
    
    /**
     * Reset rate limit cho key cụ thể
     */
    public static function reset($key)
    {
        if (!self::$storageDir) {
            self::init();
        }
        
        $storageFile = self::$storageDir . md5($key) . '.rate';
        if (file_exists($storageFile)) {
            @unlink($storageFile);
        }
    }
    
    /**
     * Lấy thống kê hiện tại
     */
    public static function stats($key)
    {
        if (!self::$storageDir) {
            self::init();
        }
        
        $storageFile = self::$storageDir . md5($key) . '.rate';
        $data = self::readData($storageFile);
        
        return [
            'total_requests' => count($data['timestamps']),
            'file_size' => file_exists($storageFile) ? filesize($storageFile) : 0
        ];
    }
    
    /**
     * Cleanup file rate limit cũ (đã hết window)
     */
    public static function cleanup($maxAgeSeconds = 86400)
    {
        if (!self::$storageDir || !is_dir(self::$storageDir)) {
            return;
        }
        
        $files = glob(self::$storageDir . '*.rate');
        $cutoff = time() - $maxAgeSeconds;
        
        foreach ($files as $file) {
            if (filemtime($file) < $cutoff) {
                @unlink($file);
            }
        }
    }
    
    /**
     * Đọc dữ liệu từ file storage
     */
    private static function readData($file)
    {
        if (!file_exists($file)) {
            return ['timestamps' => []];
        }
        
        $content = file_get_contents($file);
        if (empty($content)) {
            return ['timestamps' => []];
        }
        
        $data = json_decode($content, true);
        if (!is_array($data) || !isset($data['timestamps'])) {
            return ['timestamps' => []];
        }
        
        return $data;
    }
    
    /**
     * Ghi dữ liệu vào file storage
     */
    private static function writeData($file, $data)
    {
        $dir = dirname($file);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        
        $tmpFile = $file . '.tmp';
        file_put_contents($tmpFile, json_encode($data), LOCK_EX);
        rename($tmpFile, $file);
    }
}

// Auto-init khi include
if (!defined('RATE_LIMITER_INIT')) {
    define('RATE_LIMITER_INIT', true);
    RateLimiter::init();
}