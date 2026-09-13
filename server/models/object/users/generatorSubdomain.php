<?php
/**
 * GeneratorSubdomain - Quản lý tạo/xóa/chỉnh sửa subdomain qua Cloudflare API
 * Hỗ trợ đa zone (nhiều tên miền gốc)
 */

// Load cấu hình từ database
require_once __DIR__ . '/../../../../config/database.php';

$set_email = '';
$set_auth_key = '';
$list_zone_ids = [];

/**
 * Lấy cấu hình Cloudflare từ database hoặc config
 */
function loadCloudflareConfig(): array
{
    global $set_email, $set_auth_key, $list_zone_ids;

    // Thử lấy từ database settings
    try {
        $conn = DatabaseConnection::ThanhDieuDB();
        $stmt = $conn->prepare("SELECT setting_name, setting_value FROM ws_settings WHERE setting_name IN ('cf_email', 'cf_api_key', 'cf_zone_ids')");
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $val = $row['setting_value'];
            if ($row['setting_name'] === 'cf_email') {
                $set_email = $val;
            } elseif ($row['setting_name'] === 'cf_api_key') {
                $set_auth_key = $val;
            } elseif ($row['setting_name'] === 'cf_zone_ids') {
                $decoded = json_decode($val, true);
                if (is_array($decoded)) {
                    $list_zone_ids = $decoded;
                }
            }
        }
    } catch (\Exception $e) {
        // Fallback: dùng giá trị mặc định từ file cấu hình
    }

    // Fallback mặc định nếu chưa có trong DB
    if (empty($set_email) || empty($set_auth_key)) {
        // Đọc từ file cấu hình toàn cục nếu có
        $configFile = __DIR__ . '/../../../../config/cloudflare.php';
        if (file_exists($configFile)) {
            $config = include $configFile;
            if (isset($config['email'])) $set_email = $config['email'];
            if (isset($config['api_key'])) $set_auth_key = $config['api_key'];
            if (isset($config['zone_ids']) && is_array($config['zone_ids'])) {
                $list_zone_ids = array_merge($list_zone_ids, $config['zone_ids']);
            }
        }
    }

    return [
        'email' => $set_email,
        'api_key' => $set_auth_key,
        'zone_ids' => $list_zone_ids
    ];
}

/**
 * Lấy Zone ID cho một subdomain
 * Tự động xác định zone dựa trên phần đuôi domain
 */
function ZoneId(string $subdomain): ?string
{
    global $list_zone_ids;

    if (empty($list_zone_ids)) {
        loadCloudflareConfig();
    }

    $parts = explode('.', $subdomain);
    if (count($parts) < 2) {
        return null;
    }

    // Lấy phần đuôi (VD: sub.billdayroi.online → billdayroi.online)
    $suffix = implode('.', array_slice($parts, -2));

    // Tìm zone ID trực tiếp
    if (isset($list_zone_ids[$suffix])) {
        return $list_zone_ids[$suffix];
    }

    // Nếu không tìm thấy, thử tìm theo pattern (VD: *.billdayroi.online)
    foreach ($list_zone_ids as $zoneDomain => $zoneId) {
        if (str_ends_with($subdomain, '.' . $zoneDomain)) {
            return $zoneId;
        }
    }

    // Thử gọi API Cloudflare để tìm zone bằng tên miền
    if (!empty($set_email) && !empty($set_auth_key)) {
        try {
            $CFAPI = new \Cloudflare\Api($set_email, $set_auth_key);
            $CFZones = new \Cloudflare\Zone($CFAPI);
            $zones = $CFZones->list_zones(null, null, $suffix);
            $zones = json_decode(json_encode($zones), true);

            if (isset($zones['success']) && $zones['success'] && !empty($zones['result'])) {
                foreach ($zones['result'] as $zone) {
                    if ($zone['name'] === $suffix || str_ends_with($subdomain, '.' . $zone['name'])) {
                        // Lưu lại vào cache list_zone_ids
                        $list_zone_ids[$suffix] = $zone['id'];
                        return $zone['id'];
                    }
                }
            }
        } catch (\Exception $e) {
            // Fall through
        }
    }

    return null;
}

/**
 * Tạo subdomain mới trên Cloudflare
 */
