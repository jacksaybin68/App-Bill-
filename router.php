<?php
/**
 * Router script for PHP built-in server
 * Parses .htaccess RewriteRule directives for development
 */

// Set DOCUMENT_ROOT if not set
if (empty($_SERVER['DOCUMENT_ROOT'])) {
    $_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__);
}

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$uri = rtrim($uri, '/');
if ($uri === '') {
    $uri = '/';
}

/**
 * Parse .htaccess RewriteRule lines into pattern => target mapping
 */
function parseHtaccessRules($htaccessPath) {
    $rules = [];
    if (!file_exists($htaccessPath)) {
        return $rules;
    }
    
    $lines = file($htaccessPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $skipNext = false;
    foreach ($lines as $line) {
        $line = trim($line);
        
        // Skip comments and meta-directives
        if (strpos($line, '#') === 0 || strpos($line, '<IfModule') === 0 || 
            strpos($line, '</IfModule') === 0 || strpos($line, '<FilesMatch') === 0 ||
            strpos($line, 'Order') === 0 || strpos($line, 'Deny') === 0) {
            continue;
        }
        
        // Skip RewriteCond lines (we don't process conditions in dev)
        if (strpos($line, 'RewriteCond') === 0) {
            continue;
        }
        
        // Parse RewriteRule ^pattern$ target [flags]
        if (preg_match('/^RewriteRule\s+(\S+)\s+(\S+)(?:\s+\[.*\])?\s*$/', $line, $matches)) {
            $pattern = $matches[1];
            $target = $matches[2];
            
            // Skip no-op rules (target is '-')
            if ($target === '-') {
                continue;
            }
            
            // Skip ErrorDocument-like rules
            if (strpos($line, 'ErrorDocument') === 0) {
                continue;
            }
            
            $rules[] = ['pattern' => $pattern, 'target' => $target];
        }
    }
    return $rules;
}

$rules = parseHtaccessRules(__DIR__ . '/.htaccess');

$script = null;

// Apache .htaccess patterns match the URI without the leading slash (per-directory context)
$matchPath = ltrim($uri, '/');

foreach ($rules as $rule) {
    $pattern = $rule['pattern'];
    $target = $rule['target'];
    
    // Build regex from pattern directly (pattern is already a valid regex for RewriteRule)
    $regex = '#' . $pattern . '#';
    
    // Ensure anchored if pattern lacks anchors
    if (strpos($pattern, '^') === false && strpos($pattern, '$') === false) {
        $regex = '#^' . $pattern . '$#';
    }
    
    if (preg_match($regex, $matchPath, $matches)) {
        // Resolve backreferences ($1, $2, etc.) in target
        $resolvedTarget = $target;
        if (preg_match_all('/\$(\d+)/', $target, $backrefs)) {
            foreach ($backrefs[1] as $i => $num) {
                $val = $matches[$num] ?? '';
                $resolvedTarget = str_replace("\${$num}", $val, $resolvedTarget);
            }
        }
        
        $script = __DIR__ . '/' . $resolvedTarget;
        
        // Handle query parameters from rewrite target (e.g., ?page=$1)
        if (strpos($resolvedTarget, '?') !== false) {
            $parts = explode('?', $resolvedTarget, 2);
            $script = __DIR__ . '/' . $parts[0];
            parse_str($parts[1], $_GET);
        }
        
        break;
    }
}

// Serve static files directly if they exist and no script matched
if (!$script && file_exists(__DIR__ . $uri) && is_file(__DIR__ . $uri)) {
    return false;
}

// Redirect root to dash.php
if ($uri === '/' || $uri === '' || $uri === '/index.php') {
    header('Location: /dash.php');
    exit;
}

// Execute matched script
if ($script && file_exists($script)) {
    $_SERVER['SCRIPT_FILENAME'] = $script;
    $_SERVER['SCRIPT_NAME'] = str_replace(__DIR__, '', $script);
    $_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'];
    
    require $script;
    exit;
}

// Silence favicon.ico 404 noise (project ships no favicon)
if ($uri === '/favicon.ico') {
    http_response_code(204);
    exit;
}

// 404
http_response_code(404);
echo '404 Not Found';
