# BASELINE NOTES — Pha 0 (lưới an toàn trước Pha 1)

- Ngày tạo: 2026-09-13
- Phạm vi sửa (Act): Pha 0 + Pha 1 (luồng tài chính auto-bank/payment)
- Repo git: khởi tạo ngay sau file này, commit baseline = trạng thái TRƯỚC mọi sửa đổi.

## Backup đã thực hiện
| Hạng mục | Đường dẫn |
|---|---|
| DB dump (pre-Pha1) | `/Users/user/Downloads/public_html_backup/billviet-pre-pha1-20260913-025109.sql` (5.3MB, mysqldump --single-transaction) |
| Cache bill snapshot | `/Users/user/Downloads/public_html_backup/cache-bill-snapshot/` (thư mục rỗng) |

## SHA-256 các file sẽ sửa (baseline)
| File | SHA-256 |
|---|---|
| `function/call-back/api/auto-bank.php` | `13848a6e0d030d34c6b3473e80eae073a4d8a3a3082b26d1d36b3f88b4a908e8` |
| `function/call-back/api/payment.php` | `1e009fdd93b4f78a9ae892c7f12cf4c405caea6d2734770bf0e1fa568c887ab3` |
| `function/cron/global.php` | `97e9e26ef67500fab39c962c6a7e5c0f98163a7064991047ce21f66087d6dc89` |
| `router.php` | `ff46f21d8e44685b7da9a987e96bd9c5b9166fd399461857e280148ca5d759e0` |
| `.htaccess` | `95ec159fac2b16d373224a9d7ff7c30cd97366fa37e6c864aef22d2eea2e102d` |
| `.gitignore` | `21851471d85546ee40c85789f7d20197a20ee1c3848a5404c883e850d3cda2da` |
| `config/common.php` | `b506aaf11cd1f1273e80afc0da9d011087f371c52db951b1a699b5603560b70c` |

File mới sẽ tạo:
- `server/services/BankDepositService.php`
- `server/services/AutoBankGateway.php`
- `server/services/CallbackAuth.php`
- `config/migrations/20260913_pha1_bank_deposit.sql` (chạy thủ công, có session DB riêng)

## Bằng chứng tổn thất hiện hữu (DB sống 127.0.0.1)
- `ws_history_bank`: 178 dòng, **19 nhóm magiaodich trùng**, 30 lần cộng thừa, tổng **612.220đ** cộng bậy.
- Top: `gilo90` +180.000đ thừa; `ducanhdocle2k7a` +80.000đ; `duyquanz`/`samok1999` +60.000đ…
- CSV chi tiết sẽ xuất: `credit-adjustments-YYYYMMDD-HHMMSS.csv` (ngoài docroot, trong `/Users/user/Downloads/public_html_backup/`).

## Lỗi gốc đã thẩm định
1. TOCTOU: dup-check SELECT rồi INSERT riêng lẻ → race → nạp trùng (đã xảy ra thật, số liệu trên).
2. Cửa sổ thời gian: `$d <= WsRandomString::Number(10)` so sánh timestamp với **chuỗi 10 số random** → mọi giao dịch cũ đều pass.
3. `congtien()` interpolate thẳng `$username/$transactionID/$amount` (SQLi từ dữ liệu API ngoài).
4. `if (curl($notice))` — tiền chỉ cộng khi curl notice (đến `/call-back/api/n` = notify.ini.php cần session, vô nghĩa) thành công.
5. `$domain`, `$time` **không được định nghĩa đâu** trong app (undefined) → notice URL `https:///...`, so sánh thời gian rối.
6. `payment.php`: `$callback_api=''` → chết; không có route (endpoint mồ côi).
7. Endpoint không auth; response leak `version-code`.
8. `cron/global.php` gọi auto-bank qua HTTP theo đường dẫn file + dùng `$domain` undefined.

## Quyết định thiết kế (đã chốt với user)
- Idempotency: UNIQUE INDEX `ws_history_bank.magiaodich` + `START TRANSACTION` → INSERT history (bắt duplicate errno 1062) → UPDATE sodu → INSERT ws_logs → COMMIT.
- Dedupe migration: GIỮ dòng `thanhcong` có `bank_id` NHỎ NHẤT mỗi nhóm, các dòng còn lại đổi `trangthai='trunglap'` (không DELETE — dữ liệu xét xử), cộng tiền thừa KHÔNG tự trừ sodu; xuất CSV để admin tự xử lý.
- Cửa sổ mới: giao dịch ≤ 900 giây; nếu timestamp mô tả ở tương lai (giao dịch lố ngày) → trừ 1 ngày.
- Bỏ hoàn toàn tham số notice/cổng curl trong luồng cộng tiền.
- Cron gọi class trực tiếp trong-process; HTTP entry yêu cầu token `CALLBACK_TOKEN` (fail-closed, 403 JSON).
- `sotien` cột INT → amount cast int (0 < amount ≤ 2.000.000.000).
