<?php $options_header = ['title' => 'Tạo Bill Fake Vietcombank Galaxy Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-vcb-galaxy hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Vietcombank Galaxy</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stk">Số Tài Khoản Người
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
                                    <label class="nui-input-label" data-limit-text="30" for="tennguoinhan">Tên Người
                                        Nhận</label>
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
                            <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="kieuchuyen">Kiểu Chuyển</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="kieuchuyen" id="kieuchuyen">
                                            <option value="ngoaibank">Chuyển Ngoài VCB</option>
                                            <option value="trongbank">Chuyển Trong VCB</option>
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
                            <div class="col-span-1" id="nganhangnhan">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
                                            <option data-bank="vietinbank" value="vietinbank">Vietinbank (CTG)</option>
                                            <option data-bank="techcombank" value="techcombank">Techcombank (TCB)</option>
                                            <option data-bank="acbbank" value="acbbank">Acb Bank (ACB)</option>
                                            <option data-bank="agribank" value="agribank">Agribank (ARB)</option>
                                            <option data-bank="bidv" value="bidv">BIDV (BIDV)</option>
                                            <option data-bank="sacombank" value="sacombank">Sacombank (STB)</option>
                                            <option data-bank="mbbank" value="mbbank">MB Bank (MB)</option>
                                            <option data-bank="namabank" value="namabank">Nam Á Bank (NAB)</option>
                                            <option data-bank="ocb" value="ocb">OCB (OCB)</option>
                                            <option data-bank="tpbank" value="tpbank">TP Bank (TPB)</option>
                                            <option data-bank="vpbank" value="vpbank">VP Bank (VPB)</option>
                                            <option data-bank="shb" value="shb">Sài Gòn Hà Nội (SHB)</option>
                                            <option data-bank="msb" value="msb">Hàng Hải (MSB)</option>
                                            <option data-bank="sgb" value="sgb">Saigonbank (SGB)</option>
                                            <option data-bank="oceanbank" value="oceanbank">Đại Dương (OceanBank)
                                            </option>
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
                            <!-- <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="bdsd">Thông Báo Biến Động Số Dư</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="bdsd" id="kieuchuyen-2" data-type="vcb">
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
                            <div class="col-span-1 hidden" id="stk-nc">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" for="stk-nc" data-limit-text="20">Số Tài Khoản Của
                                        Bạn</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="number" class="nui-input" name="stk-nc"
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                value="10<?=WsRandomString::Number(9)?>">
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
                            </div> -->
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="25" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('H:i ').$thu[date('N')].date(' d/m/Y')?>"
                                            placeholder="Ví dụ: <?=date('H:i ').$thu[date('N')].date(' d/m/Y')?>" required>
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
                                    <label class="nui-input-label" data-limit-text="18" for="magiaodich">Mã Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="magiaodich"
                                            value="<?=WsRandomString::Number(9)?>"
                                            placeholder="Ví dụ: <?=WsRandomString::Number(9)?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label class="nui-label text-[0.825rem]" for="noidungchuyen" data-limit-text="37">Nội
                                    Dung Chuyển</label>
                                <div
                                    class="nui-textarea-wrapper nui-textarea-default nui-textarea-md nui-textarea-rounded-sm nui-textarea-not-resize">
                                    <div class="nui-textarea-outer">
                                        <textarea class="nui-textarea" name="noidungchuyen" rows="3"
                                            placeholder="Ví dụ: NGUYEN VAN A chuyen tien"
                                            required>NGUYEN VAN A chuyen tien</textarea>
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
                        <?=$Bill->Demo('https://files.catbox.moe/9nwasg.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>