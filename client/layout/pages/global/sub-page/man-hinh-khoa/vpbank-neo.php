<?php $options_header = ['title' => 'Tạo Bill Fake VPBank Neo Biến Động Màn Hình Khoá']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-vpbankneo-man-hinh-khoa hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill VPBank Neo Màn Hình Khoá</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="50" for="tenctk">Tên Chủ Tài
                                        Khoản</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="tenctk"
                                                placeholder="NGUYEN VAN B" value="NGUYEN VAN B" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="20" for="stk">Số Tài Khoản</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stk"
                                                placeholder="Ví dụ: 10&lt;?=WsRandomString::Number(9)?&gt;"
                                                value="10239821021" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="20" for="sotaikhoan">Số Tài Khoản
                                        Người Nạp</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="sotk" disabled
                                                value="19959121">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="tennguoinoap">Tên Người Nạp</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="tennguoinoap"
                                                placeholder="NGUYEN VAN A" disabled value="NGUYEN SY TAM">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="10" for="sotien">Số Tiền Manipulate</label>
                                    <div class="nui-input-outer">
                                        <span><b id="sb"></b></span>
                                        <div>
                                            <input type="hidden" id="st" value="10000">
                                            <input type="range" id="sl" min="10000" step="10000" value="1000000"
                                                class="w-full mt-2" Max="99999999999">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="25" for="noidung">Nội Dung</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="noidung" disabled
                                                value="<?=htmlspecialchars($TD->Setting('cuphap-naptien'), ENT_QUOTES, 'UTF-8')?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 flex flex-col gap-4 mt-12">
                            <div>
                                <button type="submit" class="nui-button nui-button-lg nui-button-primary w-full"><i
                                        class="ri-haze-fill me-1"></i> Lấy Màn Hình Khoá</button>
                            </div>
                            <div>
                                <a href="javascript:;" onclick="history.back()" class="nui-button w-full"><i
                                        class="ri-arrow-left-s-line me-1"></i> Quay Lại</a>
                                <a href="/fake-bill/man-hinh-khoa" class="nui-button w-full"><i
                                        class="ri-arrow-right-s-line me-1"></i> Danh Sách Bank</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="w-full md:w-1/4">
                <div class="space-y-4">
                    <h3 class="nui-heading nui-heading-lg nui-weight-bold nui-lead-normal text-muted-800 dark:text-muted-100">Thông
                        Tin Ngân Hàng</h3>
<?php
echo '&lt;div class="nui-card nui-card-rounded-lg nui-card-default p-3 font-heading text-xs font-semibold text-muted-400 text-left"&gt;';
echo '&lt;b style="font-size:14px;font-weight:700;"&gt;| VPBank Neo&lt;/b&gt;&lt;br&gt;';
echo 'STK: &lt;b id="nctk"&gt;10239821021&lt;/b&gt; | Chủ TK: &lt;b id="nctk1"&gt;NGUYEN VAN A&lt;/b&gt;&lt;br&gt;';
echo 'VietQR API: &lt;a href="https://api.viqr.net/?sdt=0935825098&name=NGUYEN%20VAN%20A&mm=1.500.000&banks=VPBank&amount=999999" target="_blank" class="text-danger-500"&gt;Truy cập&lt;/a&gt;&lt;br&gt;';
echo 'Ngân Hàng: &lt;b&gt;VPBank Neo&lt;/b&gt;&lt;br&gt;';
echo 'Tên gốc: &lt;b&gt;VPBank (VPB) / NGUYEN VAN (A) / NGUYEN VAN A&lt;/b&gt;';
echo '&lt;/div&gt;';
?>
                </div>

                <div class="nui-card nui-card-rounded-lg nui-card-default mt-6 select-none">
                    <h2 class="nui-heading nui-heading-md nui-weight-bold nui-lead-normal text-muted-800 dark:text-muted-100 flex items-center gap-2">
                        <i class="ri-cursor-click-fill text-danger-500"></i> Hướng Dẫn Sử Dụng
                    </h2>
                    <div class="font-mono text-xs leading-relaxed nui-content-sm text-muted-400">
                        <p><b>- Đầu tiên:</b> Sao lưu toàn bộ dữ liệu nếu có dữ liệu cũ.</p>
                        <p><b>- Thứ hai:</b> Đặt tên chủ tài khoản &amp; mota chuẩn</p>
                        <p><b>- Thứ ba:</b> Nhập số tiền → Generate hình ảnh</p>
                        <p><b>- Hình ảnh sinh ra có thể xem trước:</b> Ảnh preview</p>
                        <p><b>- Download ảnh:</b> Bấm "Download File"</p>
                        <p><b>- Quay lại:</b> Danh sách bank</p>
                        <p><b>- Email:</b> mrjack6789@gmail.com | Telegram: @mrjack6789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>
