<?php $options_header = ['title' => 'Tạo Bill Fake Techcombank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-techcombank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Techcombank</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="50" for="tennguoinhan">Tên Người
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
                                        <label class="nui-input-label" for="sotienchuyen" data-limit-text="19">Số Tiền
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
                                        <option data-bank="vietinbank" value="Ngân hàng TMCP Công Thương Việt Nam">Vietinbank - Ngân hàng TMCP Công Thương Việt Nam</option>
                                        <option data-bank="vietcombank" value="Ngân hàng TMCP Ngoại thương Việt Nam">Vietcombank - Ngân hàng TMCP Ngoại thương Việt Nam</option>
                                        <option data-bank="bidv" value="Ngân hàng Đầu tư và phát triển Việt Nam">BIDV - Ngân hàng Đầu tư và phát triển Việt Nam</option>
                                        <option data-bank="seabank" value="Ngân hàng TMCP Đông Nam Á">SeaBank - Ngân hàng TMCP Đông Nam Á</option>
                                        <option data-bank="techcombank" value="Ngân hàng TMCP Kỹ Thương Việt Nam">Techcombank - Ngân hàng TMCP Kỹ Thương Việt Nam</option>
                                        <option data-bank="agribank" value="Ngân hàng NN và PTNT Việt Nam">Agribank - Ngân hàng NN và PTNT Việt Nam</option>
                                        <option data-bank="ocb" value="Ngân hàng TMCP Phương Đông">OCB - Ngân hàng TMCP Phương Đông</option>
                                        <option data-bank="mbbank" value="Ngân hàng TMCP Quân đội">MBBank - Ngân hàng TMCP Quân đội</option>
                                        <option data-bank="acbbank" value="Ngân hàng TMCP Á Châu">ACB - Ngân hàng TMCP Á Châu</option>
                                        <option data-bank="vpbank" value="Ngân hàng TMCP Việt Nam Thịnh Vượng">VPBank - Ngân hàng TMCP Việt Nam Thịnh Vượng</option>
                                        <option data-bank="tpbank" value="Ngân hàng TMCP Tiên Phong">TPBank - Ngân hàng TMCP Tiên Phong</option>
                                        <option data-bank="sacombank" value="Ngân hàng TMCP Sài Gòn Thương Tín">Sacombank - Ngân hàng TMCP Sài Gòn Thương Tín</option>
                                        <option data-bank="shb" value="Ngân hàng TMCP Sài Gòn Hà Nội">SHB - Ngân hàng TMCP Sài Gòn Hà Nội</option>
                                        <option data-bank="sgb" value="Ngân hàng TMCP Sài Gòn Công Thương">SaigonBank - Ngân hàng TMCP Sài Gòn Công Thương</option>
                                        <option data-bank="oceanbank" value="Ngân hàng Thương mại Đại Dương">Oceanbank - Ngân hàng Thương mại Đại Dương</option>
                                        <option data-bank="vietabank" value="Ngân hàng TMCP Việt Á">VietABank - Ngân hàng TMCP Việt Á</option>
                                        <option data-bank="namabank" value="Ngân hàng TMCP Nam Á">NamABank - Ngân hàng TMCP Nam Á</option>
                                        <option data-bank="dongabank" value="Ngân hàng TMCP Đông Á">DongABank - Ngân hàng TMCP Đông Á</option>
                                        <option data-bank="vietbank" value="Ngân hàng TMCP Việt Nam Thương Tín">VietBank - Ngân hàng TMCP Việt Nam Thương Tín</option>
                                        <option data-bank="kienlongbank" value="Ngân hàng TMCP Kiên Long">KienlongBank - Ngân hàng TMCP Kiên Long</option>
                                        <option data-bank="scb" value="Ngân hàng TMCP Sài Gòn">SCB - Ngân hàng TMCP Sài Gòn</option>
                                        <option data-bank="vib" value="Ngân hàng TMCP Quốc tế Việt Nam">VIB - Ngân hàng TMCP Quốc tế Việt Nam</option>
                                        <option data-bank="msb" value="Ngân hàng TMCP Hàng Hải Việt Nam">MSB - Ngân hàng TMCP Hàng Hải Việt Nam</option>
                                        <option data-bank="lpb" value="Ngân hàng TMCP Lộc Phát Việt Nam">LPB - Ngân hàng TMCP Lộc Phát Việt Nam</option>
                                        <option data-bank="abb" value="Ngân hàng TMCP An Bình">ABBank - Ngân hàng TMCP An Bình</option>
                                        <option data-bank="ncb" value="Ngân hàng TMCP Quốc Dân">NCB - Ngân hàng TMCP Quốc Dân</option>
                                        <option data-bank="pgb" value="Ngân Hàng TMCP Thịnh vượng và Phát triển">PGB - Ngân Hàng TMCP Thịnh vượng và Phát triển</option>
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
                                            <option value="macdinh" selected>Không</option>
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
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="27" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('j \t\h\g n, Y \lú\c H:i');?>"
                                            placeholder="Ví dụ: <?=date('j \t\h\g n, Y \lú\c H:i');?>" required>
                                        <div class="nui-input-icon">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="magiaodich">Mã Giao Dịch</label>
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
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="mathamchieu">Mã Tham Chiếu</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="mathamchieu"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(6)?>"
                                                value="<?=WsRandomString::Number(6)?>" required>
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
                                <label class="nui-label text-[0.825rem]" for="noidungchuyen" data-limit-text="40">Nội
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
                        <?=$Bill->Demo('https://i.imgur.com/XKLSmxK.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>