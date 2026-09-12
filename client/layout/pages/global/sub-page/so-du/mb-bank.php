<?php $options_header = ['title' => 'Tạo Bill Fake Số Dư MB Bank']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-sodu-mbbank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Số Dư MB Bank</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <div
                                        class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                                        <label class="nui-input-label" for="sodu" data-limit-text="14">Số Dư Chính <span class="cursor-pointer" data-nui-tooltip-position="right" data-nui-tooltip="Đây là chỉ MB Thường nên đừng có fake lố quá."><i class="ri-question-line"></i></span></label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền chuyển phải là một con số!" name="sodu"
                                                placeholder="Ví dụ: 100,000,000" value="100,000,000" required>
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
                                    <label class="nui-select-label" for="gd">Chọn Nền Giao Diện</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="gd">
                                        <option value="1" selected>(1) MB - Mặc Định</option>
                                            <option value="2">(2) MB - Cánh Én Mùa Xuân</option>
                                            <option value="3">(3) MB - Dịu Dàng</option>
                                            <option value="4">(4) MB - Mèo Thần Tài</option>
                                            <option value="5">(5) MB - Monday Mood</option>
                                            <option value="6">(6) MB - Năm Mới Rực Rỡ</option>
                                            <option value="7">(7) MB - Nhịp Đập Sân Cỏ</option>
                                            <option value="8">(8) MB - Tiến Bước Vững Vàng</option>
                                            <option value="9">(9) MB - Tự Hào Việt Nam</option>
                                            <option value="10">(10) MB - Hi Green</option>
                                            <option value="11">(11) MB - Khát Vọng Vươn Cao</option>
                                            <option value="12">(12) MB - Bình An</option>
                                            <option value="13">(13) MB - Be The Sky</option>
                                            <option value="14">(14) MB - Sweet Love</option>
                                            <option value="15">(15) MB - Khám Phá</option>
                                            <option value="16">(16) MB - Phố Làng</option>
                                            <option value="17">(17) MB - Chinh Phục Đỉnh Cao</option>
                                            <option value="18">(18) MB - Pickleball</option>
                                            <option value="19">(19) MB - Dream Big</option>
                                            <option value="20">(20) MB - Trẻ Trung</option>
                                            <option value="21">(21) MB - Trường Sa Xanh</option>
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
                    <div class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('Sodu-MbBank');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>