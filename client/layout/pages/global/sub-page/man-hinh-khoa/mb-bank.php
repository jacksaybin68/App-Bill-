<?php $options_header = ['title' => 'Tạo Bill Fake MB Bank Biến Động Màn Hình Khoá']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-mbbank-man-hinh-khoa hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill MB Bank Màn Hình Khoá</p>
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
                                    <label class="nui-input-label" data-limit-text="30" for="stk">Số Tài Khoản Người
                                        Nhận/Gửi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stk"
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                value="10239821021" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <div
                                        class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                                        <label class="nui-input-label" for="sotien" data-limit-text="30">Số Tiền
                                            Nhận/Trừ</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền phải là một con số!" name="sotien"
                                                placeholder="Ví dụ: 10,000,000" value="10,000,000" required>
                                            <div class="nui-input-number-buttons">
                                                <button type="button" btn="destroy"><i
                                                        class="ri-close-line"></i></button>
                                                <button type="button" btn="minus"><i
                                                        class="ri-subtract-line"></i></button>
                                                <button type="button" btn="plus"><i class="ri-add-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <div
                                        class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                                        <label class="nui-input-label" for="soduchinh" data-limit-text="30">Số Dư Của
                                            Bạn</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền chuyển phải là một con số!" value="50,000,000"
                                                name="soduchinh" placeholder="Ví dụ: 50,000,000">
                                            <div class="nui-input-number-buttons">
                                                <button type="button" btn="destroy"><i
                                                        class="ri-close-line"></i></button>
                                                <button type="button" btn="minus"><i
                                                        class="ri-subtract-line"></i></button>
                                                <button type="button" btn="plus"><i class="ri-add-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="cachthuc">Cách Thức</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="cachthuc">
                                            <option value="-">Trừ Tiền</option>
                                            <option value="+" selected>Nhận Tiền</option>
                                        </select>
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="logomb">Loại Logo</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="logomb">
                                            <option value="1">MB Bank Thường</option>
                                            <option value="2" selected>MB Bank Tết</option>
                                        </select>
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="nhamang">Nhà Mạng</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nhamang">
                                            <option value="Viettel">Viettel</option>
                                            <option value="Vinaphone">Vinaphone</option>
                                            <option value="Mobiphone">Mobiphone</option>
                                            <option value="Vietnamobile">Vietnamobile</option>
                                            <option value="iTel">iTel</option>
                                        </select>
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
                                    <label class="nui-input-label" data-limit-text="15" for="thoigianthongbao">Thời Gian
                                        Thông Báo</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="thoigianthongbao"
                                                placeholder="Ví dụ: bây giờ hoặc 1 phút trước" value="bây giờ" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="thoigiantrenmanhinh">Thời
                                        Gian Trên Màn Hình</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="thoigiantrenmanhinh"
                                                placeholder=""
                                                value="<?= (['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'])[date('w')].', '.date('d').' tháng '.(int)date('m'); ?>"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="18" for="magiaodich">Mã Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="magiaodich"
                                                placeholder="Ví dụ: FT<?=WsRandomString::Number(16)?>"
                                                value="FT<?=WsRandomString::Number(16)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="18" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('H:i - d/m/Y')?>"
                                            placeholder="Ví dụ: <?=date('H:i - d/m/Y')?>" required>
                                        <div class="nui-input-icon">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="5" for="thoigianchuyen">Thời Gian
                                        Trên
                                        ĐT </label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigiantrendt"
                                            value="<?=date('H:i')?>" placeholder="Ví dụ: 00:00" required>
                                        <div class="nui-input-icon">
                                            <i class="ri-time-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label class="nui-label text-[0.825rem]" for="noidung" data-limit-text="70">Nội
                                    Dung</label>
                                <div
                                    class="nui-textarea-wrapper nui-textarea-default nui-textarea-md nui-textarea-rounded-sm nui-textarea-not-resize">
                                    <div class="nui-textarea-outer">
                                        <textarea class="nui-textarea" name="noidung" rows="3"
                                            placeholder="Ví dụ: VI YEU MA DEN chuyen tien"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" for="anhnen">Ảnh Nền Màn Hình Khoá <span class="text-danger-400">( Trảnh ảnh nền tối và sẫm màu )</span>
                                    </br></br><span class="text-danger-400">- Yêu cầu file ảnh dưới dưới 2MB, có thể nén ảnh trước trên Google</span></label>
                                    <div role="button" tabindex="-1" class="wt-upload-container">
                                        <div class="nui-focus border-muted-300 dark:border-muted-700 hover:border-muted-400 focus:border-muted-400 dark:hover:border-muted-600 dark:focus:border-muted-700 group cursor-pointer rounded-lg border-[3px] border-dashed p-8 transition-colors duration-300"
                                            tabindex="0" role="button">
                                            <div class="p-5 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img"
                                                    class="icon text-muted-400 group-hover:text-primary-500 group-focus:text-primary-500 mb-2 size-10 transition-colors duration-300"
                                                    width="1em" height="1em" viewBox="0 0 24 24" data-v-b4402e20="">
                                                    <path fill="currentColor"
                                                        d="M5.5 20A5.5 5.5 0 0 1 0 14.5A5.5 5.5 0 0 1 5.5 9c1-2.35 3.3-4 6-4c3.43 0 6.24 2.66 6.5 6.03l.5-.03c2.5 0 4.5 2 4.5 4.5S21 20 18.5 20zm0-10C3 10 1 12 1 14.5S3 19 5.5 19h13a3.5 3.5 0 0 0 3.5-3.5a3.5 3.5 0 0 0-3.5-3.5c-.56 0-1.1.13-1.57.37l.07-.87A5.5 5.5 0 0 0 11.5 6a5.51 5.51 0 0 0-5.31 4.05zm6.5 7v-5.25L14.25 14l.75-.66l-3.5-3.5l-3.5 3.5l.75.66L11 11.75V17z">
                                                    </path>
                                                </svg>
                                                <h4 class="text-muted-400 font-sans text-sm"> Kéo và thả tệp vào đây
                                                </h4>
                                                <div><span
                                                        class="text-muted-400 font-sans text-[0.7rem] font-semibold uppercase">
                                                        Hoặc </span></div>
                                                <label for="wt-upload"
                                                    class="text-muted-400 group-hover:text-primary-500 group-focus:text-primary-500 cursor-pointer font-sans text-sm underline underline-offset-4 transition-colors duration-300">
                                                    Chọn tệp
                                                </label>
                                            </div>
                                        </div>
                                        <input type="file" accept="image/*" class="hidden" id="wt-upload">
                                    </div>
                                </div>
                            </div>
                            <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/vip.status.php');?>
                            <div class="col-span-1">
                                <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/modal/bill-setting.php');?>
                            </div>
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/taobill.php');?>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div
                        class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('https://files.catbox.moe/mhxt35.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>