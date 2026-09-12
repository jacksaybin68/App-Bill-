<?php $options_header = ['title' => 'Tạo Bill Fake BIDV Premier Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-bidv-premier hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill BIDV Premier</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
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
                                        <option value="NHTMCP QUAN DOI">MB Bank - Ngân hàng Quân Đội</option>
                                            <option value="NH NONG NGHIEP VA PTNT VN">Agribank - Ngân hàng Nông nghiệp và Phát
                                                triển Nông thôn Việt Nam</option>
                                            <option value="NHTMCP CONG THUONG VN">VietinBank - Ngân hàng TMCP Công Thương
                                                Việt Nam</option>
                                            <option value="NHTMCP NGOAI THUONG VN">Vietcombank - Ngân hàng TMCP Ngoại
                                                Thương Việt Nam</option>
                                            <option value="NHTMCP DAU TU VA PHAT TRIEN VN">BIDV - Ngân hàng Đầu tư và Phát
                                                triển Việt Nam</option>
                                            <option value="NHTMCP A CHAU">ACB - Ngân hàng Á Châu</option>
                                            <option value="NHTMCP AN BINH">ABBANK - Ngân hàng An Bình</option>
                                            <option value="NHTMCP BAC A">BacABank - Ngân hàng Bắc Á</option>
                                            <option value="NHTMCP BAO VIET">BaoVietBank - Ngân hàng Bảo Việt</option>
                                            <option value="NHTMCP BAN VIET">VietCapitalBank - Ngân hàng Bản Việt
                                            </option>
                                            <option value="NHTMCP DAI CHUNG">PVcomBank - Ngân hàng Đại Chúng</option>
                                            <option value="NHTMCP DAI A">DaiABank - Ngân hàng Đại Á</option>
                                            <option value="NHTMCP DONG A">DongABank - Ngân hàng Đông Á</option>
                                            <option value="NHTMCP HANG HAI VN">MSB - Ngân hàng Hàng Hải Việt Nam</option>
                                            <option value="NHTMCP KIEN LONG">KienlongBank - Ngân hàng Kiên Long</option>
                                            <option value="NHTMCP KY THUONG VN">Techcombank - Ngân hàng Kỹ Thương Việt Nam
                                            </option>
                                            <option value="NHTMCP NAM A">NamABank - Ngân hàng Nam Á</option>
                                            <option value="NHTMCP PHAT TRIEN TP HCM">HDBank - Ngân hàng Phát triển
                                                TP.HCM</option>
                                            <option value="NHTMCP PHUONG DONG">OCB - Ngân hàng Phương Đông</option>
                                            <option value="NHTMCP QUOC DAN">NCB - Ngân hàng Quốc Dân</option>
                                            <option value="NHTMCP SAI GON">SCB - Ngân hàng Sài Gòn</option>
                                            <option value="NHTMCP SAI GON CONG THUONG">SaigonBank - Ngân hàng Sài Gòn
                                                Công Thương</option>
                                            <option value="NHTMCP SAI GON HA NOI">SHB - Ngân hàng Sài Gòn - Hà Nội
                                            </option>
                                            <option value="NHTMCP SEABANK">SeABank - Ngân hàng Đông Nam Á</option>
                                            <option value="NHTMCP TIEN PHONG">TPBank - Ngân hàng Tiên Phong</option>
                                            <option value="NHTMCP VIET A">VietABank - Ngân hàng Việt Á</option>
                                            <option value="NHTMCP VIET NAM THINH VUONG">VPBank - Ngân hàng Việt Nam
                                                Thịnh Vượng</option>
                                            <option value="NHTMCP VIET NAM THUONG TIN">VietBank - Ngân hàng Việt Nam
                                                Thương Tín
                                            </option>
                                             <option value="NHTMCP XANG DAU PETROLIMEX">PG Bank -
                                            Ngân hàng Xăng dầu Petrolimex</option>
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
                            <div class="col-span-1 hidden" id="stkchinh">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" for="stkchinh" data-limit-text="20">Số Tài Khoản Của
                                        Bạn</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="number" class="nui-input" name="stkchinh"
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
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="34" for="mathamchieu">Số Tham
                                        Chiếu</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="mathamchieu"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(20).date('Y').WsRandomString::str(3).WsRandomString::Number(7)?>"
                                                value="<?=WsRandomString::Number(20).date('Y').WsRandomString::str(3).WsRandomString::Number(7)?>"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="19" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('d/m/Y H:i:s')?>"
                                            placeholder="Ví dụ: <?=date('d/m/Y H:i:s')?>" required>
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
                        <?=$Bill->Demo('https://files.catbox.moe/b0p1ju.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>