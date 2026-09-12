<?php $options_header = ['title' => 'Tool Encode PHP Online','description'=>'Công cụ giúp bạn Obfuscator, Compressor và mã hoá code PHP của bạn chỉ với cú nhấp chuột mà không cần sử dụng extension (tiện ích mở rộng).'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-red-800 fw-light">Công Cụ Hữu Ích /</span> Encoder PHP Online
        </h4>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form class="__thanhdieu-obfuscate-php">
                    <div class="card mb-4 thanhdieu-card-bg thanhdieu-border-card">
                        <h5 class="card-header text-red-800">
                            <i class="ri-tools-fill me-2"></i>Tool Encoder PHP
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="code">Dán Mã Vào
                                    Đây</label>
                                <textarea class="form-control dangerBox codemirror" name="code"
                                    rows="7"><?php echo THANHDIEU('<?php echo "Hello World"; ?>');?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Kiểu Mã Hoá</label>
                                <select class="form-select thanhdieu-select-mod dangerBox" name="type" id="type-protect"
                                    aria-label="LOẠI TẤN CÔNG" required>
                                    <optgroup style="color:#f7ff03;" label="━ Type Protect ━">
                                        <option value="str">➣ String Encode - Compressor | Hỗ Trợ PHP < 8.x </option>
                                        <option value="alom">➣ Alom Obfuscator 3.0 | Hỗ Trợ PHP < 8.0 </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="row option-setting-alom hide">
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                <i class="ri-question-line me-2"></i>Đối với Encode Raw, để bảm bảo mã của bạn không bị băm làm sai cấu trúc, chúng tôi đã thêm chế độ tải xuống thủ công thông qua việc nén ZIP, liên kết tải xuống sẽ tự động xoá sau 3 phút kể từ lúc mã hoá thành công.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="display" class="form-label"><b class="h7">[ + ] Display Settings</b>
                                            <i data-bs-toggle="tooltip" data-bs-original-title="Tinh chỉnh kiểu mã hoá."
                                                class="cursor-pointer ri-information-fill"></i></label>
                                        <select class="form-select thanhdieu-select-mod dangerBox" name="display"
                                            aria-label="Display Settings" required>
                                            <optgroup style="color:#ff0044;" label="━ Loại Mã Hoá ━">
                                                <option checked value="raw">➣ Encode Raw</option>
                                                <option value="hex">➣ Encode Hex</option>
                                                <option value="bin">➣ Encode Bin</option>
                                                <option value="base64">➣ Encode Base64</option>
                                                <option value="base64r">➣ Encode Base64r</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="halt_mode">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Halt Mode <i data-bs-toggle="tooltip"
                                                    data-bs-original-title="Bật/Tắt chế độ dừng"
                                                    class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="hide_errors">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Hide Errors <i data-bs-toggle="tooltip"
                                                    data-bs-original-title="Bật/Tắt hiển thị lỗi"
                                                    class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="hide_eval">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Hide Eval <i data-bs-toggle="tooltip"
                                                    data-bs-original-title="Chạy đoạn mã chính bên trong hàm eval."
                                                    class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="global_cache">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Global Cache <i data-bs-toggle="tooltip"
                                                    data-bs-original-title="Bật/Tắt bộ nhớ đệm global nếu Hide Eval khi đang được bật."
                                                    class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b class="h7">[ + ] Antihooking - Debugger</b><br>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="antihooking">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Anti Hooking <i data-bs-toggle="tooltip"
                                                    data-bs-original-title="Kích hoạt hoặc vô hiệu hoá."
                                                    class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="antidebugger">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Anti Debugger <i data-bs-toggle="tooltip"
                                                    data-bs-original-title="Nếu tắt (dành cho optwister, qbc) / Nếu bật (dành cho minify, antidebugger)"
                                                    class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b class="h7">[ + ] Additional</b><br>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="antitamper">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Antitamper <i data-bs-toggle="tooltip"
                                                    data-bs-original-title="Một phần của tập lệnh không bị xáo trộn, vẫn hiển thị và không thể bị người dùng can thiệp hay thay đổi."
                                                    class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="thanhdieu-obfuscate-php">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="ri-send-plane-line"></i>&ensp;Obfuscate</button>
                                    &ensp;
                                    <button type="button" class="btn btn-primary clear-form-obf">
                                        <i class="ri-refresh-line me-2"></i>Đặt Lại </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-10">
                <div class="card thanhdieu-card-bg thanhdieu-border-card">
                    <h5 class="card-header text-red-800"><i class="ri-equal-line me-2"></i>Kết Quả Mã Hoá<span
                            class="total-sms badge badge-center rounded-pill"></span>
                    </h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <pre><code id="kq-mh" class="language-javascript">/** Kết quả sẽ hiển thị ở đây */</code></pre>
                        </div>
                        <div class="row justify-content-center text-nowrap">
                            <div class="col-auto text-center">
                                <button type="button" class="copy-kq btn btn-primary">
                                    <i class="ri-file-copy-line me-2"></i>Sao Chép
                                </button>
                            </div>
                            <div class="col-auto text-center">
                                <button type="button" data-type-download="php" class="download-kq btn btn-primary">
                                    <i class="ri-download-cloud-2-line me-2"></i>Tải Xuống
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>