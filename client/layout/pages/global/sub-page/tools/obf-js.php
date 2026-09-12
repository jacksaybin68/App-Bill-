<?php $options_header = ['title' => 'JavaScript Obfuscator Tool','description'=>'Website for JavaScript (JS) obfuscation online, supporting variable name obfuscation, string encoding, junk code insertion, and control flow obfuscation. It makes the code unreadable to humans.','keywords'=>'encode php,free obfuscator php,protect php,php obfuscate, javascript obfuscator online,javascript encryption online,free js obfuscator','og:image'=>'https://avatars.githubusercontent.com/u/23015672?v=4'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-red-800 fw-light">Công Cụ Hữu Ích /</span> Obfuscate JavaScript
        </h4>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4 thanhdieu-card-bg thanhdieu-border-card">
                    <h5 class="card-header text-red-800">
                        <i class="ri-tools-fill me-2"></i>Tool Obfuscate JavaScript
                    </h5>
                    <form class="__thanhdieu-obfuscate-javascript">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" data-limit-text="999999" for="code">Dán Mã Vào
                                    Đây</label>
                                <textarea class="form-control dangerBox codemirror" name="code" rows="7">
 function HelloWorld() {
 alert("Obf.ThanhDieu.Com");
 }
 HelloWorld();</textarea>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="preset" class="form-label"><b class="h7">[ + ] Option
                                                Preset</b> <i data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Sức mạnh càng cao, hiệu suất càng thấp.<br>Low: Giảm 30%<br>Medium: Giảm 52%<br>High: Giảm 98%" class="cursor-pointer ri-information-fill"></i></label>
                                        <select class="form-select thanhdieu-select-mod dangerBox" name="preset"
                                            id="preset" aria-label="Stronger Encode" required>
                                            <optgroup style="color:#f3ff14;" label="━ Sức Mạnh ━">
                                                <option value="low">➣ Low</option>
                                                <option value="medium">➣ Medium</option>
                                                <option value="high">➣ High</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="target" class="form-label"><b class="h7">[ + ] Target</b> <i data-bs-toggle="tooltip" data-bs-original-title="Môi trường hỗ trợ, nếu code js của bạn sử dụng cho web thì hãy sài Browser, và ngược lại." class="cursor-pointer ri-information-fill"></i></label>
                                        <select class="form-select thanhdieu-select-mod dangerBox" name="target" aria-label="Target" required>
                                            <optgroup style="color:#ff1239;" label="━ Môi Trường ━">
                                                <option value="browser">➣ Browser</option>
                                                <option value="node">➣ Nodejs</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b class="h7">[ + ] Option Strings</b><br>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="stringEncoding">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">String Encode <i data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="String Encode biến đổi chuỗi thành một dạng mã hóa.<br>`code your` -> \x63\x6f\x64\x65\x20\x79\x6f\x75\x72" class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" checked name="stringConcealing">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">String Concealing <i data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Che giấu chuỗi liên quan đến việc mã hóa các chuỗi để làm cho các giá trị văn bản trở nên khó nhận diện.<br>Ví dụ: `code your` -> decrypt('<~@rH7+Dert~>')" class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="stringCompression">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">String Compression <i data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Mã hóa chuỗi sử dụng thuật toán nén LZW's để nén các chuỗi.<br>Ví dụ: `code your` -> inflate('replaĕ!ğğuģģ<~@')" class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="stringSplitting">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">String Splitting <i data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Tách chuỗi và băm chia các chuỗi của bạn thành nhiều phần.<br>Ví dụ: `code your` -> String.fromCharCode(99) + 'ode' + 'your'" class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-md-2">
                                    <b class="h7">[ + ] Option Identifiers</b><br>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" checked name="renameVariables">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Rename Variables <i data-bs-toggle="tooltip" data-bs-original-title="Xác định và thay thế tên biến." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="renameGlobals">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Rename Globals <i data-bs-toggle="tooltip" data-bs-original-title="Đổi tên các biến cấp cao nhất, hãy tắt tùy chọn này cho các đoạn mã liên quan đến trang web." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" checked name="movedDeclarations">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Moved Declarations <i data-bs-toggle="tooltip" data-bs-original-title="Di chuyển khai báo biến lên đầu ngữ cảnh." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" checked class="switch-input" name="calculator">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Calculator <i data-bs-toggle="tooltip" data-bs-original-title="Tạo một hàm tính toán để xử lý các biểu thức toán học và logic." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b class="h7">[ + ] Control-Flow</b><br>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="controlFlowFlattening">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Control Flow Flattening <i data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="⚠️ Có thể ảnh hưởng lớn đến hiệu suất, hãy sử dụng chỉ khi cần thiết!<br>Làm phẳng luồng điều khiển làm khó hiểu chương trình bằng cách tạo ra các câu lệnh switch phức tạp." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="dispatcher">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Dispatcher <i data-bs-toggle="tooltip" data-bs-original-title="Tạo ra một hàm trung gian để xử lý các lời gọi hàm." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="opaquePredicates">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Opaque Predicates <i data-bs-toggle="tooltip" data-bs-original-title="Một điều kiện ẩn (Opaque Predicate) được đánh giá tại thời gian chạy, điều này có thể làm khó khăn cho các chuyên gia deobfuscate phân tích code của bạn." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="deadCode">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Dead Code <i data-bs-toggle="tooltip" data-bs-original-title="Tiêm ngẫu nhiên mã chết vào code của bạn." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b class="h7">[ + ] Option Lock</b><br>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                        <input type="text" class="form-control" name="domainLock" placeholder="domain.com">
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                        <input type="text" class="form-control" name="osLock" placeholder="windows">
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                        <input type="text" class="form-control" name="browserLock" placeholder="chrome">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b class="h7">[ + ] Other Protection</b><br>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="selfDefending">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Self Defending <i data-bs-toggle="tooltip" data-bs-original-title="Ngăn chặn việc sử dụng các công cụ beautify hoặc formatter code trên mã của bạn." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="integrity">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Integrity <i data-bs-toggle="tooltip" data-bs-original-title="Integrity đảm bảo rằng mã nguồn không bị thay đổi." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="antiDebug">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Anti Debug - DevTools <i data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Thêm các câu lệnh debugger vào toàn bộ mã nguồn. <br>Đồng thời, thêm một hàm nền để phát hiện DevTools." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" checked name="duplicateLiteralsRemoval">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Duplicate Literals Removal <i data-bs-toggle="tooltip" data-bs-original-title="Loại bỏ các ký tự trùng lặp thay thế các ký tự trùng lặp bằng một tên biến duy nhất." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="shuffle">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Shuffles Hash <i data-bs-toggle="tooltip" data-bs-original-title="Xáo trộn thứ tự ban đầu của các mảng. Thứ tự sẽ được khôi phục về trạng thái ban đầu trong quá trình thực thi." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="switch switch-sm mt-2">
                                            <input type="checkbox" class="switch-input" name="stack">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="bx bx-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Stack JSCrambler <i data-bs-toggle="tooltip" data-bs-original-title="Các biến local được hợp nhất vào một mảng xoay vòng ( Giống Mã Hoá Của JSCrambler)." class="cursor-pointer ri-information-fill"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary"><i class="ri-send-plane-line"></i>&ensp;Obfuscate</button>
                                    &ensp;
                                    <button type="button" class="btn btn-primary clear-form-obf">
                                        <i class="ri-refresh-line me-2"></i>Đặt Lại </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
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
                                <button type="button" data-type-download="javascript" class="download-kq btn btn-primary">
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