function create(string $subdomain, string $recordType, string $serversIp, ?int $ttl = null, bool $proxied = true): array
{
    $config = loadCloudflareConfig();

    if (empty($config['email']) || empty($config['api_key'])) {
        return [
            'success' => false,
            'errors' => [['code' => 401, 'message' => 'Chưa cấu hình Cloudflare API']]
        ];
    }

    $zoneId = ZoneId($subdomain);
    if (!$zoneId) {
        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'Không tìm thấy Zone ID cho subdomain: ' . $subdomain]]
        ];
    }

    try {
        $CFAPI = new \Cloudflare\Api($config['email'], $config['api_key']);
        $CFDNS = new \Cloudflare\Zone\Dns($CFAPI);

        // Kiểm tra record đã tồn tại chưa
        $records = $CFDNS->list_records($zoneId, $recordType, $subdomain);
        $records = json_decode(json_encode($records), true);

        if (isset($records['success']) && $records['success'] && !empty($records['result'])) {
            return [
                'success' => false,
                'errors' => [
                    [
                        'code' => 1001,
                        'message' => 'Record đã tồn tại cho subdomain: ' . $subdomain
                    ]
                ]
            ];
        }

        $response = $CFDNS->create($zoneId, $recordType, $subdomain, $serversIp, $ttl, $proxied);
        $response = json_decode(json_encode($response), true);

        if (isset($response['success']) && $response['success']) {
            return [
                'success' => true,
                'message' => 'Subdomain created successfully.',
                'record' => $response['result'] ?? []
            ];
        } else {
            return [
                'success' => false,
                'errors' => isset($response['errors']) ? $response['errors'] : [['code' => 500, 'message' => 'Lỗi không xác định']]
            ];
        }
    } catch (\Exception $e) {
        return [
            'success' => false,
            'errors' => [['code' => 500, 'message' => 'Exception: ' . $e->getMessage()]]
        ];
    }
}

/**
 * Xóa subdomain từ Cloudflare
 */
function deleter(string $subdomain, ?string $recordType = null): array
{
    $config = loadCloudflareConfig();

    if (empty($config['email']) || empty($config['api_key'])) {
        return [
            'success' => false,
            'errors' => [['code' => 401, 'message' => 'Chưa cấu hình Cloudflare API']]
        ];
    }

    $zoneId = ZoneId($subdomain);
    if (!$zoneId) {
        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'Không tìm thấy Zone ID']]
        ];
    }

    try {
        $CFAPI = new \Cloudflare\Api($config['email'], $config['api_key']);
        $CFDNS = new \Cloudflare\Zone\Dns($CFAPI);

        $records = $CFDNS->list_records($zoneId, $recordType, $subdomain);
        $records = json_decode(json_encode($records), true);

        if (!isset($records['success']) || !$records['success'] || empty($records['result'])) {
            return [
                'success' => false,
                'errors' => [['code' => 404, 'message' => 'Không tìm thấy record cho subdomain']]
            ];
        }

        $deleted = 0;
        $errors = [];

        foreach ($records['result'] as $record) {
            // Nếu có recordType, chỉ xóa record cùng loại
            if ($recordType && strcasecmp($record['type'], $recordType) !== 0) {
                continue;
            }

            $delete = $CFDNS->delete_record($zoneId, $record['id']);
            $delete = json_decode(json_encode($delete), true);

            if (isset($delete['success']) && $delete['success']) {
                $deleted++;
            } else {
                $errors[] = [
                    'record_id' => $record['id'],
                    'message' => isset($delete['errors']) ? ($delete['errors'][0]['message'] ?? 'Unknown') : 'Unknown error'
                ];
            }
        }

        if ($deleted > 0 && empty($errors)) {
            return [
                'success' => true,
                'message' => 'Đã xóa ' . $deleted . ' record(s) thành công.',
                'deleted_count' => $deleted
            ];
        }

        return [
            'success' => false,
            'errors' => $errors,
            'deleted_count' => $deleted
        ];
    } catch (\Exception $e) {
        return [
            'success' => false,
            'errors' => [['code' => 500, 'message' => 'Exception: ' . $e->getMessage()]]
        ];
    }
}

/**
 * Chỉnh sửa record subdomain (thay đổi IP/content)
 */
