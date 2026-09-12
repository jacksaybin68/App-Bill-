<?php $options_header = ['title' => 'Tạo Bill Fake Kiên Long Bank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>

<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-kienlongbank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">

                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3">
                                    <i class="ri-bank-fill me-1"></i> Tạo Bill Kiên Long Bank
                                </p>
                                <span class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">
                                    Hãy nhập đầy đủ thông tin để tạo bill
                                </span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stkgui">Số Tài Khoản Người Gửi</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="stkgui" placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>" value="18666761" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stk_nhan">Số Tài Khoản Người Nhận</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="stk_nhan" placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>" value="1234456789" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="name_gui">Tên Người Gửi</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input td-format-text" name="name_gui" placeholder="NGUYEN VAN A" value="NGUYEN VAN A" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="name_nhan">Tên Người Nhận</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input td-format-text" name="name_nhan" placeholder="NGUYEN VAN B" value="NGUYEN VAN B" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <div class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                                        <label class="nui-input-label" for="sotienchuyen" data-limit-text="20">Số Tiền Chuyển</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money" data-td-msg="Số tiền chuyển phải là một con số!" name="sotienchuyen" placeholder="Ví dụ: 100,000,000" value="100,000,000" required>
                                            <div class="nui-input-number-buttons">
                                                <button type="button" btn="destroy"><i class="ri-close-line"></i></button>
                                                <button type="button" btn="minus"><i class="ri-subtract-line"></i></button>
                                                <button type="button" btn="plus"><i class="ri-add-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="bank_nhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">  
                                        <select class="nui-select" name="bank_nhan" id="bank_nhan" required>
                                            <option value="TMCP Công Thương Việt Nam" selected>Vietinbank (ICB)</option>
                                            <option value="Ngoại Thương Việt Nam">Vietcombank (VCB)</option>
                                            <option value="TMCP Kỹ Thương Việt Nam">Techcombank (TCB)</option>
                                            <option value="TMCP Đầu Tư Và Phát Triển">BIDV</option>
                                            <option value="Nông Nghiệp Và PT Nông Thôn">Agribank (VARB)</option>
                                            <option value="TMCP Sài Gòn Thương Tín">Sacombank</option>
                                            <option value="TMCP Á Châu">ACB</option>
                                            <option value="Quân Đội">MB BANK</option>
                                            <option value="TMCP Tiên Phong">TP Bank</option>
                                            <option value="TMCP Quốc Tế Việt Nam">VIB</option>
                                            <option value="TMCP Việt Nam Thịnh Vượng">VP Bank</option>
                                            <option value="TMCP Sài Gòn Hà Nội">SHB</option>
                                            <option value="TMCP Phương Đông">OCB</option>
                                            <option value="TMCP Nam Á">Nam Á Bank</option>
                                        </select>
                                        <div class="nui-select-icon"><i class="ri-bank-fill"></i></div>
                                        <div class="nui-select-chevron nui-chevron">
                                            <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-select-chevron-inner">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="19" for="time_bill">Thời Gian Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="time_bill" value="<?=date('m/d/Y H:i')?>" placeholder="Ví dụ: <?=date('m/d/Y H:i')?>" required>
                                        <div class="nui-input-icon"><i class="ri-time-line"></i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="magiaodich">Số Tài Khoản Người Nhận</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="magiaodich" placeholder="Ví dụ: <?= strtoupper(WsRandomString::AlphaNumeric(16)) ?>" value="<?= strtoupper(WsRandomString::AlphaNumeric(16)) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="5" for="thoigiantrendt">Thời Gian Trên ĐT</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigiantrendt" value="<?=date('H:i')?>" placeholder="Ví dụ: 00:00" required>
                                        <div class="nui-input-icon"><i class="ri-time-line"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label class="nui-label text-[0.825rem]" for="noidung" data-limit-text="37">Nội Dung Chuyển</label>
                                <div class="nui-textarea-wrapper nui-textarea-default nui-textarea-md nui-textarea-rounded-sm nui-textarea-not-resize">
                                    <div class="nui-textarea-outer">
                                        <textarea class="nui-textarea" name="noidung" rows="3" placeholder="Ví dụ: NGUYEN VAN A chuyen tien" required>NGUYEN VAN A chuyen tien</textarea>
                                    </div>
                                </div>
                            </div>

                            <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/vip.status.php'); ?>
                            <div class="col-span-1">
                                <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/modal/bill-setting.php'); ?>
                            </div>
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/taobill.php'); ?>

                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('https://files.catbox.moe/r6ohzo.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>
<script>
