<?php $options_header = ['title' => 'Tạo Bill Fake TP Bank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-tpbank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill TP Bank</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="tennguoichuyen">Tên Người Chuyển</label>
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
                                    <label class="nui-input-label" data-limit-text="30" for="tennguoinhan">Tên Người Nhận</label>
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
                                    <label class="nui-input-label" data-limit-text="17" for="stk_nc">Số Tài Khoản Người
                                    Chuyển</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stk_nc"
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                value="10<?=WsRandomString::Number(9)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stk">Số Tài Khoản Người
                                        Nhận</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stk"
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                value="10<?=WsRandomString::Number(9)?>" required>
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                    <select class="nui-select" name="nganhangnhan">
                                    <option data-bank="vietinbank" value="vietinbank">Vietinbank - Ngân hàng TMCP Công Thương Việt Nam</option>
                                    <option data-bank="vietcombank" value="vietcombank">Vietcombank - Ngân hàng TMCP Ngoại Thương Việt Nam</option>
                                    <option data-bank="bidv" value="bidv">BIDV - Ngân hàng TMCP Đầu tư và Phát triển Việt Nam-BIDV</option>
                                    <option data-bank="techcombank" value="techcombank">Techcombank - Ngân hàng TMCP Kỹ thương Việt Nam</option>
                                    <option data-bank="agribank" value="agribank">Agribank - Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam</option>
                                    <option data-bank="ocb" value="ocb">OCB - Ngân hàng TMCP Phương Đông</option>
                                    <option data-bank="mbbank" value="mbbank">MBBank - Ngân hàng TMCP Quân Đội</option>
                                    <option data-bank="acbbank" value="acb">ACB - Ngân hàng TMCP Á Châu</option>
                                    <option data-bank="vpbank" value="vpbank">VPBank - Ngân hàng TMCP Việt Nam Thịnh Vượng</option>
                                    <option data-bank="sacombank" value="sacombank">Sacombank - Ngân hàng TMCP Sài Gòn Thương Tín</option>
                                    <option data-bank="shb" value="shb">SHB - Ngân hàng TMCP Sài Gòn-Hà Nội</option>
                                    <option data-bank="sgb" value="saigonbank">SaigonBank - Ngân hàng TMCP Sài Gòn Công thương</option>
                                    <option data-bank="oceanbank" value="oceanbank">Oceanbank - Ngân hàng TMCP Đại Dương</option>
                                    <option data-bank="vietabank" value="vietabank">VietABank - Ngân hàng TMCP Việt Á</option>
                                    <option data-bank="namabank" value="namabank">NamABank - Ngân hàng TMCP Nam Á</option>
                                    <option data-bank="vietbank" value="vietbank">VietBank - Ngân hàng TMCP Việt Nam Thương Tín</option>
                                    <option data-bank="dongabank" value="dongabank">DongABank - Ngân hàng TMCP Đông Á</option>
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
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="25" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('H:i:s, \N\g\à\y\ d/m/Y')?>"
                                            placeholder="Ví dụ: <?=date('H:i:s, \N\g\à\y\ d/m/Y')?>" required>
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
                                    <label class="nui-input-label" data-limit-text="16" for="magiaodich">Mã Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="magiaodich"
                                            value="<?=WsRandomString::TD2(16,5)?>"
                                            placeholder="Ví dụ: <?=WsRandomString::TD2(16)?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="27" for="cachthucchuyen">Cách Thức Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="cachthucchuyen"
                                            value="Chuyển nhanh Napas 247"
                                            placeholder="Ví dụ: Chuyển nhanh Napas 247" required>
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
                    <div class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('Bill-TPBank');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>