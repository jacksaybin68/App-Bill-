<?php $options_header = ['title' => 'Tạo Bill Fake ACB Privilege Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-acb-privilege hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill ACB Privilege</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="23" for="tennguoichuyen">Tên Người Chuyển</label>
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
                                    <label class="nui-input-label" data-limit-text="9" for="stkgui">Số Tài Khoản Người
                                    Chuyển</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stkgui"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(9)?>"
                                                value="13982021" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="23" for="tennguoinhan">Tên Người Nhận</label>
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
                                    <label class="nui-input-label" data-limit-text="20" for="stknhan">Số Tài Khoản Người
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
                                        <option value="TMCP NGOAI THUONG">VietcomBank</option>
    <option value="TMCP CONG THUONG">VietinBank</option>
    <option value="TMCP KY THUONG">Techcombank</option>
    <option value="TMCP DAU TU VA PHAT TRIEN">BIDV</option>
    <option value="NONG NGHIEP VA PT NONG THON">AgriBank</option>
    <option value="TMCP QUOC DAN">Navibank</option>
    <option value="TMCP SAI GON THUONG TIN">Sacombank</option>
    <option value="TMCP A CHAU">ACB</option>
    <option value="TMCP QUAN DOI">MBBank</option>
    <option value="TMCP TIEN PHONG">TPBank</option>
    <option value="TNHH MTV SHINHAN">Shinhan Bank</option>
    <option value="TMCP QUOC TE">VIB Bank</option>
    <option value="TMCP VIET NAM THINH VUONG">VPBank</option>
    <option value="TMCP SAI GON HA NOI">SHB</option>
    <option value="TMCP XUAT NHAP KHAU">Eximbank</option>
    <option value="TMCP BAO VIET">BaoVietBank</option>
    <option value="TMCP BAN VIET">VietcapitalBank</option>
    <option value="TMCP SAI GON">SCB</option>
    <option value="LIEN DOANH VIET NGA">VietNam - Russia Bank</option>
    <option value="TMCP AN BINH">ABBank</option>
    <option value="TMCP DAI CHUNG">PVCombank</option>
    <option value="TM TNHH MTV DAI DUONG">OceanBank</option>
    <option value="TMCP NAM A">NamA bank</option>
    <option value="TMCP PHAT TRIEN TPHCM">HDBank</option>
    <option value="TMCP VIET NAM THUONG TIN">VietBank</option>
    <option value="Công ty Tài chính Cổ Phần Tín Việt">VietCredit</option>
    <option value="TNHH MTV Public VN">Public bank</option>
    <option value="TNHH MTV Hongleong VN">Hongleong Bank</option>
    <option value="TMCP XANG DAU PETROLIMEX">PG Bank</option>
    <option value="HOP TAC">Co.op Bank</option>
    <option value="TNHH MTV CIMB VIET NAM">CIMB</option>
    <option value="TNHH Indovina">Indovina</option>
    <option value="TMCP DONG A">DongABank</option>
    <option value="TM TNHH MTV DAU KHI TOAN CAU">GPBank</option>
    <option value="TMCP BAC A">BacABank</option>
    <option value="TMCP VIET A">VietABank</option>
    <option value="TMCP SAI GON CONG THUONG">SaigonBank</option>
    <option value="TMCP HANG HAI VIET NAM">Maritime Bank</option>
    <option value="TMCP BUU DIEN LIEN VIET">LienVietPostBank</option>
    <option value="TMCP KIEN LONG">KienLongBank</option>
    <option value="CONG NGHIEP HAN QUOC - HA NOI">IBK - Ha Noi</option>
    <option value="Wooribank">Woori bank</option>
    <option value="TMCP DONG NAM A">SeABank</option>
    <option value="TNHH MTV United Overseas Bank">UOB</option>
    <option value="TMCP PHUONG DONG">OCB</option>
    <option value="TNHH MTV Mirae Asset (Viet Nam)">Mirae Asset</option>
    <option value="Keb Hana - TP HCM">Keb Hana - Ho Chi Minh</option>
    <option value="Keb Hana - Hà Nội">Keb Hana - Ha Noi</option>
    <option value="Standard Chartered">Standard Chartered</option>
    <option value="So CAKE by VPBank">CAKE</option>
    <option value="So Ubank by VPBank">Ubank</option>
    <option value="Nonghyup - Hà Nội">Nonghyup Bank - HN</option>
    <option value="Kookmin - Hà Nội">Kookmin - HN</option>
    <option value="Kookmin - TP. HCM">Kookmin - HCM</option>
    <option value="DBS - TP. HCM">DBS - HCM</option>
    <option value="TM TNHH MTV XAY DUNG">CBBank</option>
    <option value="Dai Chung TNHH Kasikornbank">KBank - HCM</option>
    <option value="TNHH MTV HSBC Viet Nam">HSBC</option>
    <option value="So Timo">Timo</option>
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
                                    <label class="nui-input-label" data-limit-text="20" for="thoigianchuyen">Chuyển Lúc</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('d/m/Y, H:i:s');?>"
                                            placeholder="Ví dụ: <?=date('d/m/Y, H:i:s');?>" required>
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
                                            value="<?=WsRandomString::Number(4)?>"
                                            placeholder="Ví dụ: <?=WsRandomString::Number(4)?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label class="nui-label text-[0.825rem]" for="noidungchuyen" data-limit-text="60">Nội
                                    Dung Chuyển <span
                                            class="cursor-pointer"
                                            data-nui-tooltip="Nội dung chuyển không được ghi dấu tiếng việt"><i
                                                class="ri-question-line"></i></span></label>
                                <div
                                    class="nui-textarea-wrapper nui-textarea-default nui-textarea-md nui-textarea-rounded-sm nui-textarea-not-resize">
                                    <div class="nui-textarea-outer">
                                        <textarea class="nui-textarea" name="noidungchuyen" rows="3"
                                            placeholder="Ví dụ: NGUYEN VAN A chuyen khoan"
                                            required>NGUYEN VAN A chuyen khoan</textarea>
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
                        <?=$Bill->Demo('https://files.catbox.moe/7e0am5.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>