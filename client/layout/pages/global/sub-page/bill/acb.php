<?php $options_header = ['title' => 'Tạo Bill Fake ACB Bank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-acb hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill ACB Bank</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="23" for="tennguoichuyen">Tên Người Chuyển</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="tennguoichuyen"
                                                placeholder="NGUYEN VAN A" value="NGUYEN VAN A" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="9" for="stk_nc">Số Tài Khoản Người
                                    Chuyển</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stk_nc"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(9)?>"
                                                value="13982021" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="23" for="tennguoinhan">Tên Người Nhận</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="tennguoinhan"
                                                placeholder="NGUYEN VAN B" value="NGUYEN VAN B" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="20" for="stk">Số Tài Khoản Người
                                        Nhận</label>
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
                                        <label class="nui-input-label" for="sotienchuyen" data-limit-text="20">Số Tiền
                                            Chuyển</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền chuyển phải là một con số!" name="sotienchuyen"
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
                            <div class="col-span-1" id="nganhangnhan">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
                                        <option data-bank="vietinbank" value="VIETINBANK - NH TMCP CONG THUONG">VIETINBANK - NH TMCP CONG THUONG</option>
                                    <option data-bank="vietcombank" value="VIETCOMBANK - NH TMCP NGOAI THUONG">VIETCOMBANK - NH TMCP NGOAI THUONG</option>
                                    <option data-bank="bidv" value="BIDV - NH TMCP DAU TU VA PHAT TRIEN VN">BIDV - NH TMCP DAU TU VA PHAT TRIEN VN</option>
                                    <option data-bank="agribank" value="AGRIBANK - NH NONG NGHIEP VA PHAT TRIEN NONG THON">AGRIBANK - NH NONG NGHIEP VA PHAT TRIEN NONG THON</option>
                                    <option data-bank="ocb" value="OCB - NH TMCP PHUONG DONG">OCB - NH TMCP PHUONG DONG</option>
                                    <option data-bank="mbbank" value="MB - NH TMCP QUAN DOI">MB - NH TMCP QUAN DOI</option>
                                    <option data-bank="acbbank" value="ACB - NH TMCP A CHAU">ACB - NH TMCP A CHAU</option>
                                    <option data-bank="vpbank" value="VPBANK - NH TMCP VIET NAM THINH VUONG">VPBANK - NH TMCP VIET NAM THINH VUONG</option>
                                    <option data-bank="tpbank" value="TPBANK - NH TMCP TIEN PHONG">TPBANK - NH TMCP TIEN PHONG</option>
                                    <option data-bank="scb" value="SACOMBANK - NH TMCP SAI GON THUONG TIN">SACOMBANK - NH TMCP SAI GON THUONG TIN</option>
                                    <option data-bank="shb" value="SHB - NH TMCP SAI GON - HA NOI">SHB - NH TMCP SAI GON - HA NOI</option>
                                    <option data-bank="sgb" value="SAIGONBANK - NH TMCP SAI GON CONG THUONG">SAIGONBANK - NH TMCP SAI GON CONG THUONG</option>
                                    <option data-bank="oceanbank" value="OCEANBANK - NH TMCP DAI DUONG">OCEANBANK - NH TMCP DAI DUONG</option>
                                    <option data-bank="vietabank" value="VIETABANK - NH TMCP VIET A">VIETABANK - NH TMCP VIET A</option>
                                    <option data-bank="namabank" value="NAMABANK - NH TMCP NAM A">NAMABANK - NH TMCP NAM A</option>
                                    <option data-bank="vietbank" value="VIETBANK - NH TMCP VIET A THUONG TIN">VIETBANK - NH TMCP VIET A THUONG TIN</option>
                                    <option data-bank="dongabank" value="DONGABANK - NH TMCP DONG A">DONGABANK - NH TMCP DONG A</option>
                                        </select>
                                        <div class="nui-select-icon">
                                        <i class="ri-bank-fill"></i>
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="kieuchuyen">Thông Báo Biến Động Số Dư</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="kieuchuyen" id="kieuchuyen-2">
                                            <option value="macdinh">Không</option>
                                            <option value="bdsd">Có</option>
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
                            <div class="col-span-1 hidden" id="soduchinh">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <div
                                        class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                                        <label class="nui-input-label" for="soduchinh" data-limit-text="20">Số Dư Của
                                            Bạn</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền chuyển phải là một con số!" value="5,000,000"
                                                name="soduchinh" placeholder="Ví dụ: 100,000,000">
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
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="20" for="thoigianchuyen">Chuyển Lúc</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('d/m/Y, H:i:s');?>"
                                            placeholder="Ví dụ: <?=date('d/m/Y, H:i:s');?>" required>
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
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="18" for="phigiaodich">Phí Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="phigiaodich"
                                            value="Miễn phí"
                                            placeholder="Ví dụ: Miễn phí" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="18" for="magiaodich">Mã Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="magiaodich"
                                            value="<?=WsRandomString::Number(4)?>"
                                            placeholder="Ví dụ: <?=WsRandomString::Number(4)?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label class="nui-label text-[0.825rem]" for="noidungchuyen" data-limit-text="60">Nội
                                    Dung Chuyển <span
                                            class="cursor-pointer"
                                            data-nui-tooltip="Nội dung chuyển không được ghi dấu tiếng việt"><i
                                                class="ri-question-line"></i></span></label>
                                <div
                                    class="nui-textarea-wrapper nui-textarea-default nui-textarea-md nui-textarea-rounded-sm nui-textarea-not-resize">
                                    <div class="nui-textarea-outer">
                                        <textarea class="nui-textarea" name="noidungchuyen" rows="3"
                                            placeholder="Ví dụ: NGUYEN VAN A chuyen khoan"
                                            required>NGUYEN VAN A chuyen khoan</textarea>
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
                        <?=$Bill->Demo('Bill-Acb');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>