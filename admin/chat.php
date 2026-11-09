<?php
/**
 * Chat Admin - User
 * Quản lý tin nhắn chat giữa Admin và thành viên
 * URL: /admin/chat
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
include($_SERVER['DOCUMENT_ROOT'].'/server/models/object/admin/handleModel.php');

// Xác thực admin
$authentication->Admin($taikhoan);

// Xử lý AJAX: gửi tin nhắn admin
if (!empty($_POST['action'])) {
    header('Content-Type: application/json');

    if ($_POST['action'] === 'send') {
        $ticketId = $_POST['ticket_id'] ?? '';
        $message  = trim($_POST['message'] ?? '');

        if (empty($ticketId) || empty($message)) {
            echo json_encode(['status' => 'error', 'msg' => 'Dữ liệu không hợp lệ']);
            exit;
        }

        $stmt = $thanhdieudb->prepare(
            "INSERT INTO ws_admin_chat (ticket_id, admin_username, message, message_type) VALUES (?, ?, ?, 'admin')"
        );
        $stmt->bind_param('sss', $ticketId, $taikhoan, $message);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'msg' => 'Đã gửi']);
        exit;
    }

    if ($_POST['action'] === 'get-messages') {
        $ticketId = $_POST['ticket_id'] ?? '';
        if (empty($ticketId)) {
            echo json_encode(['status' => 'error', 'msg' => 'Thiếu ticket_id']);
            exit;
        }

        $stmt = $thanhdieudb->prepare(
            "SELECT id, ticket_id, user_username, user_fullname, admin_username, message, message_type, created_at, read_at
             FROM ws_admin_chat
             WHERE ticket_id = ?
             ORDER BY created_at ASC"
        );
        $stmt->bind_param('s', $ticketId);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        echo json_encode(['status' => 'success', 'messages' => $messages]);
        exit;
    }

    if ($_POST['action'] === 'get-tickets') {
        $limit = min((int)($_POST['limit'] ?? 50), 200);
        $offset = max((int)($_POST['offset'] ?? 0), 0);

        // Lấy danh sách ticket mới nhất, ưu tiên tin chưa đọc
        $sql = "SELECT ticket_id, user_username, user_fullname, user_avatar,
                MAX(created_at) AS last_message_at,
                COUNT(*) AS total_messages,
                (SELECT message_type FROM ws_admin_chat c2
                 WHERE c2.ticket_id = ws_admin_chat.ticket_id
                 ORDER BY c2.id DESC LIMIT 1) AS last_sender
                FROM ws_admin_chat
                GROUP BY ticket_id
                ORDER BY last_message_at DESC
                LIMIT ? OFFSET ?";

        $stmt = $thanhdieudb->prepare($sql);
        $stmt->bind_param('ii', $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $tickets = [];
        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }

        echo json_encode(['status' => 'success', 'tickets' => $tickets]);
        exit;
    }

    if ($_POST['action'] === 'mark-read') {
        $ticketId = $_POST['ticket_id'] ?? '';
        if (empty($ticketId)) {
            echo json_encode(['status' => 'error']);
            exit;
        }

        $stmt = $thanhdieudb->prepare(
            "UPDATE ws_admin_chat SET read_at = NOW() WHERE ticket_id = ? AND message_type = 'user'"
        );
        $stmt->bind_param('s', $ticketId);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
        exit;
    }

    if ($_POST['action'] === 'create-ticket') {
        $userUsername = trim($_POST['user_username'] ?? '');
        $message      = trim($_POST['message'] ?? '');

        if (empty($userUsername)) {
            echo json_encode(['status' => 'error', 'msg' => 'Thiếu username']);
            exit;
        }

        // Kiểm tra user tồn tại
        $chk = $thanhdieudb->prepare("SELECT username, avatar FROM users WHERE username = ?");
        $chk->bind_param('s', $userUsername);
        $chk->execute();
        $chk = $chk->get_result();
        if ($chk->num_rows === 0) {
            echo json_encode(['status' => 'error', 'msg' => 'User không tồn tại']);
            exit;
        }
        $user = $chk->fetch_assoc();

        $ticketId = $taikhoan . '_' . $userUsername . '_' . substr(md5(time() . mt_rand()), 0, 8);

        // Gửi tin nhắn mở đầu (admin)
        $stmt = $thanhdieudb->prepare(
            "INSERT INTO ws_admin_chat (ticket_id, user_username, user_avatar, admin_username, message, message_type) VALUES (?, ?, ?, ?, ?, 'admin')"
        );
        $stmt->bind_param('ssss', $ticketId, $userUsername, $user['avatar'], $taikhoan, $message);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'ticket_id' => $ticketId]);
        exit;
    }

    // Mặc định
    echo json_encode(['status' => 'error', 'msg' => 'Hành động không hợp lệ']);
    exit;
}

// === Giao diện HTML ===
// Lấy danh sách ticket (gọi AJAX từ frontend, hoặc render tĩnh cho phát)
$ticketList = [];
$stmt = $thanhdieudb->query(
    "SELECT ticket_id, user_username, user_fullname, user_avatar,
     MAX(created_at) AS last_message_at,
     COUNT(*) AS total_messages
     FROM ws_admin_chat
     GROUP BY ticket_id
     ORDER BY last_message_at DESC
     LIMIT 100"
);
while ($row = $stmt->fetch_assoc()) {
    $ticketList[] = $row;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat Admin - <?=$TD->Setting('name-site')?></title>
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/td-custom.css?ver=<?=$TD->Setting('cache').rand(110011,2200022)?>">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css" rel="stylesheet">
    <style>
        body { background: #111827; color: #e2e8f0; font-family: sans-serif; padding: 24px; }
        .chat-container { display: flex; gap: 16px; max-width: 1200px; margin: 0 auto; }
        .ticket-sidebar { width: 280px; flex-shrink: 0; }
        .ticket-list { background: #1e293b; border-radius: 10px; overflow: hidden; }
        .ticket-item {
            padding: 12px 14px; cursor: pointer; border-bottom: 1px solid #334155;
            transition: background 0.15s;
        }
        .ticket-item:hover { background: #334155; }
        .ticket-item.active { background: #3b82f6; color: #fff; }
        .ticket-item .username { font-weight: 600; font-size: 13px; }
        .ticket-item .time { font-size: 11px; opacity: 0.7; }
        .ticket-item .msg-count { font-size: 11px; opacity: 0.6; }
        .chat-main { flex: 1; background: #1e293b; border-radius: 10px; overflow: hidden; min-height: 500px; }
        .chat-header {
            padding: 12px 16px; border-bottom: 1px solid #334155;
            display: flex; align-items: center; gap: 12px; background: #0f172a;
        }
        .chat-header .avatar {
            width: 36px; height: 36px; border-radius: 50%; object-fit: cover;
        }
        .chat-header .name { font-weight: 600; font-size: 14px; }
        .chat-header .status { font-size: 12px; opacity: 0.7; }
        .chat-messages {
            padding: 16px; height: 380px; overflow-y: auto;
            display: flex; flex-direction: column; gap: 8px;
            background: #0f172a;
        }
        .msg {
            max-width: 70%; padding: 8px 14px; border-radius: 12px;
            font-size: 13px; line-height: 1.45; word-wrap: break-word;
        }
        .msg.user {
            align-self: flex-start; background: #334155; color: #e2e8f0;
            border-bottom-left-radius: 4px;
        }
        .msg.admin {
            align-self: flex-end; background: #2563eb; color: #fff;
            border-bottom-right-radius: 4px;
        }
        .msg .msg-meta { font-size: 10px; opacity: 0.6; margin-top: 4px; }
        .chat-input {
            padding: 12px 16px; border-top: 1px solid #334155;
            display: flex; gap: 8px; background: #1e293b;
        }
        .chat-input input {
            flex: 1; padding: 10px 14px; border-radius: 8px;
            border: 1px solid #334155; background: #0f172a; color: #e2e8f0;
            font-size: 13px; outline: none;
        }
        .chat-input input:focus { border-color: #3b82f6; }
        .chat-input button {
            padding: 10px 18px; border-radius: 8px; border: none;
            background: #3b82f6; color: #fff; cursor: pointer; font-size: 13px; font-weight: 600;
        }
        .chat-input button:hover { background: #2563eb; }
        .no-ticket { padding: 40px; text-align: center; color: #94a3b8; }
        .btn-new-ticket {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 14px; border-radius: 8px; cursor: pointer;
            background: #334155; color: #e2e8f0; border: 1px solid #475569;
            font-size: 12px; margin-bottom: 12px;
        }
        .btn-new-ticket:hover { background: #475569; }
        .empty-chat {
            padding: 60px 20px; text-align: center; color: #64748b;
        }
        .empty-chat h3 { margin-bottom: 8px; color: #94a3b8; }
        .scroll-up {
            position: fixed; bottom: 80px; right: 20px; z-index: 999;
            width: 36px; height: 36px; border-radius: 50%;
            background: #3b82f6; color: #fff; border: none; cursor: pointer;
            display: none; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(59,130,246,0.4);
        }
        .scroll-up.show { display: flex; }
    </style>
</head>
<body>

<div class="chat-container">
    <!-- Sidebar danh sách ticket -->
    <div class="ticket-sidebar">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 14px;background:#0f172a;border-bottom:1px solid #334155;">
            <strong style="font-size:14px;">Phiên Chat</strong>
            <span style="font-size:11px;color:#94a3b8;"><?=count($ticketList)?>_phiên</span>
        </div>
        <div class="ticket-list" id="ticketList">
            <?php if (empty($ticketList)): ?>
                <div class="no-ticket">
                    <div class="btn-new-ticket" onclick="openNewTicketModal()">
                        <em class="icon ni ni-message-2"></em> Tạo phiên chat mới
                    </div>
                    <p style="margin-top:12px;">Chưa có phiên chat nào.</p>
                </div>
            <?php else: ?>
                <div class="btn-new-ticket" onclick="openNewTicketModal()" style="padding:8px 14px;margin:0;">
                    <em class="icon ni ni-plus-circle"></em> Mới
                </div>
                <?php foreach ($ticketList as $t): ?>
                <div class="ticket-item" data-ticket="<?=$t['ticket_id']?>" onclick="selectTicket('<?=$t['ticket_id']?>')">
                    <div class="username"><?=htmlspecialchars($t['user_username'])?></div>
                    <div class="time"><?=date('d/m H:i', strtotime($t['last_message_at']))?></div>
                    <div class="msg-count"><?=count($t)?> tin</div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Khung chat chính -->
    <div class="chat-main" id="chatMain">
        <div class="empty-chat" id="emptyChat">
            <h3>Chọn phiên chat hoặc tạo mới</h3>
            <p>Chọn 1 phiên ở danh sách bên trái, hoặc nhấn "Tạo phiên chat mới" để bắt đầu trò chuyện với thành viên.</p>
        </div>

        <div id="chatView" style="display:none;">
            <div class="chat-header">
                <img id="chatAvatar" class="avatar" src="" alt="">
                <div>
                    <div class="name" id="chatName"></div>
                    <div class="status" id="chatStatus"></div>
                </div>
            </div>
            <div class="chat-messages" id="chatMessages"></div>
            <div class="chat-input">
                <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." autocomplete="off">
                <button id="chatSendBtn" onclick="sendMessage()">Gửi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal tạo ticket mới -->
<div id="newTicketModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#1e293b;border-radius:12px;padding:24px;width:400px;max-width:90vw;">
        <h3 style="margin-top:0;color:#e2e8f0;">Tạo phiên chat mới</h3>
        <p style="color:#94a3b8;font-size:13px;margin-bottom:16px;">Nhập username thành viên để bắt đầu chat.</p>
        <input type="text" id="newTicketUser" placeholder="Username (ví dụ: mrjack6789)" style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #334155;background:#0f172a;color:#e2e8f0;font-size:13px;margin-bottom:12px;outline:none;">
        <textarea id="newTicketMessage" rows="3" placeholder="Tin nhắn mở đầu (admin)" style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #334155;background:#0f172a;color:#e2e8f0;font-size:13px;resize:vertical;margin-bottom:16px;outline:none;"></textarea>
        <div style="display:flex;gap:8px;justify-content:flex-end;">
            <button onclick="closeNewTicketModal()" style="padding:8px 16px;border-radius:8px;border:1px solid #334155;background:#334155;color:#e2e8f0;cursor:pointer;font-size:13px;">Hủy</button>
            <button onclick="createNewTicket()" style="padding:8px 16px;border-radius:8px;border:none;background:#3b82f6;color:#fff;cursor:pointer;font-size:13px;">Tạo</button>
        </div>
        <div id="newTicketError" style="color:#f87171;font-size:12px;margin-top:8px;display:none;"></div>
    </div>
</div>

<button class="scroll-up" id="scrollUpBtn" onclick="document.getElementById('chatMessages').scrollTop = 0">
    <em class="icon ni ni-arrow-up"></em>
</button>

<script>
var currentTicketId = null;
var messages = [];

function selectTicket(ticketId) {
    currentTicketId = ticketId;
    document.querySelectorAll('.ticket-item').forEach(function(el) {
        el.classList.toggle('active', el.getAttribute('data-ticket') === ticketId);
    });

    document.getElementById('emptyChat').style.display = 'none';
    document.getElementById('chatView').style.display = 'block';
    document.getElementById('chatMessages').innerHTML = '';

    // Load thông tin user + tin nhắn
    loadTicketInfo(ticketId);
    loadMessages(ticketId);

    // Đánh dấu đã đọc
    fetch('/admin/chat', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=mark-read&ticket_id=' + encodeURIComponent(ticketId)
    });
}

function loadTicketInfo(ticketId) {
    fetch('/admin/chat', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=get-messages&ticket_id=' + encodeURIComponent(ticketId)
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 'success' && data.messages.length > 0) {
            var first = data.messages[0];
            var last  = data.messages[data.messages.length - 1];

            document.getElementById('chatName').textContent = 'Thành viên: ' + (first.user_fullname || first.user_username);
            document.getElementById('chatStatus').textContent = 'Online · ' + data.messages.length + ' tin nhắn';

            if (first.user_avatar && first.user_avatar !== '') {
                document.getElementById('chatAvatar').src = first.user_avatar;
            } else {
                document.getElementById('chatAvatar').src = '/public/src/vtd/img/icon/avatar/default.png';
            }
        }
    });
}

function loadMessages(ticketId) {
    fetch('/admin/chat', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=get-messages&ticket_id=' + encodeURIComponent(ticketId)
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 'success') {
            messages = data.messages;
            var container = document.getElementById('chatMessages');
            container.innerHTML = '';
            messages.forEach(function(msg) {
                var el = document.createElement('div');
                el.className = 'msg ' + msg.message_type;
                el.innerHTML = escapeHtml(msg.message) +
                    '<div class="msg-meta">' + timeAgo(msg.created_at) + '</div>';
                container.appendChild(el);
            });
            // Scroll xuống dưới
            container.scrollTop = container.scrollHeight;
        }
    });
}

function sendMessage() {
    var input = document.getElementById('chatInput');
    var msg = input.value.trim();
    if (!msg || !currentTicketId) return;

    // Gửi tin nhắn admin
    fetch('/admin/chat', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=send&ticket_id=' + encodeURIComponent(currentTicketId) + '&message=' + encodeURIComponent(msg)
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 'success') {
            input.value = '';
            loadMessages(currentTicketId);
        }
    });
}

// Nhấn Enter để gửi
document.getElementById('chatInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

// Tự động load tin nhắn mới mỗi 5 giây (nếu đang chọn ticket)
setInterval(function() {
    if (currentTicketId) {
        loadMessages(currentTicketId);
    }
}, 5000);

function timeAgo(dateStr) {
    var diff = Date.now() - new Date(dateStr).getTime();
    var mins = Math.floor(diff / 60000);
    if (mins < 1) return 'Vừa xong';
    if (mins < 60) return mins + ' phút trước';
    var hours = Math.floor(mins / 60);
    if (hours < 24) return hours + ' giờ trước';
    return dateStr.substring(8, 10) + '/' + dateStr.substring(5, 7) + '/' + dateStr.substring(0, 4);
}

function escapeHtml(text) {
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function openNewTicketModal() {
    document.getElementById('newTicketModal').style.display = 'flex';
    document.getElementById('newTicketUser').focus();
}
function closeNewTicketModal() {
    document.getElementById('newTicketModal').style.display = 'none';
    document.getElementById('newTicketError').style.display = 'none';
}
function createNewTicket() {
    var user = document.getElementById('newTicketUser').value.trim();
    var msg  = document.getElementById('newTicketMessage').value.trim();
    var err  = document.getElementById('newTicketError');

    if (!user) {
        err.style.display = 'block';
        err.textContent = 'Vui lòng nhập username.';
        return;
    }

    fetch('/admin/chat', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=create-ticket&user_username=' + encodeURIComponent(user) + '&message=' + encodeURIComponent(msg || 'Xin chào, admin đang hỗ trợ bạn.')
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.status === 'success') {
            closeNewTicketModal();
            selectTicket(data.ticket_id);
            // Reload danh sách ticket
            location.reload();
        } else {
            err.style.display = 'block';
            err.textContent = data.msg || 'Lỗi tạo phiên chat.';
        }
    });
}

// Quăng nút scroll lên khi cuộn xuống dưới
var chatMessages = document.getElementById('chatMessages');
chatMessages.addEventListener('scroll', function() {
    var btn = document.getElementById('scrollUpBtn');
    btn.classList.toggle('show', this.scrollTop > 100);
});
</script>

</body>
</html>
