<?php $options_header = ['title' => 'Tạo Bill Fake Số Dư ACB - Á Châu']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-sodu-acb hk-refresh-form space-y-6" enctype="multipart/form-data">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Số Dư ACB</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="15" for="ctk">Tên Chính <span
                                            class="cursor-pointer" data-nui-tooltip="Không được lấy họ và tên đệm"><i
                                                class="ri-question-line"></i></span></label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="ctk"
                                                placeholder="KHUONG" value="KHUONG" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="2" for="tendem">Tên Viết Tắt <span
                                            class="cursor-pointer"
                                            data-nui-tooltip="Lấy chữ cái đầu và chữ cái tên chính"><i
                                                class="ri-question-line"></i></span></label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="tendem"
                                                placeholder="Ví dụ: DK" value="DK" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-lg nui-has-icon">
                                    <label class="nui-input-label"
                                        for="color-bg">Màu Nền Avatar</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="color" list="eventColors" value="#9fde69"
                                                class="nui-input !h-11 !ps-11 appearance-none"
                                                placeholder="Hãy chọn 1 màu mà bạn muốn" name="color-bg">
                                            <div class="nui-input-icon !h-11 !w-11">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="icon nui-input-icon-inner" width="1em"
                                                    height="1em" viewBox="0 0 256 256">
                                                    <g fill="currentColor">
                                                        <path d="M208 144a80 80 0 0 1-80 80V16s80 56 80 128"
                                                            opacity=".2"></path>
                                                        <path
                                                            d="M174 47.75a254.2 254.2 0 0 0-41.45-38.3a8 8 0 0 0-9.18 0A254.2 254.2 0 0 0 82 47.75C54.51 79.32 40 112.6 40 144a88 88 0 0 0 176 0c0-31.4-14.51-64.68-42-96.25M56 144c0-50 42.26-92.71 64-111.4v182.94A72.08 72.08 0 0 1 56 144m80 71.54V32.6C157.74 51.29 200 94 200 144a72.08 72.08 0 0 1-64 71.54">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <datalist id="eventColors">
                                        <option value="#9fde69"></option>
                                        <option value="#22c55e"></option>
                                        <option value="#0ea5e9"></option>
                                        <option value="#6366f1"></option>
                                        <option value="#8b5cf6"></option>
                                        <option value="#d946ef"></option>
                                        <option value="#f43f5e"></option>
                                        <option value="#facc15"></option>
                                        <option value="#fb923c"></option>
                                        <option value="#9ca3af"></option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <div
                                        class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                                        <label class="nui-input-label" for="sodu" data-limit-text="17">Số Dư Khả
                                            Dụng</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền chuyển phải là một con số!" name="sodu"
                                                placeholder="Ví dụ: 35,124,521" value="35,124,521" required>
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
                                        <label class="nui-input-label" for="diemrewards" data-limit-text="9">Điểm ACB
                                            Rewards</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền chuyển phải là một con số!" name="diemrewards"
                                                placeholder="Ví dụ: 2,060" value="2,060" required>
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
                            <!-- <div class="col-span-1">
                            <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                <label class="nui-input-label" for="thoigianchuyen">Ảnh Đại Diện</label>
                                <div role="button" tabindex="-1" class="wt-upload-container">
                                    <div class="nui-focus border-muted-300 dark:border-muted-700 hover:border-muted-400 focus:border-muted-400 dark:hover:border-muted-600 dark:focus:border-muted-700 group cursor-pointer rounded-lg border-[3px] border-dashed p-8 transition-colors duration-300"
                                        tabindex="0" role="button">
                                        <div class="p-5 text-center"><svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon text-muted-400 group-hover:text-primary-500 group-focus:text-primary-500 mb-2 size-10 transition-colors duration-300" width="1em" height="1em" viewBox="0 0 24 24"
                                                data-v-b4402e20="">
                                                <path fill="currentColor"
                                                    d="M5.5 20A5.5 5.5 0 0 1 0 14.5A5.5 5.5 0 0 1 5.5 9c1-2.35 3.3-4 6-4c3.43 0 6.24 2.66 6.5 6.03l.5-.03c2.5 0 4.5 2 4.5 4.5S21 20 18.5 20zm0-10C3 10 1 12 1 14.5S3 19 5.5 19h13a3.5 3.5 0 0 0 3.5-3.5a3.5 3.5 0 0 0-3.5-3.5c-.56 0-1.1.13-1.57.37l.07-.87A5.5 5.5 0 0 0 11.5 6a5.51 5.51 0 0 0-5.31 4.05zm6.5 7v-5.25L14.25 14l.75-.66l-3.5-3.5l-3.5 3.5l.75.66L11 11.75V17z">
                                                </path>
                                            </svg>
                                            <h4 class="text-muted-400 font-sans text-sm"> Kéo và thả tệp vào đây </h4>
                                            <div><span
                                                    class="text-muted-400 font-sans text-[0.7rem] font-semibold uppercase">
                                                    Hoặc </span></div><label for="file"
                                                class="text-muted-400 group-hover:text-primary-500 group-focus:text-primary-500 cursor-pointer font-sans text-sm underline underline-offset-4 transition-colors duration-300">
                                                Chọn tệp </label>
                                        </div>
                                    </div>
                                    <input type="file" class="hidden" id="wt-upload">
                                </div>
                            </div>
                            </div> -->
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
                        <?=$Bill->Demo('Sodu-Acb');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>