<?php
/**
 * DomainManager - Quản lý và xử lý đa tên miền (Multi-domain) cho hệ thống BillDAYROI
 * Hỗ trợ nhiều tên miền: billdayroi.online, bildayroi.online, localhost/IP phát triển
 * Tự động nhận diện scheme (HTTP/HTTPS, Cloudflare proxy, reverse proxy), Base URL, và bảo vệ install.lock
 */
class DomainManager
{
    private static ?string $currentHost = null;
    private static ?string $currentDomain = null;
    private static ?string $scheme = null;
    private static ?string $baseUrl = null;
    private static ?array $allowedDomains = null;

    /**
     * Reset toàn bộ cache tĩnh (hữu ích cho testing hoặc worker)
     */
    public static function reset(): void
    {
        self::$currentHost = null;
        self::$currentDomain = null;
        self::$scheme = null;
        self::$baseUrl = null;
        self::$allowedDomains = null;
    }

    /**
     * Lấy Host của request hiện tại (đã chuẩn hoá lowercase và sanitize Host header injection)
     */
    public static function getCurrentHost(): string
    {
        if (self::$currentHost !== null) {
            return self::$currentHost;
        }

        $rawHost = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
        // Sanitize: chỉ cho phép ký tự hợp lệ [a-zA-Z0-9.:-]
        $cleanHost = strtolower(trim(preg_replace('/[^a-zA-Z0-9.:-]/', '', $rawHost)));
        if (empty($cleanHost)) {
            $cleanHost = 'localhost';
        }

        self::$currentHost = $cleanHost;
        return self::$currentHost;
    }

    /**
     * Lấy Domain/Hostname của request hiện tại (không kèm port)
     */
    public static function getCurrentDomain(): string
    {
        if (self::$currentDomain !== null) {
            return self::$currentDomain;
        }

        $host = self::getCurrentHost();
        if (strpos($host, ':') !== false) {
            $parts = explode(':', $host, 2);
            self::$currentDomain = $parts[0];
        } else {
            self::$currentDomain = $host;
        }

        return self::$currentDomain;
    }

