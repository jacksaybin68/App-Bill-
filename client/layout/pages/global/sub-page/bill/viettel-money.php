<?php $options_header = ['title' => 'Tạo Bill Fake Viettel Money Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-viettel-money hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Viettel Money</p>
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
                                <div
                                    class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                    <select class="nui-select" name="nganhangnhan">
                                          <option value="Vietcombank">Vietcombank - Ngân hàng TMCP Ngoại thương Việt Nam</option>
                                          <option value="Vietinbank">Vietinbank - Ngân hàng TMCP Công Thương Việt Nam </option>
                                          <option value="BIDV">BIDV - Ngân hàng TMCP Đầu tư và Phát triển Việt Nam </option>
                                          <option value="Agribank">Agribank - Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam</option>
                                          <option value="Techcombank">Techcombank - Ngân hàng TMCP Kỹ thương Việt Nam </option>
                                          <option value="MB Bank">MB Bank - Ngân hàng TMCP Quân đội</option>
                                          <option value="ACB">ACB - Ngân hàng TMCP Á Châu</option>
                                          <option value="Sacombank">Sacombank - Ngân hàng TMCP Sài Gòn Thương Tín </option>
                                          <option value="VPBank">VPBank - Ngân hàng TMCP Việt Nam Thịnh Vượng</option>
                                          <option value="VIB">VIB - Ngân hàng TMCP Quốc tế Việt Nam</option>
                                          <option value="TPBank">TPBank - Ngân hàng TMCP Tiên Phong</option>
                                          <option value="HDBank">HDBank - Ngân hàng TMCP Phát triển TP.HCM</option>
                                          <option value="OCB">OCB - Ngân hàng TMCP Phương Đông</option>
                                          <option value="SHB">SHB - Ngân hàng TMCP Sài Gòn - Hà Nội</option>
                                          <option value="MSB">MSB - Ngân hàng TMCP Hàng Hải Việt Nam</option>
                                          <option value="SeABank">SeABank - Ngân hàng TMCP Đông Nam Á</option>
                                          <option value="SCB">SCB - Ngân hàng TMCP Sài Gòn</option>
                                          <option value="BacABank">BacABank - Ngân hàng TMCP Bắc Á</option>
                                          <option value="VietABank">VietABank - Ngân hàng TMCP Việt Á</option>
                                          <option value="KienLongBank">KienLongBank - Ngân hàng TMCP Kiên Long </option>
                                          <option value="Saigonbank">Saigonbank - Ngân hàng TMCP Sài Gòn Công Thương </option>
                                          <option value="VietBank">VietBank - Ngân hàng TMCP Việt Nam Thương Tín </option>
                                          <option value="OceanBank">OceanBank - Ngân hàng TNHH MTV Đại Dương</option>
                                          <option value="ShinhanBank">Shinhan Bank - Ngân hàng TNHH MTV Shinhan Việt Nam</option>
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
                                    <label class="nui-select-label" for="kieuchuyen">Kiểu Chuyển</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="kieuchuyen" id="kieuchuyen">
                                            <option value="macdinh">Mặc Định</option>
                                            <option value="chitiet">Chi Tiết</option>
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
                            <div class="col-span-1 hidden" id="thoigianchuyen">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="19" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('d/m/Y H:i:s')?>"
                                            placeholder="Ví dụ: <?=date('d/m/Y H:i:s')?>"
                                            required>
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
                        <?=$Bill->Demo('https://thanhdieu.com/bill/viettel-money.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>