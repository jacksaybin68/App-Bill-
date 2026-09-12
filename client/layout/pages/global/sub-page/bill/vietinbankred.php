<?php $options_header = ['title' => 'Tạo Bill Fake Vietinbank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-vietinbankred hk-refresh-form space-y-6">
                    <input type="hidden" name="action" value="fakebill-vietinbank-1">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Vietinbank Giao Diện Đỏ</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="50" for="tennguoichuyen">Tên Người Chuyển</label>
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
                                    <label class="nui-input-label" data-limit-text="50" for="tennguoinhan">Tên Người Nhận</label>
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
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stk_nc">Số Tài Khoản Người
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
                            <div class="col-span-1" id="nganhangnhan">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
                                    <option data-bank="vietinbank" value="Ngân hàng Công Thương Việt Nam (CTG)">VietinBank - Ngân hàng Công Thương Việt Nam (CTG)</option>
                                    <option data-bank="vietcombank" value="Ngân hàng Ngoại thương Việt Nam (VCB)">Vietcombank - Ngân hàng Ngoại thương Việt Nam (VCB)</option>
                                    <option data-bank="bidv" value="Ngân hàng Đầu tư và phát triển Việt Nam">BIDV - Ngân hàng Đầu tư và phát triển Việt Nam</option>
                                    <option data-bank="agribank" value="Ngân hàng Nông nghiệp và Phát triển nông thôn Việt Nam">Agribank - Ngân hàng Nông nghiệp và Phát triển nông thôn Việt Nam</option>
                                    <option data-bank="mbbank" value="Ngân hàng Quân đội">MBBank - Ngân hàng Quân đội</option>
                                    <option data-bank="techcombank" value="Ngân hàng Kỹ Thương Việt Nam (TCB)">Techcombank - Ngân hàng Kỹ Thương Việt Nam (TCB)</option>
                                    <option data-bank="seabank" value="Ngân hàng Đông Nam Á">SeaBank - Ngân hàng Đông Nam Á</option>
                                    <option data-bank="ocb" value="Ngân hàng Phương Đông">OCB - Ngân hàng Phương Đông</option>
                                    <option data-bank="acbbank" value="Ngân hàng Á Châu">ACB - Ngân hàng Á Châu</option>
                                    <option data-bank="vpbank" value="Ngân hàng Việt Nam Thịnh Vượng">VPBank - Ngân hàng Việt Nam Thịnh Vượng</option>
                                    <option data-bank="tpbank" value="Ngân hàng Tiên Phong">TPBank - Ngân hàng Tiên Phong</option>
                                    <option data-bank="sacombank" value="Ngân hàng Sài Gòn Thương Tín (STB)">Sacombank - Ngân hàng Sài Gòn Thương Tín (STB)</option>
                                    <option data-bank="shb" value="Ngân hàng Sài Gòn Hà Nội">SHB - Ngân hàng Sài Gòn Hà Nội</option>
                                    <option data-bank="sgb" value="Ngân hàng Sài Gòn Công Thương (SGB)">SaigonBank - Ngân hàng Sài Gòn Công Thương (SGB)</option>
                                    <option data-bank="oceanbank" value="Ngân hàng Thương mại Đại Dương">Oceanbank - Ngân hàng Thương mại Đại Dương</option>
                                    <option data-bank="vietabank" value="Ngân hàng Việt Á">VietABank - Ngân hàng Việt Á</option>
                                    <option data-bank="namabank" value="Ngân hàng Nam Á">NamABank - Ngân hàng Nam Á</option>
                                    <option data-bank="dongabank" value="Ngân hàng Đông Á">DongABank - Ngân hàng Đông Á</option>
                                    <option data-bank="vietbank" value="Ngân hàng Việt Nam Thương Tín">VietBank - Ngân hàng Việt Nam Thương Tín</option>
                                    <option data-bank="scb" value="Ngân hàng Sài Gòn">SCB - Ngân hàng Sài Gòn</option>
                                    <option data-bank="vib" value="Ngân hàng Quốc tế Việt Nam">VIB - Ngân hàng Quốc tế Việt Nam</option>
                                    <option data-bank="msb" value="Ngân hàng Hàng Hải Việt Nam">MSB - Ngân hàng Hàng Hải Việt Nam</option>
                                    <option data-bank="lpb" value="Ngân hàng Lộc Phát Việt Nam">LPB - Ngân hàng Lộc Phát Việt Nam</option>
                                    <option data-bank="abb" value="Ngân hàng An Bình">ABBank - Ngân hàng An Bình</option>
                                    <option data-bank="ncb" value="Ngân hàng Quốc Dân">NCB - Ngân hàng Quốc Dân</option>
                                    <option data-bank="pgb" value="Ngân Hàng Thịnh vượng và Phát triển">PGB - Ngân Hàng Thịnh vượng và Phát triển</option>
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
                                    <label class="nui-input-label" data-limit-text="16" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('d/m/Y H:i')?>"
                                            placeholder="Ví dụ: <?=date('d/m/Y H:i')?>" required>
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
                                            value="<?=WsRandomString::TD(16)?>"
                                            placeholder="Ví dụ: <?=WsRandomString::TD(16)?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label class="nui-label text-[0.825rem]" for="noidungchuyen" data-limit-text="70">Nội
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
                        <?=$Bill->Demo('https://files.catbox.moe/atp2iu.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>