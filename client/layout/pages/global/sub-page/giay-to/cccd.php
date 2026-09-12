<?php $options_header = ['title' => 'Fake Căn Cước Công Dân - CCCD Nam Nữ 2 Mặt','description'=>'Tool fake cccd nam nữ 2 mặt online nhanh mà không cần phải sử dụng công cụ photoshop.']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/5">
                <fieldset class="relative">
                    <div
                        class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                        <legend class="mb-6-none flex flex-col md:flex-row justify-between items-start">
                            <div class="text-left">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none">
                                    <i class="ri-bank-fill me-1"></i> Tạo Bill Giấy Tờ Căn Cước
                                </p>
                                <span class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">
                                    Hãy nhập đầy đủ thông tin để tạo bill
                                </span>
                            </div>
                            <div
                                class="mt-4 md:mt-0 md:ml-auto flex items-center gap-2 justify-center md:justify-start w-full md:w-auto">
                                <button type="button" class="nui-button-action nui-button-success nui-button-rounded-sm"
                                    data-togger-panel="#panel-1">
                                    <i class="ri-arrow-drop-down-line"></i>
                                    <span>Mặt Trước</span>
                                </button>
                                <button type="button" class="nui-button-action nui-button-default nui-button-rounded-sm"
                                    data-togger-panel="#panel-2">
                                    <i class="ri-subtract-line"></i>
                                    <span>Mặt Sau</span>
                                </button>
                            </div>
                        </legend>
                        <div id="panel-1">
                            <form class="hk-fake-cccd hk-refresh-form space-y-3" enctype="multipart/form-data">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="33" for="hovaten"> Họ Và Tên
                                                <span class="cursor-pointer"
                                                    data-nui-tooltip="Họ và tên phải viết có dấu và full in hoa"><i
                                                        class="ri-question-line"></i></span></label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="hovaten"
                                                        placeholder="Ví dụ: NGUYỄN VĂN A" value="NGUYỄN VĂN A" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                            <label class="nui-select-label" for="gioitinh">Giới Tính</label>
                                            <div class="nui-select-outer">
                                                <select class="nui-select" name="gioitinh">
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                </select>
                                                <div class="nui-select-chevron nui-chevron">
                                                    <svg aria-hidden="true" viewBox="0 0 24 24"
                                                        class="nui-select-chevron-inner">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="10" for="ngaysinh"> Ngày
                                                Sinh</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="ngaysinh"
                                                        value="29/07/1990" placeholder="eg: 21/08/2000" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="12" for="socccd"> Số
                                                CCCD | <span target-modal="#huongdan-cccd"
                                                    class="text-warning-600 cursor-pointer">Bấm vào đây để tìm
                                                    hiểu</span></label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="number" class="nui-input" name="socccd"
                                                        value="0<?=WsRandomString::Number(2).rand(0,1).rand(50,99).WsRandomString::Number(6)?>"
                                                        placeholder="eg: 0<?=WsRandomString::Number(2).rand(0,1).rand(50,99).WsRandomString::Number(6)?>"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="40" for="quequan">Quê
                                                Quán</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="quequan"
                                                        value="Hoà Thành, Tp. Cà Mau, Cà Mau"
                                                        placeholder="eg: Hoà Thành, Tp. Cà Mau, Cà Mau" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="50" for="thuongtru">Nơi
                                                Thường Trú</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="thuongtru"
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
                                            <label class="nui-input-label" data-limit-text="10" for="ngayhethan"> Ngày
                                                Hết Hạn</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="ngayhethan"
                                                        value="26/12/3032" placeholder="eg: 26/12/3032" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="12" for="quoctich"> Quốc
                                                Tịch</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="quoctich"
                                                        value="Việt Nam" placeholder="eg: Việt Nam" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                        <label class="nui-input-label" for="thoigianchuyen">
                                            Ảnh Thẻ Căn Cước / Tạo ảnh
                                            thẻ <a class="text-warning-600"
                                                href="https://taoanhdep.com/cong-cu-tao-anh-the-online/"
                                                target="_blank">tại đây</a> (chọn nền trắng - kích thước
                                            3x4)</label>
               
                                        <div role="button" tabindex="-1" class="wt-upload-container">
                                            <div class="nui-focus border-muted-300 dark:border-muted-700 hover:border-muted-400 focus:border-muted-400 dark:hover:border-muted-600 dark:focus:border-muted-700 group cursor-pointer rounded-lg border-[3px] border-dashed p-8 transition-colors duration-300"
                                                tabindex="0" role="button">
                                                <div class="p-5 text-center"><svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                        role="img"
                                                        class="icon text-muted-400 group-hover:text-primary-500 group-focus:text-primary-500 mb-2 size-10 transition-colors duration-300"
                                                        width="1em" height="1em" viewBox="0 0 24 24" data-v-b4402e20="">
                                                        <path fill="currentColor"
                                                            d="M5.5 20A5.5 5.5 0 0 1 0 14.5A5.5 5.5 0 0 1 5.5 9c1-2.35 3.3-4 6-4c3.43 0 6.24 2.66 6.5 6.03l.5-.03c2.5 0 4.5 2 4.5 4.5S21 20 18.5 20zm0-10C3 10 1 12 1 14.5S3 19 5.5 19h13a3.5 3.5 0 0 0 3.5-3.5a3.5 3.5 0 0 0-3.5-3.5c-.56 0-1.1.13-1.57.37l.07-.87A5.5 5.5 0 0 0 11.5 6a5.51 5.51 0 0 0-5.31 4.05zm6.5 7v-5.25L14.25 14l.75-.66l-3.5-3.5l-3.5 3.5l.75.66L11 11.75V17z">
                                                        </path>
                                                    </svg>
                                                    <h4 class="text-muted-400 font-sans text-sm"> Kéo và thả tệp vào
                                                        đây - Yêu cầu file dưới 2MB </h4>
                                                    <div><span
                                                            class="text-muted-400 font-sans text-[0.7rem] font-semibold uppercase">
                                                            Hoặc </span></div><label for="file"
                                                        class="text-muted-400 group-hover:text-primary-500 group-focus:text-primary-500 cursor-pointer font-sans text-sm underline underline-offset-4 transition-colors duration-300">
                                                        Chọn tệp </label>
                                                </div>
                                            </div>
                                            <input type="file" accept="image/*" class="hidden" id="wt-upload">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="fake-cccd">
                                <input type="hidden" name="loai" value="cccd-mat-truoc">
                                <div
                                    class="mt-auto flex flex-col-reverse text-end md:block md:space-x-3 gap-2 text-nowrap">
                                    <button type="button"
                                        class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-muted w-full sm:w-32 clear-form">
                                        <i class="ri-refresh-line me-2"></i>Làm Mới
                                    </button>
                                    <button type="submit"
                                        class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-primary w-full sm:w-32">
                                        <i class="ri-check-line me-2"></i>Tạo Ngay
                                    </button>
                                </div>
                        </div>
                        </form>
                        <!--MẶT SAU-->
                        <div id="panel-2" class="hidden">
                            <form class="hk-fake-cccd hk-refresh-form space-y-3" enctype="multipart/form-data">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="40" for="dacdiem-nhandang">
                                                Đặc Điểm Nhận Dạng</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="dacdiem-nhandang"
                                                        value="Nốt ruồi C: 3cm trên sau mép phải"
                                                        placeholder="eg: Nốt ruồi C: 3cm trên sau mép phải" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="10" for="ngaylam-cccd"> Ngày
                                                Làm Căn Cước</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="ngaylam-cccd"
                                                        value="20/04/2022" placeholder="eg: 20/04/2022" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="17" for="tencuctruong"> Tên
                                                Cục Trưởng</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input" name="tencuctruong"
                                                        value="Tô Văn Huệ" placeholder="eg: Tô Văn Huệ" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="37" for="tencuctruong"> Họ
                                                Và Tên (MRZ)</label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="text" class="nui-input td-format-text" name="mrz"
                                                        value="NGUYEN<<VAN<A" placeholder="eg: NGUYEN<<VAN<A" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-full">
                                        <div
                                            class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                            <label class="nui-input-label" data-limit-text="12" for="socccd"> Số
                                                CCCD | <span target-modal="#huongdan-cccd"
                                                    class="text-warning-600 cursor-pointer">Bấm vào đây để tìm
                                                    hiểu</span></label>
                                            <div class="nui-input-outer">
                                                <div>
                                                    <input type="number" class="nui-input" name="socccd"
                                                        value="0<?=WsRandomString::Number(2).rand(0,1).rand(50,99).WsRandomString::Number(6)?>"
                                                        placeholder="eg: 0<?=WsRandomString::Number(2).rand(0,1).rand(50,99).WsRandomString::Number(6)?>"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <input type="hidden" name="action" value="fake-cccd">
                                <input type="hidden" name="loai" value="cccd-mat-sau">
                                <div
                                    class="mt-auto flex flex-col-reverse text-end md:block md:space-x-3 gap-2 text-nowrap">
                                    <button type="button"
                                        class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-muted w-full sm:w-32 clear-form">
                                        <i class="ri-refresh-line me-2"></i>Làm Mới
                                    </button>
                                    <button type="submit"
                                        class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-primary w-full sm:w-32">
                                        <i class="ri-check-line me-2"></i>Tạo Ngay
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </fieldset>
            </div>
            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div
                        class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('CCCD-MatTruoc');?>
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
                                    số)</span> đó là mã giới tính | công dân nào sinh năm từ 1900 -> 1999 sẽ được tính 0 là Nam/ 1 là Nữ | Còn công dân sinh năm 2000 trở lên thì 2 là Nam/ 3 là Nữ.</li>
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