function edit(string $subdomain, string $newIp, string $recordType = 'A'): array
{
    $config = loadCloudflareConfig();

    if (empty($config['email']) || empty($config['api_key'])) {
        return [
            'success' => false,
            'errors' => [['code' => 401, 'message' => 'Chưa cấu hình Cloudflare API']]
        ];
    }

    $zoneId = ZoneId($subdomain);
    if (!$zoneId) {
        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'Không tìm thấy Zone ID']]
        ];
    }

    try {
        $CFAPI = new \Cloudflare\Api($config['email'], $config['api_key']);
        $CFDNS = new \Cloudflare\Zone\Dns($CFAPI);

        $records = $CFDNS->list_records($zoneId, $recordType, $subdomain);
        $records = json_decode(json_encode($records), true);

        if (!isset($records['success']) || !$records['success'] || empty($records['result'])) {
            return [
                'success' => false,
                'errors' => [['code' => 404, 'message' => 'Không tìm thấy record']]
            ];
        }

        foreach ($records['result'] as $record) {
            if (strcasecmp($record['name'], $subdomain) === 0) {
                $update = $CFDNS->update(
                    $zoneId,
                    $record['id'],
                    $recordType,
                    $subdomain,
                    $newIp,
                    null,
                    true
                );
                $update = json_decode(json_encode($update), true);

                if (isset($update['success']) && $update['success']) {
                    return [
                        'success' => true,
                        'message' => 'Subdomain updated successfully.',
                        'record' => $update['result'] ?? []
                    ];
                } else {
                    return [
                        'success' => false,
                        'errors' => isset($update['errors']) ? $update['errors'] : [['code' => 500, 'message' => 'Lỗi cập nhật']]
                    ];
                }
            }
        }

        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'Không tìm thấy record phù hợp']]
        ];
    } catch (\Exception $e) {
        return [
            'success' => false,
            'errors' => [['code' => 500, 'message' => 'Exception: ' . $e->getMessage()]]
        ];
    }
}

// Xử lý CLI
if (php_sapi_name() === 'cli') {
    if (!isset($argv[1]) || empty($argv[1])) {
        die("THANHDIEU(" . json_encode(['status' => 403, 'msg' => '403 Forbidden.']) . ")");
    }

    $action = $argv[1];
    $config = loadCloudflareConfig();

    switch ($action) {
        case 'list-zones':
            if (empty($config['email']) || empty($config['api_key'])) {
                die("THANHDIEU(" . json_encode(['status' => -1, 'msg' => 'Chưa cấu hình Cloudflare']) . ")");
            }
            try {
                $CFAPI = new \Cloudflare\Api($config['email'], $config['api_key']);
                $CFZones = new \Cloudflare\Zone($CFAPI);
                $zones = $CFZones->list_zones();
                $zones = json_decode(json_encode($zones), true);
                echo json_encode($zones, JSON_PRETTY_PRINT) . "\n";
            } catch (\Exception $e) {
                echo json_encode(['status' => -1, 'msg' => $e->getMessage()]) . "\n";
            }
            break;

        case 'create':
            if (!isset($argv[2]) || !isset($argv[3]) || !isset($argv[4])) {
                die("THANHDIEU(" . json_encode(['status' => -1, 'msg' => 'Usage: php generatorSubdomain.php create <subdomain> <type> <ip> [ttl] [proxied]']) . ")");
            }
            $result = create($argv[2], $argv[3], $argv[4], isset($argv[5]) ? (int)$argv[5] : null, isset($argv[6]) ? filter_var($argv[6], FILTER_VALIDATE_BOOLEAN) : true);
            echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
            break;

        case 'delete':
            if (!isset($argv[2])) {
                die("THANHDIEU(" . json_encode(['status' => -1, 'msg' => 'Usage: php generatorSubdomain.php delete <subdomain> [type]']) . ")");
            }
            $result = deleter($argv[2], isset($argv[3]) ? $argv[3] : null);
            echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
            break;

        case 'edit':
            if (!isset($argv[2]) || !isset($argv[3])) {
                die("THANHDIEU(" . json_encode(['status' => -1, 'msg' => 'Usage: php generatorSubdomain.php edit <subdomain> <new_ip> [type]']) . ")");
            }
            $result = edit($argv[2], $argv[3], isset($argv[4]) ? $argv[4] : 'A');
            echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
            break;

        case 'zone-id':
            if (!isset($argv[2])) {
                die("THANHDIEU(" . json_encode(['status' => -1, 'msg' => 'Usage: php generatorSubdomain.php zone-id <subdomain>']) . ")");
            }
            $zoneId = ZoneId($argv[2]);
            echo json_encode(['subdomain' => $argv[2], 'zone_id' => $zoneId ?: null], JSON_PRETTY_PRINT) . "\n";
            break;

        default:
            echo json_encode(['status' => -1, 'msg' => 'Actions: list-zones, create, delete, edit, zone-id'], JSON_PRETTY_PRINT) . "\n";
    }
}
