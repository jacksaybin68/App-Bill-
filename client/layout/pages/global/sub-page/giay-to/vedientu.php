<?php $options_header = ['title' => 'Tạo Fake Vé Điện Tử']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-fake-vedientu hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Fake Vé Điện Tử</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo vé điện tử</span>
                            </legend>
                            
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="7" for="madonhang">Mã đơn hàng</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="madonhang"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(6)?>" value="<?=WsRandomString::Number(6)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="quydanh">Quý danh</label>
                                    <div class="nui-select-outer">
                                    <select class="nui-select" name="quydanh">
                                    <option value="Ông">Ông</option>
                                    <option value="Bà">Bà</option>
                                    </select>
                                        <div class="nui-select-icon">
                                        <i class="ri-docs-fill"></i>
                                        </div>
                                        <div class="nui-select-chevron nui-chevron">
                                            <svg aria-hidden="true" viewBox="0 0 24 24"
                                                class="nui-select-chevron-inner">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="hoten">Họ tên</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="hoten"
                                                placeholder="Ví dụ: NGUYEN VAN B" value="NGUYEN VAN B" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="15" for="sove">Số vé</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="sove"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(13)?>" value="<?=WsRandomString::Number(13)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="hanhlysachtay">Trọng lượng hành lí xác tay (kg)</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="hanhlysachtay"
                                                placeholder="Ví dụ: 10" value="10 kg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="hanhlykygui">Hành lý ký gửi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="hanhlykygui"
                                                placeholder="Ví dụ: 1 kiện 20 kg" value="1 kiện 20 kg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="loaive">Loại vé</label>
                                    <div class="nui-select-outer">
                                    <select class="nui-select" name="loaive">
                                    <option value="Phổ thông tiết kiệm">Phổ thông tiết kiệm</option>
                                    <option value="Thương gia">Thương gia</option>
                                    </select>
                                        <div class="nui-select-icon">
                                        <i class="ri-docs-fill"></i>
                                        </div>
                                        <div class="nui-select-chevron nui-chevron">
                                            <svg aria-hidden="true" viewBox="0 0 24 24"
                                                class="nui-select-chevron-inner">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="sanbaynoiden">Sân bay nơi đến</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="sanbaynoiden"
                                                placeholder="Ví dụ: Thọ Xuân" value="Thọ Xuân" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="sanbaynoidi">Sân bay nơi đi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="sanbaynoidi"
                                                placeholder="Ví dụ: Tân Sơn Nhất" value="Tân Sơn Nhất" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $thu = [
                                'Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'
                            ];
                            ?>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="40" for="gioden">Giờ đến</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="gioden"
                                                placeholder="Ví dụ: <?=date('H:i') . ' ' . $thu[date('w')] . ', ' . date('d-m-Y')?>" value="<?=date('H:i') . ' ' . $thu[date('w')] . ', ' . date('d-m-Y')?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $thu = [
                                'Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'
                            ];
                            ?>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="40" for="giodi">Giờ đi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="giodi"
                                                placeholder="Ví dụ: <?=date('H:i') . ' ' . $thu[date('w')] . ', ' . date('d-m-Y')?>" value="<?=date('H:i') . ' ' . $thu[date('w')] . ', ' . date('d-m-Y')?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="madatcho">Mã đặt chỗ</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="madatcho"
                                                placeholder="Ví dụ: <?=WsRandomString::str(6)?>" value="<?=WsRandomString::str(6)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="noidi">Nơi đi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="noidi"
                                                placeholder="Ví dụ: Tp Hồ Chí Minh" value="Tp Hồ Chí Minh" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="noiden">Nơi đến</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="noiden"
                                                placeholder="Ví dụ: Thanh Hoá" value="Thanh Hoá" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="thoigianbay">Thời gian bay</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="thoigianbay"
                                                placeholder="Ví dụ: 02h 05m" value="02h 05m" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="sohieuchuyenbay">Số hiệu chuyến bay</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="sohieuchuyenbay"
                                                placeholder="Ví dụ: VN<?=WsRandomString::Number(4)?>" value="VN<?=WsRandomString::Number(4)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/vip.status.php');?>
                            <div class="col-span-1">
                            </div>
                            <button type="submit"
                                        class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-primary w-full sm:w-32">
                                        <i class="ri-check-line me-2"></i>Tạo Ngay
                                    </button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('https://files.catbox.moe/wa67vq.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>