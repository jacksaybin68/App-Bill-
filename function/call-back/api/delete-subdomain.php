<?php
require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/generatorSubdomain.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/server/services/CallbackAuth.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Xóa subdomain từ Cloudflare
 */
function deleteSubdomainFromCloudflare(string $subdomain, string $hauto, string $zoneId): array
{
    global $set_email, $set_auth_key;
    $result = [
        'subdomain' => $subdomain . '.' . $hauto,
        'zone_id' => $zoneId,
        'deleted' => false,
        'records' => [],
        'errors' => []
    ];
    try {
        $CFAPI = new \Cloudflare\Api($set_email, $set_auth_key);
        $CFDNS = new \Cloudflare\Zone\Dns($CFAPI);
        $records = $CFDNS->list_records($zoneId, null, $subdomain);
        $records = json_decode(json_encode($records), true);
        if (isset($records['success']) && $records['success'] && !empty($records['result'])) {
            foreach ($records['result'] as $record) {
                $delete = $CFDNS->delete_record($zoneId, $record['id']);
                $delete = json_decode(json_encode($delete), true);
                $result['records'][] = [
                    'record_id' => $record['id'],
                    'type' => $record['type'],
                    'name' => $record['name'],
                    'content' => $record['content'] ?? '',
                    'deleted' => isset($delete['success']) && $delete['success']
                ];
                if (!isset($delete['success']) || !$delete['success']) {
                    $result['errors'][] = [
                        'record_id' => $record['id'],
                        'message' => isset($delete['errors']) ? $delete['errors'][0]['message'] : 'Unknown error'
                    ];
                }
            }
            $result['deleted'] = empty($result['errors']);
        } else {
            $result['errors'][] = 'No DNS records found for subdomain: ' . $subdomain;
        }
    } catch (\Exception $e) {
        $result['errors'][] = 'Exception: ' . $e->getMessage();
    }
    return $result;
}

function ZoneId(string $domain): string
{
    global $set_email, $set_auth_key;
    try {
        $CFAPI = new \Cloudflare\Api($set_email, $set_auth_key);
        $CFZones = new \Cloudflare\Zone($CFAPI);
        $zones = $CFZones->list_zones(null, null, $domain);
        $zones = json_decode(json_encode($zones), true);
        if (isset($zones['success']) && $zones['success'] && !empty($zones['result'])) {
            foreach ($zones['result'] as $zone) {
                if ($zone['name'] === $domain || str_ends_with($domain, '.' . $zone['name'])) {
                    return $zone['id'];
                }
            }
        }
    } catch (\Exception $e) {
        // fall through
    }
    return '';
}

function deleteAllSubdomains(): array
{
    $results = [];
    $stmt = DatabaseConnection::ThanhDieuDB()->prepare(
        "SELECT domain_id, username, ten_mien, hauto, loai, trangthai FROM ws_subdomain ORDER BY domain_id"
    );
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $fullDomain = $row['ten_mien'] . '.' . $row['hauto'];
        $zoneId = ZoneId($fullDomain);
        if (!$zoneId) {
            $results[] = [
                'domain_id' => $row['domain_id'],
                'subdomain' => $fullDomain,
                'status' => 'error',
                'message' => 'Không tìm thấy zone ID cho domain: ' . $fullDomain
            ];
            continue;
        }
        $deleteResult = deleteSubdomainFromCloudflare($row['ten_mien'], $row['hauto'], $zoneId);
        $results[] = [
            'domain_id' => $row['domain_id'],
            'username' => $row['username'],
            'subdomain' => $fullDomain,
            'loai' => $row['loai'],
            'trangthai' => $row['trangthai'],
            'status' => $deleteResult['deleted'] ? 'success' : 'partial',
            'deleted_records' => count($deleteResult['records']),
            'errors' => $deleteResult['errors']
        ];
    }
    return $results;
}

// Xác thực callback token
CallbackAuth::validate();
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? 'delete-all';
switch ($action) {
    case 'delete-all':
        $results = deleteAllSubdomains();
        echo json_encode([
            'status' => 200,
            'action' => 'delete-all',
            'total_domains' => count($results),
            'successful' => count(array_filter($results, fn($r) => $r['status'] === 'success')),
            'partial' => count(array_filter($results, fn($r) => $r['status'] === 'partial')),
            'failed' => count(array_filter($results, fn($r) => $r['status'] === 'error')),
            'results' => $results
        ]);
        break;
    case 'delete-single':
        $domain_id = (int)($_POST['domain_id'] ?? $_GET['domain_id'] ?? 0);
        if ($domain_id <= 0) {
            http_response_code(400);
            echo json_encode(['status' => -1, 'msg' => 'domain_id không hợp lệ']);
            break;
        }
        $stmt = DatabaseConnection::ThanhDieuDB()->prepare(
            "SELECT domain_id, username, ten_mien, hauto, loai, trangthai FROM ws_subdomain WHERE domain_id = ?"
        );
        $stmt->bind_param('i', $domain_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res || !$row = $res->fetch_assoc()) {
            http_response_code(404);
            echo json_encode(['status' => -1, 'msg' => 'Không tìm thấy subdomain']);
            break;
        }
        $zoneId = ZoneId($row['ten_mien'] . '.' . $row['hauto']);
        if (!$zoneId) {
            http_response_code(400);
            echo json_encode(['status' => -1, 'msg' => 'Không tìm thấy zone ID']);
            break;
        }
        $deleteResult = deleteSubdomainFromCloudflare($row['ten_mien'], $row['hauto'], $zoneId);
        if ($deleteResult['deleted']) {
            $delStmt = DatabaseConnection::ThanhDieuDB()->prepare("DELETE FROM ws_subdomain WHERE domain_id = ?");
            $delStmt->bind_param('i', $domain_id);
            $delStmt->execute();
        }
        echo json_encode([
            'status' => $deleteResult['deleted'] ? 200 : -1,
            'action' => 'delete-single',
            'domain_id' => $domain_id,
            'subdomain' => $row['ten_mien'] . '.' . $row['hauto'],
            'deleted_from_db' => $deleteResult['deleted'],
            'result' => $deleteResult
        ]);
        break;
    default:
        http_response_code(400);
        echo json_encode(['status' => -1, 'msg' => 'Action không hợp lệ. Hỗ trợ: delete-all, delete-single']);
        break;
}
