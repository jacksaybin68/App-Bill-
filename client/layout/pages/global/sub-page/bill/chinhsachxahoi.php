<?php $options_header = ['title' => 'Tạo Bill Fake Chính Sách Xã Hội Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-chinhsachxahoi hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Chính Sách Xã Hội</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stkgui">Số Tài Khoản Người
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stkgui"
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                value="10239821021" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stknhan">Số Tài Khoản Người
                                        Nhận</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stknhan"
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                value="10239821021" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="tennguoigui">Tên Người
                                        Gửi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="tennguoigui"
                                                placeholder="NGUYEN VAN A" value="NGUYEN VAN A" required>
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

                            <div class="col-span-1" id="nganhangnhan">
                                <div
                                    class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select name="nganhangnhan" class="nui-select">
                                        <option value="Ngân Hàng Ngoại Thương Việt Nam">VietcomBank</option>
                                            <option value="Ngân Hàng TMCP Công Thương Việt Nam">VietinBank</option>
                                            <option value="Ngân Hàng TMCP Kỹ Thương Việt Nam">Techcombank</option>
                                            <option value="Ngân Hàng TMCP Đầu Tư Và Phát Triển">BIDV</option>
                                            <option value="Ngân Hàng Nông Nghiệp Và PT Nông Thôn">AgriBank</option>
                                            <option value="Ngân Hàng TMCP Quốc Dân">Navibank</option>
                                            <option value="Ngân Hàng TMCP Sài Gòn Thương Tín">Sacombank</option>
                                            <option value="Ngân Hàng TMCP Á Châu">ACB</option>
                                            <option value="Ngân Hàng Quân Đội">MBBank</option>
                                            <option value="Ngân Hàng TMCP Tiên Phong">TPBank</option>
                                            <option value="Ngân Hàng TNHH MTV Shinhan Việt Nam">Shinhan Bank</option>
                                            <option value="Ngân Hàng TMCP Quốc Tế Việt Nam">VIB Bank</option>
                                            <option value="Ngân Hàng TMCP Việt Nam Thịnh Vượng">VPBank</option>
                                            <option value="Ngân Hàng TMCP Sài Gòn Hà Nội">SHB</option>
                                            <option value="Ngân Hàng TMCP Xuất Nhập Khẩu Việt Nam">Eximbank</option>
                                            <option value="Ngân Hàng TMCP Bảo Việt">BaoVietBank</option>
                                            <option value="Ngân Hàng TMCP Bản Việt">VietcapitalBank</option>
                                            <option value="Ngân Hàng TMCP Sài Gòn">SCB</option>
                                            <option value="Ngân Hàng Liên Doanh Việt Nga">VietNam - Russia Bank</option>
                                            <option value="Ngân Hàng TMCP An Bình">ABBank</option>
                                            <option value="Ngân Hàng TMCP Đại Chúng Việt Nam">PVCombank</option>
                                            <option value="Ngân Hàng TM TNHH MTV Đại Dương">OceanBank</option>
                                            <option value="Ngân Hàng TMCP Nam Á">NamA bank</option>
                                            <option value="Ngân Hàng TMCP Phát Triển TPHCM">HDBank</option>
                                            <option value="Ngân Hàng TMCP Việt Nam Thương Tín">VietBank</option>
                                            <option value="Ngân Hàng Tài chính Cổ Phần Tín Việt">VietCredit</option>
                                            <option value="Ngân Hàng TNHH MTV Public VN">Public bank</option>
                                            <option value="Ngân Hàng TNHH MTV Hongleong VN">Hongleong Bank</option>
                                            <option value="Ngân Hàng TMCP Xăng Dầu Petrolimex">PG Bank</option>
                                            <option value="Ngân Hàng Hợp Tác">Co.op Bank</option>
                                            <option value="Ngân Hàng TNHH MTV CIMB Việt Nam">CIMB</option>
                                            <option value="Ngân Hàng TNHH Indovina">Indovina</option>
                                            <option value="Ngân Hàng TMCP Đông Á">DongABank</option>
                                            <option value="Ngân Hàng TM TNHH MTV Dầu Khí Toàn Cầu">GPBank</option>
                                            <option value="Ngân Hàng TMCP Bắc Á">BacABank</option>
                                            <option value="Ngân Hàng TMCP Việt Á">VietABank</option>
                                            <option value="Ngân Hàng TMCP Sài Gòn Công Thương">SaigonBank</option>
                                            <option value="Ngân Hàng TMCP Hàng Hải Việt Nam">Maritime Bank</option>
                                            <option value="Ngân Hàng Lộc Phát Việt Nam (LPB)">LPBank</option>
                                            <option value="Ngân Hàng TMCP Kiên Long">KienLongBank</option>
                                            <option value="Ngân Hàng Công Nghiệp Hàn Quốc - Hà Nội">IBK - Ha Noi</option>
                                            <option value="Ngân Hàng Wooribank">Woori bank</option>
                                            <option value="Ngân Hàng TMCP Đông Nam Á">SeABank</option>
                                            <option value="Ngân Hàng TNHH MTV United Overseas Bank">UOB</option>
                                            <option value="Ngân Hàng TMCP Phương Đông">OCB</option>
                                            <option value="Ngân Hàng TNHH MTV Mirae Asset (Viet Nam)">Mirae Asset</option>
                                            <option value="Ngân Hàng Keb Hana - TP HCM">Keb Hana - Ho Chi Minh</option>
                                            <option value="Ngân Hàng Keb Hana - Hà Nội">Keb Hana - Ha Noi</option>
                                            <option value="Ngân Hàng Standard Chartered">Standard Chartered</option>
                                            <option value="Ngân Hàng Số CAKE by VPBank">CAKE</option>
                                            <option value="Ngân Hàng Số Ubank by VPBank">Ubank</option>
                                            <option value="Ngân Hàng Nonghyup - Hà Nội">Nonghyup Bank - HN</option>
                                            <option value="Ngân Hàng Kookmin - Hà Nội">Kookmin - HN</option>
                                            <option value="Ngân Hàng Kookmin - TP. HCM">Kookmin - HCM</option>
                                            <option value="Ngân Hàng DBS - TP. HCM">DBS - HCM</option>
                                            <option value="Ngân Hàng TM TNHH MTV Xây Dựng">CBBank</option>
                                            <option value="Ngân Hàng Đại Chúng TNHH Kasikornbank">KBank - HCM</option>
                                            <option value="Ngân Hàng TNHH MTV HSBC Việt Nam">HSBC</option>
                                            <option value="Ngân Hàng Số Timo">Timo</option>
                                            <option value="Ngân Hàng TMCP Quốc Dân">NCB</option>
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
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="9" for="sogiaodich">Mã Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="sogiaodich"
                                            value="<?=WsRandomString::Number(7)?>"
                                            placeholder="Ví dụ: <?=WsRandomString::Number(7)?>" required>
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
                        <?=$Bill->Demo('https://files.catbox.moe/e1q60n.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>