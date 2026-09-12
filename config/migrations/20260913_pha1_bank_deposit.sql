-- Migration: Pha 1 - Bank Deposit Idempotency
-- Date: 2026-09-13
-- Description: Thêm UNIQUE INDEX cho ws_history_bank.magiaodich, thêm cột bank_name, 
--   đưa enum trangthai về 'trunglap' cho bản ghi trùng lặp, cập nhật cấu hình callback token
--
-- LƯU Ý: Chạy migration này sau backup DB. Xem BASELINE-NOTES.md để biết chi tiết.
-- THỨ TỰ BẮT BUỘC: Bước 1 → Bước 2 → Bước 2b → Bước 3 → Bước 4
-- Lí do: enum phải được cập nhật TRƯỚC khi cập nhật dữ liệu sang 'trunglap'

-- ====================================================================
-- BƯỚC 1: Cập nhật enum trangthai để hỗ trợ 'trunglap'
-- (Phải làm TRƯỚC bước dedupe để tránh lỗi Data truncated)
-- ====================================================================
ALTER TABLE `ws_history_bank`
    MODIFY `trangthai` enum('thatbai','thanhcong','trunglap') DEFAULT 'thatbai';

-- ====================================================================
-- BƯỚC 2: Deduplicate existing duplicate magiaodich rows
-- Giữ dòng có bank_id NHỎ NHẤT mỗi nhóm magiaodich (trangthai='thanhcong')
-- Đổi trangthai của các dòng còn lại sang 'trunglap'
-- (Không DELETE để giữ lại dữ liệu xét xử)
-- ====================================================================

UPDATE `ws_history_bank`
SET `trangthai` = 'trunglap'
WHERE `bank_id` NOT IN (
    SELECT * FROM (
        SELECT MIN(bank_id)
        FROM `ws_history_bank`
        WHERE `trangthai` = 'thanhcong'
        GROUP BY `magiaodich`
        HAVING COUNT(*) > 1
    ) AS tmp
)
AND `trangthai` = 'thanhcong'
AND `magiaodich` IN (
    SELECT * FROM (
        SELECT `magiaodich`
        FROM `ws_history_bank`
        WHERE `trangthai` = 'thanhcong'
        GROUP BY `magiaodich`
        HAVING COUNT(*) > 1
    ) AS tmp2
);

-- ====================================================================
-- BƯỚC 2b: Xử lý residual duplicate - cập nhật magiaodich của row 
-- 'trunglap' thành giá trị unique (thêm _DUP_<bank_id>) để tránh 
-- conflict với UNIQUE INDEX trên magiaodich
--
-- Lưu ý: Sau bước 2, vẫn có khả năng trùng lặp giữa row thanhcong 
-- và row trunglap trên cùng magiaodich. Bước này giải quyết vấn đề đó.
-- ====================================================================

UPDATE `ws_history_bank` 
SET `magiaodich` = CONCAT(`magiaodich`, '_DUP_', `bank_id`)
WHERE `trangthai` = 'trunglap' 
AND `magiaodich` REGEXP '^[0-9]+$';

-- ====================================================================
-- BƯỚC 3: Thêm cột bank_name để lưu tên ngân hàng giao dịch
-- ====================================================================
ALTER TABLE `ws_history_bank`
    ADD COLUMN IF NOT EXISTS `bank_name` VARCHAR(255) DEFAULT NULL AFTER `trangthai`;

-- ====================================================================
-- BƯỚC 4: Thêm UNIQUE INDEX trên magiaodich để đảm bảo idempotency
-- (Sau khi đã dedupe và xử lý residual, không còn trùng lặp nào)
-- ====================================================================
ALTER TABLE `ws_history_bank`
    ADD UNIQUE INDEX `idx_magiaodich_unique` (`magiaodich`) USING BTREE;

-- ====================================================================
-- BƯỚC 5: Thêm index cho truy vấn dedupe nhanh
-- ====================================================================
ALTER TABLE `ws_history_bank`
    ADD INDEX `idx_trangthai_magiaodich` (`trangthai`, `magiaodich`) USING BTREE;

-- ====================================================================
-- BƯỚC 6: Thêm cột callback_token vào ws_settings
-- (Dùng để lưu token xác thực callback API nếu cần thiết lưu trong DB;
--  nhưng hiện tại hệ thống dùng getenv('CALLBACK_TOKEN') hoặc hash từ
--  SERVER_ADDR + CALLBACK_TOKEN_SALT. Cột này giữ lại để hỗ trợ mở rộng.)
-- ====================================================================
ALTER TABLE `ws_settings`
    ADD COLUMN IF NOT EXISTS `callback_token` VARCHAR(255) DEFAULT NULL;

-- ====================================================================
-- GHI CHÚ:
-- 1. ws_history_bank.bank_id đã là PRIMARY KEY AUTO_INCREMENT rồi
-- 2. ws_logs.log_id đã là PRIMARY KEY AUTO_INCREMENT rồi
-- 3. ws_history_bank.sotien đã là INT rồi
-- 4. Sau khi chạy migration, admin cần thiết lập CALLBACK_TOKEN trong .env
--    hoặc dùng SERVER_ADDR + CALLBACK_TOKEN_SALT để tính token
-- 5. Nếu cần thiết lập token trong DB: 
--    UPDATE ws_settings SET callback_token='...' WHERE id=1;
-- 6. Các row 'trunglap' có magiaodich dạng 'XXX_DUP_YYY' để giữ dữ liệu 
--    nhưng tránh conflict với UNIQUE INDEX - admin có thể investigar thêm
-- ====================================================================