    /**
     * Xác định giao thức (http / https)
     * Hỗ trợ Cloudflare, Reverse Proxy, Load Balancer (X-Forwarded-Proto, CF-Visitor, etc.)
     */
    public static function getScheme(): string
    {
        if (self::$scheme !== null) {
            return self::$scheme;
        }

        $isHttps = false;

        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            $isHttps = true;
        } elseif (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443) {
            $isHttps = true;
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
            $isHttps = true;
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strtolower($_SERVER['HTTP_X_FORWARDED_SSL']) === 'on') {
            $isHttps = true;
        } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            $isHttps = true;
        } elseif (!empty($_SERVER['HTTP_CF_VISITOR'])) {
            $visitor = json_decode($_SERVER['HTTP_CF_VISITOR'], true);
            if (isset($visitor['scheme']) && $visitor['scheme'] === 'https') {
                $isHttps = true;
            }
        }

        self::$scheme = $isHttps ? 'https' : 'http';
        return self::$scheme;
    }

    /**
     * Lấy URL gốc (Base URL) động theo request hiện tại
     * Ví dụ: https://billdayroi.online hoặc http://127.0.0.1:8888
     */
    public static function getBaseUrl(): string
    {
        if (self::$baseUrl !== null) {
            return self::$baseUrl;
        }

        $scheme = self::getScheme();
        $host = self::getCurrentHost();
        self::$baseUrl = $scheme . '://' . $host;
        return self::$baseUrl;
    }

    /**
     * Lấy URL đầy đủ hiện tại kèm URI
     */
    public static function getFullUrl(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        return self::getBaseUrl() . $uri;
    }

    /**
     * Lấy domain chính (Primary domain) cấu hình trong .env hoặc mặc định
     */
    public static function getPrimaryDomain(): string
    {
        $envDomain = getenv('DOMAIN');
        if (!empty($envDomain)) {
            return strtolower(trim($envDomain));
        }
        return 'billdayroi.online';
    }

    /**
     * Lấy đường dẫn Document Root an toàn
     */
    public static function getDocumentRoot(): string
    {
        if (!empty($_SERVER['DOCUMENT_ROOT'])) {
            return rtrim($_SERVER['DOCUMENT_ROOT'], '/');
        }
        return dirname(__DIR__, 2);
    }

    /**
     * Lấy danh sách các domain được cho phép (Allowed domains)
     * Kết hợp từ: .env (DOMAIN, ALLOWED_DOMAINS) + install.lock + config.ini + danh sách mặc định
     */
    public static function getAllowedDomains(): array
    {
        if (self::$allowedDomains !== null) {
            return self::$allowedDomains;
        }

        $domains = [];

        // 1. Lấy từ .env
        $envPrimary = getenv('DOMAIN');
        if (!empty($envPrimary)) {
            $domains[] = strtolower(trim($envPrimary));
        }

        $envAllowed = getenv('ALLOWED_DOMAINS');
        if (!empty($envAllowed)) {
            $parts = explode(',', $envAllowed);
            foreach ($parts as $p) {
                $p = strtolower(trim($p));
                if (!empty($p)) {
                    $domains[] = $p;
                }
            }
        }

        // 2. Lấy từ install.lock
        $docRoot = self::getDocumentRoot();
        $lockFile = $docRoot . '/install.lock';
        if (file_exists($lockFile)) {
            $lines = file($lockFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                foreach ($lines as $line) {
                    $d = strtolower(trim($line));
                    if (!empty($d) && strpos($d, '#') !== 0) {
                        $domains[] = $d;
                    }
                }
            }
        }

        // 3. Lấy từ config.ini
        $configFile = $docRoot . '/config.ini';
        if (file_exists($configFile)) {
            $ini = @parse_ini_file($configFile, true);
            if (!empty($ini['config']['domain'])) {
                $domains[] = strtolower(trim($ini['config']['domain']));
            }
            if (!empty($ini['config']['domains'])) {
                $parts = explode(',', $ini['config']['domains']);
                foreach ($parts as $p) {
                    $p = strtolower(trim($p));
                    if (!empty($p)) {
                        $domains[] = $p;
                    }
                }
            }
        }

        // 4. Danh sách domain mặc định của hệ thống
        $defaultDomains = [
            'billdayroi.online',
            'bildayroi.online',
            '127.0.0.1:8888',
            '127.0.0.1:8080',
            '127.0.0.1',
            'localhost'
        ];
        foreach ($defaultDomains as $dd) {
            $domains[] = $dd;
        }

        // Loại bỏ trùng lặp và làm sạch
        $cleanList = [];
        foreach ($domains as $d) {
            $d = strtolower(trim($d));
            if (!empty($d) && !in_array($d, $cleanList, true)) {
                $cleanList[] = $d;
            }
        }

        self::$allowedDomains = $cleanList;
        return self::$allowedDomains;
    }

    /**
     * Kiểm tra xem một host/domain có nằm trong danh sách được phép hay không
     */
    public static function isAllowedDomain(?string $host = null): bool
    {
        if ($host === null) {
            $host = self::getCurrentHost();
        }
        $host = strtolower(trim($host));
        $domainOnly = (strpos($host, ':') !== false) ? explode(':', $host, 2)[0] : $host;

        $allowed = self::getAllowedDomains();

        foreach ($allowed as $item) {
            $itemDomain = (strpos($item, ':') !== false) ? explode(':', $item, 2)[0] : $item;

            // 1. Khớp chính xác host:port hoặc domain
            if ($host === $item || $domainOnly === $itemDomain) {
                return true;
            }

            // 2. Khớp subdomain (ví dụ: sub.billdayroi.online hoặc www.billdayroi.online)
            if (str_ends_with($domainOnly, '.' . $itemDomain)) {
                return true;
            }

            // 3. Khớp ngược nếu item lưu dạng www.
            if (str_starts_with($itemDomain, 'www.') && substr($itemDomain, 4) === $domainOnly) {
                return true;
            }
        }

        return false;
    }

    /**
     * Kiểm tra dự án đã được cài đặt (Installed) hay chưa
     */
    public static function isInstalled(): bool
    {
        $docRoot = self::getDocumentRoot();
        $lockFile = $docRoot . '/install.lock';
        $dbConfig = $docRoot . '/function/connect/config.ini.php';

        if (!file_exists($dbConfig) || !file_exists($lockFile)) {
            return false;
        }

        $lines = file($lockFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false || empty($lines)) {
            return false;
        }

        return self::isAllowedDomain(self::getCurrentHost());
    }

    /**
     * Thêm an toàn một domain vào install.lock (bảo lưu các domain đã có, không ghi đè làm mất dữ liệu)
     */
    public static function addDomainToLock(string $newDomain): bool
    {
        $docRoot = self::getDocumentRoot();
        $lockFile = $docRoot . '/install.lock';

        $existing = [];
        if (file_exists($lockFile)) {
            $lines = file($lockFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                foreach ($lines as $l) {
                    $t = strtolower(trim($l));
                    if (!empty($t)) {
                        $existing[] = $t;
                    }
                }
            }
        }

        $newDomain = strtolower(trim($newDomain));
        if (!empty($newDomain) && !in_array($newDomain, $existing, true)) {
            $existing[] = $newDomain;
        }

        $content = implode("\n", array_unique($existing)) . "\n";
        $ok = (file_put_contents($lockFile, $content) !== false);
        self::$allowedDomains = null; // Reset cache
        return $ok;
    }

    /**
     * Đồng bộ file install.lock với danh sách domain chuẩn
     */
    public static function syncLockFile(?array $domains = null): bool
    {
        $docRoot = self::getDocumentRoot();
        $lockFile = $docRoot . '/install.lock';

        if ($domains === null) {
            $domains = self::getAllowedDomains();
        }

        $clean = [];
        foreach ($domains as $d) {
            $d = strtolower(trim($d));
            if (!empty($d)) {
                $clean[] = $d;
            }
        }

        $clean = array_unique($clean);
        $content = implode("\n", $clean) . "\n";
        $ok = (file_put_contents($lockFile, $content) !== false);
        self::$allowedDomains = null; // Reset cache
        return $ok;
    }
}
