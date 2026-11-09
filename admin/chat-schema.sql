-- Chat Admin - User: tạo bảng + stored procedure đơn giản
-- Run this SQL in phpMyAdmin / CLI trên VPS

CREATE TABLE IF NOT EXISTS `ws_admin_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(64) NOT NULL COMMENT 'Mã phiên chat',
  `user_username` varchar(255) NOT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_avatar` varchar(512) DEFAULT NULL,
  `admin_username` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `message_type` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ticket` (`ticket_id`),
  KEY `idx_user` (`user_username`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Helper view: danh sách phiên chat gần nhất
CREATE OR REPLACE VIEW `v_admin_chat_tickets` AS
SELECT
    ticket_id,
    user_username,
    user_fullname,
    user_avatar,
    admin_username,
    MAX(created_at) AS last_message_at,
    COUNT(*) AS total_messages,
    GROUP_CONCAT(message_type ORDER BY id DESC SEPARATOR ',') AS last_sender
FROM ws_admin_chat
GROUP BY ticket_id
ORDER BY last_message_at DESC;

-- Helper view: tin nhắn của 1 ticket
CREATE OR REPLACE VIEW `v_admin_chat_messages` AS
SELECT
    id,
    ticket_id,
    user_username,
    user_fullname,
    admin_username,
    message,
    message_type,
    created_at,
    read_at
FROM ws_admin_chat
ORDER BY created_at ASC;
