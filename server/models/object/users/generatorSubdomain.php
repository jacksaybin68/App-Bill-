<?php
if (php_sapi_name() === 'cli') {
    if (!isset($argv[1]) || empty($argv[1])) {
        die("THANHDIEU(" . JSON_FORMATTER(['status' => 403, 'msg' => '403 Forbidden.']) . ")");
    }
}
$set_email = '';
$set_auth_key = '';
$list_zone_ids = [
    'cloudruler.site' => '',
    'wusteam.xyz' => '',
    'spinextra.online' => '',
];
function ZoneId($subdomain) {
    global $list_zone_ids;
    $parts = explode('.', $subdomain);
    if (count($parts) > 1) {
        $suffix = implode('.', array_slice($parts, -2));
        return $list_zone_ids[$suffix] ?? null;
    }
    return null;
}
function create($subdomain, $record_type, $servers_ip)
{
    global $set_email, $set_auth_key, $set_zone_id;
    $ttl = null;
    $proxied = true;
    $CFAPI = new \Cloudflare\Api($set_email, $set_auth_key);
    $CFDNS = new \Cloudflare\Zone\Dns($CFAPI);
    $records = $CFDNS->list_records($set_zone_id, $record_type, $subdomain);
    $records = json_decode(json_encode($records), true);
    if ($records['success'] && !empty($records['result'])) {
        return [
            'success' => false,
            'errors' => [
                [
                    'code' => 1001,
                    'message' => 'A record with this subdomain and type already exists.'
                ]
            ]
        ];
    }
    $response = $CFDNS->create($set_zone_id, $record_type, $subdomain, $servers_ip, $ttl, $proxied);
    $response = json_decode(json_encode($response), true);
    if (isset($response['success']) && $response['success']) {
        return [
            'success' => true,
            'message' => 'Subdomain created successfully.'
        ];
    } else {
        return [
            'success' => false,
            'errors' => isset($response['errors']) ? $response['errors'] : [['code' => 500, 'message' => 'An unknown error occurred.']]
        ];
    }
}

function deleter($subdomain)
{
    global $set_email, $set_auth_key, $set_zone_id;
    $CFAPI = new \Cloudflare\Api($set_email, $set_auth_key);
    $CFDNS = new \Cloudflare\Zone\Dns($CFAPI);
    $records = $CFDNS->list_records($set_zone_id, null, $subdomain);
    $records = json_decode(json_encode($records), true);
    if ($records['success'] && !empty($records['result'])) {
        foreach ($records['result'] as $record) {
            if (strcasecmp($record['name'], $subdomain) === 0) {
                $delete = $CFDNS->delete_record($set_zone_id, $record['id']);
                $delete = json_decode(json_encode($delete), true);
                if (isset($delete['success']) && $delete['success']) {
                    return [
                        'success' => true,
                        'message' => 'Subdomain deleted successfully.'
                    ];
                } else {
                    return [
                        'success' => false,
                        'errors' => isset($delete['errors']) ? $delete['errors'] : [['code' => 500, 'message' => 'An unknown error occurred.']]
                    ];
                }
            }
        }
        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'Không tìm thấy subdomain.']]
        ];
    } else {
        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'Không tìm thấy subdomain.']]
        ];
    }
}

function edit($subdomain, $new_ip, $record_type)
{
    global $set_email, $set_auth_key, $set_zone_id;
    $CFAPI = new \Cloudflare\Api($set_email, $set_auth_key);
    $CFDNS = new \Cloudflare\Zone\Dns($CFAPI);
    $records = $CFDNS->list_records($set_zone_id, $record_type, $subdomain);
    $records = json_decode(json_encode($records), true);
    if ($records['success'] && !empty($records['result'])) {
        foreach ($records['result'] as $record) {
            if (strcasecmp($record['name'], $subdomain) === 0) {
                $update = $CFDNS->update(
                    $set_zone_id,              // zone_identifier
                    $record['id'],            // identifier
                    $record_type,              // type
                    $subdomain,                // name
                    $new_ip,                   // content
                    null,                      // ttl (null to keep current TTL)
                    true                       // proxied (set to true to enable proxy)
                );
                $update = json_decode(json_encode($update), true);
                if (isset($update['success']) && $update['success']) {
                    return [
                        'success' => true,
                        'message' => 'Subdomain updated successfully.'
                    ];
                } else {
                    return [
                        'success' => false,
                        'errors' => isset($update['errors']) ? $update['errors'] : [['code' => 500, 'message' => 'An unknown error occurred.']]
                    ];
                }
            }
        }
        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'Không tìm thấy subdomain.']]
        ];
    } else {
        return [
            'success' => false,
            'errors' => [['code' => 404, 'message' => 'No records found for the given subdomain.']]
        ];
    }
}
