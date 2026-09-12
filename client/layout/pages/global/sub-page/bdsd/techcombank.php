<?php $options_header = ['title' => 'Tạo Bill Fake Biến Động Số Dư Techcombank'];?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
            <form class="hk-bdsd-techcombank hk-refresh-form space-y-6">
                <fieldset class="relative">
                    <div
                        class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                        <legend class="mb-6-none flex flex-col md:flex-row justify-between items-start">
                            <div class="text-left">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none">
                                    <i class="ri-bank-fill me-1"></i> Tạo Bill Biến Động Techcombank
                                </p>
                                <span class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">
                                    Hãy nhập đầy đủ thông tin để tạo bill
                                </span>
                            </div>
                        </legend>
                                <div class="col-span-1">
                                    <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                        <label class="nui-input-label" data-limit-text="30" for="tennguoichuyen">Tên
                                            Người Chuyển</label>
                                        <div class="nui-input-outer">
                                            <div>
                                                <input type="text" class="nui-input td-format-text"
                                                    name="tennguoichuyen" placeholder="NGUYEN VAN A"
                                                    value="NGUYEN VAN A" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                        <label class="nui-input-label" data-limit-text="17" for="stk_nc">Số Tài Khoản
                                            Người
                                            Chuyển</label>
                                        <div class="nui-input-outer">
                                            <div>
                                                <input type="text" class="nui-input" name="stk_nc"
                                                    placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                    value="10239821021" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                        <label class="nui-input-label" data-limit-text="30" for="tennguoinhan">Tên Người
                                            Nhận <span class="cursor-pointer"
                                                data-nui-tooltip="Tên người nhận chính là ctk của bạn"><i
                                                    class="ri-question-line"></i></span></label>
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
                                            Nhận <span class="cursor-pointer"
                                                data-nui-tooltip="Số tài khoản người nhận chính là stk của bạn"><i
                                                    class="ri-question-line"></i></span></label>
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
                                            <label class="nui-input-label" for="sotiennhan" data-limit-text="19">Số Tiền
                                                Nhận</label>
                                            <div class="nui-input-number-outer">
                                                <input type="text" class="nui-input-number td-format-money"
                                                    data-td-msg="Số tiền chuyển phải là một con số!" name="sotiennhan"
                                                    placeholder="Ví dụ: 100,000,000" value="100,000,000" required>
                                                <div class="nui-input-number-buttons">
                                                    <button type="button" btn="destroy"><i
                                                            class="ri-close-line"></i></button>
                                                    <button type="button" btn="minus"><i
                                                            class="ri-subtract-line"></i></button>
                                                    <button type="button" btn="plus"><i
                                                            class="ri-add-line"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div
                                        class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                        <label class="nui-select-label" for="bdsd">Kiểu Biến Động</label>
                                        <div class="nui-select-outer">
                                            <select class="nui-select" name="bdsd">
                                                <option value="nhantien">Nhận Tiền</option>
                                                <option value="chuyentien">Chuyển Tiền</option>
                                            </select>
                                            <div class="nui-select-chevron nui-chevron">
                                                <svg aria-hidden="true" viewBox="0 0 24 24"
                                                    class="nui-select-chevron-inner">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
                                        <option data-bank="vietinbank" value="Vietinbank">Vietinbank - Ngân hàng TMCP Công Thương Việt Nam</option>
                                        <option data-bank="vietcombank" value="Vietcombank">Vietcombank - Ngân hàng TMCP Ngoại thương Việt Nam</option>
                                        <option data-bank="bidv" value="BIDV">BIDV - Ngân hàng Đầu tư và phát triển Việt Nam</option>
                                        <option data-bank="seabank" value="SeaBank">SeaBank - Ngân hàng TMCP Đông Nam Á</option>
                                        <option data-bank="techcombank" value="Techcombank">Techcombank - Ngân hàng TMCP Kỹ Thương Việt Nam</option>
                                        <option data-bank="agribank" value="Agribank">Agribank - Ngân hàng NN và PTNT Việt Nam</option>
                                        <option data-bank="ocb" value="OCB">OCB - Ngân hàng TMCP Phương Đông</option>
                                        <option data-bank="mbbank" value="MB">MBBank - Ngân hàng TMCP Quân đội</option>
                                        <option data-bank="acbbank" value="ACB">ACB - Ngân hàng TMCP Á Châu</option>
                                        <option data-bank="vpbank" value="VPBank">VPBank - Ngân hàng TMCP Việt Nam Thịnh Vượng</option>
                                        <option data-bank="tpbank" value="TPBank">TPBank - Ngân hàng TMCP Tiên Phong</option>
                                        <option data-bank="sacombank" value="Sacombank">Sacombank - Ngân hàng TMCP Sài Gòn Thương Tín</option>
                                        <option data-bank="shb" value="SHB">SHB - Ngân hàng TMCP Sài Gòn Hà Nội</option>
                                        <option data-bank="sgb" value="SaigonBank">SaigonBank - Ngân hàng TMCP Sài Gòn Công Thương</option>
                                        <option data-bank="oceanbank" value="Oceanbank">Oceanbank - Ngân hàng Thương mại Đại Dương</option>
                                        <option data-bank="vietabank" value="VietABank">VietABank - Ngân hàng TMCP Việt Á</option>
                                        <option data-bank="namabank" value="NamABank">NamABank - Ngân hàng TMCP Nam Á</option>
                                        <option data-bank="dongabank" value="DongABank">DongABank - Ngân hàng TMCP Đông Á</option>
                                        <option data-bank="vietbank" value="VietBank">VietBank - Ngân hàng TMCP Việt Nam Thương Tín</option>
                                        <option data-bank="scb" value="SCB">SCB - Ngân hàng TMCP Sài Gòn</option>
                                        <option data-bank="vib" value="VIB">VIB - Ngân hàng TMCP Quốc tế Việt Nam</option>
                                        <option data-bank="msb" value="MSB">MSB - Ngân hàng TMCP Hàng Hải Việt Nam</option>
                                        <option data-bank="lpb" value="LPB">LPB - Ngân hàng TMCP Lộc Phát Việt Nam</option>
                                        <option data-bank="abb" value="ABBank">ABBank - Ngân hàng TMCP An Bình</option>
                                        <option data-bank="ncb" value="NCB">NCB - Ngân hàng TMCP Quốc Dân</option>
                                        <option data-bank="pgb" value="PGB">PGB - Ngân Hàng TMCP Thịnh vượng và Phát triển</option>
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
                                        <label class="nui-input-label" data-limit-text="16" for="thoigianchuyen">Thời
                                            Gian
                                            Chuyển</label>
                                        <div class="nui-input-outer">
                                            <input type="text" class="nui-input" name="thoigianchuyen"
                                                value="<?=date('H:i d/m/Y');?>"
                                                placeholder="Ví dụ: <?=date('H:i d/m/Y');?>" required>
                                            <div class="nui-input-icon">
                                                <i class="ri-calendar-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                        <label class="nui-input-label" data-limit-text="16" for="magiaodich">Mã Giao
                                            Dịch</label>
                                        <div class="nui-input-outer">
                                            <div>
                                                <input type="text" class="nui-input" name="magiaodich"
                                                    placeholder="Ví dụ: FT<?=WsRandomString::Number(14)?>"
                                                    value="FT<?=WsRandomString::Number(14)?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div
                                        class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                        <label class="nui-input-label" data-limit-text="5" for="thoigianchuyen">Thời
                                            Gian
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
                                    <label class="nui-label text-[0.825rem]" for="noidungchuyen"
                                        data-limit-text="50">Nội
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
                                    <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/modal/bill-setting.php');?>
                                </div>
                                <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/taobill.php');?>
                        </div>
                </fieldset>
                </form>
            </div>
            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div
                        class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('BDSD-Techcombank');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>