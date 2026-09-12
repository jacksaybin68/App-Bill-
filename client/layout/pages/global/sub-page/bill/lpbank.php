<?php $options_header = ['title' => 'Tạo Bill Fake Liên Việt Bank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>

<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-lpbank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">

                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3">
                                    <i class="ri-bank-fill me-1"></i> Tạo Bill Liên Việt Bank
                                </p>
                                <span class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">
                                    Hãy nhập đầy đủ thông tin để tạo bill
                                </span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stk_nhan">Số Tài Khoản Người Nhận</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="stk_nhan" placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>" value="18666761" required>
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
                                            <option value="Vietinbank" selected>Vietinbank (ICB)</option>
                                            <option value="Vietcombank">Vietcombank (VCB)</option>
                                            <option value="Techcombank">Techcombank (TCB)</option>
                                            <option value="BIDV">BIDV</option>
                                            <option value="Agribank">Agribank (VARB)</option>
                                            <option value="Sacombank">Sacombank</option>
                                            <option value="ACB">ACB</option>
                                            <option value="MBBank">MB BANK</option>
                                            <option value="TPBank">TP Bank</option>
                                            <option value="VIB">VIB</option>
                                            <option value="VPbank">VP Bank</option>
                                            <option value="SHB">SHB</option>
                                            <option value="OCB">OCB</option>
                                            <option value="NAB">Nam Á Bank</option>
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
                                    <label class="nui-input-label" data-limit-text="21" for="time_bill">Thời Gian Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="time_bill" value="<?=date('m/d/Y - H:i:s')?>" placeholder="Ví dụ: <?=date('m/d/Y - H:i:s')?>" required>
                                        <div class="nui-input-icon"><i class="ri-time-line"></i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="10" for="magiaodich">Số Tài Khoản Người Nhận</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="magiaodich" placeholder="Ví dụ: <?=WsRandomString::Number(9)?>" value="<?=WsRandomString::Number(9)?>" required>
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
                        <?=$Bill->Demo('https://files.catbox.moe/12ml2j.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>
<script>
