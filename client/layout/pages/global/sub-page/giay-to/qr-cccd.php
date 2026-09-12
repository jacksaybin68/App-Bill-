<?php $options_header = ['title' => 'Fake QR-Code Căn Cước Công Dân Quét Được Qua Zalo Miễn Phí','description'=>'Tool fake qr code cccd quét được qua zalo miễn phí'];?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full w-md-10">
                <div class="container flex flex-col md:flex-row items-start md:items-center gap-5">
                    <form class="user-make-qr-cccd hk-refresh-form space-y-3 flex-1">
                        <form class="user-make-qr-cccd hk-refresh-form space-y-3">
                            <fieldset class="relative">
                                <div
                                    class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                                    <legend class="mb-6-none flex flex-col md:flex-row justify-between items-start">
                                        <div class="text-left">
                                            <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none">
                                                <i class="ri-bank-fill me-1"></i> Tạo QR-CCCD Zalo
                                            </p>
                                            <span
                                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">
                                                Hãy nhập đầy đủ thông tin để tạo ảnh
                                            </span>
                                        </div>
                                    </legend>
                                    <div id="panel-1">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div class="col-span-1">
                                                <div
                                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                                    <label class="nui-input-label" data-limit-text="33" for="hovaten">
                                                        Họ Và Tên
                                                        <span class="cursor-pointer"
                                                            data-nui-tooltip="Họ và tên phải viết có dấu và full in hoa"><i
                                                                class="ri-question-line"></i></span></label>
                                                    <div class="nui-input-outer">
                                                        <div>
                                                            <input type="text" class="nui-input" name="hovaten"
                                                                placeholder="Ví dụ: NGUYỄN VĂN A" value="NGUYỄN VĂN A"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <div
                                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                                    <label class="nui-input-label" data-limit-text="10" for="ngaysinh">
                                                        Ngày
                                                        Sinh</label>
                                                    <div class="nui-input-outer">
                                                        <div>
                                                            <input type="date" class="nui-input" name="ngaysinh"
                                                                value="29/07/1990" placeholder="eg: 21/08/2000"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <div
                                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                                    <label class="nui-input-label" data-limit-text="14" for="so-cccd"> Số
                                                        CCCD | <span target-modal="#huongdan-cccd"
                                                            class="text-warning-600 cursor-pointer">Bấm vào đây để tìm
                                                            hiểu</span></label>
                                                    <div class="nui-input-outer">
                                                        <div>
                                                            <input type="text" class="nui-input" name="so-cccd"
                                                                value="0402 0302 5635"
                                                                placeholder="eg: 0402 0302 5635"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <div
                                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                                    <label class="nui-input-label" data-limit-text="11" for="so-cmnd"> Số
                                                        CMND</label>
                                                    <div class="nui-input-outer">
                                                        <div>
                                                            <input type="text" class="nui-input" name="so-cmnd"
                                                                value="504 898 806"
                                                                placeholder="eg: 504 898 806"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <div
                                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                                    <label class="nui-input-label" data-limit-text="100"
                                                        for="noithuongtru">Nơi
                                                        Thường Trú</label>
                                                    <div class="nui-input-outer">
                                                        <div>
                                                            <input type="text" class="nui-input" name="noithuongtru"
                                                                value="33/2 Tổ 8 Hoà Thành, Tp. Cà Mau, Cà Mau"
                                                                placeholder="eg: 33/2 Tổ 8 Hoà Thành, Tp. Cà Mau, Cà Mau"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-1">
                                                <div
                                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                                    <label class="nui-input-label" data-limit-text="10"
                                                        for="ngaycap"> Ngày
                                                        Hết Hạn</label>
                                                    <div class="nui-input-outer">
                                                        <div>
                                                            <input type="date" class="nui-input" name="ngaycap"
                                                                value="26/12/3032" placeholder="eg: 26/12/3032"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="action" value="user-make-qr-cccd">
                                    <div
                                        class="mt-auto flex flex-col-reverse text-end md:block md:space-x-3 gap-2 text-nowrap">
                                        <button type="button"
                                            class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-muted w-full sm:w-32 clear-form">
                                            <i class="ri-refresh-line me-2"></i>Làm Mới
                                        </button>
                                        <button type="submit"
                                            class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-primary w-full sm:w-32">
                                            <i class="ri-check-line me-2"></i>Xác Nhận
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                </div>
            </div>
            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div
                        class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('CCCD-QRCode');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center modal z-[200] hidden select-none"
        id="huongdan-cccd">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div
                class="dark:bg-muted-800 w-full bg-white text-left align-middle shadow-xl transition-all rounded-md max-w-xl z-[9999]">
                <div class="flex w-full items-center justify-between p-4">
                    <h3 class="text-gray-900 text-lg font-medium"><i class="ri-question-line"></i> Giải Thích Số Căn
                        Cước
                    </h3>
                    <button type="button"
                        class="nui-button-close nui-button-sm nui-button-rounded-full nui-button-default close-modal">
                        <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-button-icon">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="w-full items-center gap-x-2 justify-top">
                    <div class="p-4">
                        <strong style="color:#6576ff">[+] Hướng dẫn nhập số cccd để quét mã ra đúng giới tính.</strong>
                        <ul class="mt-2">
                            <li class="fs-14px">• Hãy biết căn cước có tối đa 12 số, trong đó 3 số đầu tiên của 12 số
                                chính là mã tỉnh/thành nơi mà công dân đăng ký khai sinh.</li>
                            <li class="fs-14px mt-1">• Bấm <a style="color:#6576ff"
                                    href="https://thuvienphapluat.vn/chinh-sach-phap-luat-moi/vn/ho-tro-phap-luat/tu-van-phap-luat/50225/tra-cuu-ma-63-tinh-thanh-tren-the-can-cuoc-cong-dan-3-so-dau-the-can-cuoc-cong-dan"
                                    target="_blank">vào đây</a> để xem danh sách mã số tỉnh thành.</li>
                            <li class="fs-14px mt-1">• 1 số tiếp theo <span class="font-semibold">(tức số thứ 4 của 12
                                    số)</span> đó là mã giới tính | công dân nào sinh năm từ 1900 -> 1999 sẽ được tính
                                là 0 là Nam/ 1 là Nữ | Còn công dân sinh năm 2000 trở lên thì 2 là Nam/ 3 là Nữ.</li>
                            <li class="fs-14px mt-1">• 2 số kế tiếp <span class="font-semibold">(sau mã số giới
                                    tính)</span> đó là số năm sinh <span class="font-semibold">(lấy 2 số cuối năm
                                    sinh)</span> | Ví dụ công dân sinh năm 1999 thì sẽ lấy 2 số cuối là 99.</li>
                            <li class="fs-14px mt-1">• 6 số cuối cùng là mã ngẫu nhiên.</li>
                        </ul>
                        <div
                            class="border-muted-200 dark:border-muted-700 mb-4 space-y-5 border-b-2 border-dashed px-4 pb-4">
                        </div>
                        <strong class="mt-6" style="color:#fb6205">[-] Ví dụ công dân thế kỉ 20.</strong>
                        <ul class="mt-2">
                            <li class="fs-14px">• Công dân sinh ngày 13/06/1997, thì số cccd sẽ là 3 số mã tĩnh+1 số
                                giới tính+2 số năm sinh+6 số ngẫu nhiên sẽ thành: <b
                                    style="color: red;">086097982876</b></li>
                        </ul>
                        <div
                            class="border-muted-200 dark:border-muted-700 mb-4 space-y-5 border-b-2 border-dashed px-4 pb-4">
                        </div>
                        <strong class="mt-6" style="color:#fb6205">[-] Ví dụ công dân thế kỉ 21.</strong>
                        <ul class="mt-2">
                            <li class="fs-14px">• Công dân sinh ngày 13/06/2002, thì số cccd sẽ là 3 số mã tĩnh+1 số
                                giới tính+2 số năm sinh+6 số ngẫu nhiên sẽ thành: <b
                                    style="color: red;">086203982876</b></li>
                        </ul>
                    </div>
                    <div class="flex w-full items-center gap-x-2 justify-end p-4">
                        <div class="flex gap-x-2">
                            <button type="button" target-modal="close"
                                class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-default"><i
                                    class="ri-close-line me-2"></i>Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>