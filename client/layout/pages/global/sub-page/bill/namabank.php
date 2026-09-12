<?php $options_header = ['title' => 'Tạo Bill Fake NamABank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-namabank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill NamABank </p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="tennguoichuyen">Tên Người
                                        Chuyển</label>
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
                                    <label class="nui-input-label" data-limit-text="17" for="stkgui">Số Tài Khoản Người
                                        Gửi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stkgui"
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

                            <div class="col-span-1" id="nganhangnhan">
                                <div
                                    class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select name="nganhangnhan" class="nui-select">
                                            <option value="VietcomBank - Ngoai Thuong Viet Nam">VietcomBank</option>
                                            <option value="VietinBank - TMCP Cong Thuong Viet Nam">VietinBank</option>
                                            <option value="Techcombank - TMCP Ky Thuong Viet Nam">Techcombank</option>
                                            <option value="BIDV - TMCP Dau Tu Va Phat Trien">BIDV</option>
                                            <option value="AgriBank - Nong Nghiep Va PT Nong Thon">AgriBank</option>
                                            <option value="Navibank - TMCP Quoc Dan">Navibank</option>
                                            <option value="Sacombank - TMCP Sai Gon Thuong Tin">Sacombank</option>
                                            <option value="ACB - TMCP A Chau">ACB</option>
                                            <option value="MBBank - Quan Doi">MBBank</option>
                                            <option value="TPBank - TMCP Tien Phong">TPBank</option>
                                            <option value="Shinhan Bank - TNHH MTV Shinhan Viet Nam">Shinhan Bank
                                            </option>
                                            <option value="VIB Bank - TMCP Quoc Te Viet Nam">VIB Bank</option>
                                            <option value="VPBank - TMCP Viet Nam Thinh Vuong">VPBank</option>
                                            <option value="SHB - TMCP Sai Gon Ha Noi">SHB</option>
                                            <option value="Eximbank - TMCP Xuat Nhap Khau Viet Nam">Eximbank</option>
                                            <option value="BaoVietBank - TMCP Bao Viet">BaoVietBank</option>
                                            <option value="VietcapitalBank - TMCP Ban Viet">VietcapitalBank</option>
                                            <option value="SCB - TMCP Sai Gon">SCB</option>
                                            <option value="VietNam - Russia Bank - Lien Doanh Viet Nga">VietNam - Russia
                                                Bank</option>
                                            <option value="ABBank - TMCP An Binh">ABBank</option>
                                            <option value="PVCombank - TMCP Dai Chung Viet Nam">PVCombank</option>
                                            <option value="OceanBank - TM TNHH MTV Dai Duong">OceanBank</option>
                                            <option value="NamA bank - TMCP Nam A">NamA bank</option>
                                            <option value="HDBank - TMCP Phat Trien TPHCM">HDBank</option>
                                            <option value="VietBank - TMCP Viet Nam Thuong Tin">VietBank</option>
                                            <option value="VietCredit - Cong ty Tai chinh Co Phan Tin Viet">VietCredit
                                            </option>
                                            <option value="Public bank - TNHH MTV Public VN">Public bank</option>
                                            <option value="Hongleong Bank - TNHH MTV Hongleong VN">Hongleong Bank
                                            </option>
                                            <option value="PG Bank - TMCP Xang Dau Petrolimex">PG Bank</option>
                                            <option value="Co.op Bank - Hop Tac">Co.op Bank</option>
                                            <option value="CIMB - TNHH MTV CIMB Viet Nam">CIMB</option>
                                            <option value="Indovina - TNHH Indovina">Indovina</option>
                                            <option value="DongABank - TMCP Dong A">DongABank</option>
                                            <option value="GPBank - TM TNHH MTV Dau Khi Toan Cau">GPBank</option>
                                            <option value="BacABank - TMCP Bac A">BacABank</option>
                                            <option value="VietABank - TMCP Viet A">VietABank</option>
                                            <option value="SaigonBank - TMCP Sai Gon Cong Thuong">SaigonBank</option>
                                            <option value="Maritime Bank - TMCP Hang Hai Viet Nam">Maritime Bank
                                            </option>
                                            <option value="LPBank - Loc Phat Viet Nam (LPB)">LPBank</option>
                                            <option value="KienLongBank - TMCP Kien Long">KienLongBank</option>
                                            <option value="IBK - Ha Noi - Cong Nghiep Han Quoc - Ha Noi">IBK - Ha Noi
                                            </option>
                                            <option value="Woori bank - Wooribank">Woori bank</option>
                                            <option value="SeABank - TMCP Dong Nam A">SeABank</option>
                                            <option value="UOB - TNHH MTV United Overseas Bank">UOB</option>
                                            <option value="OCB - TMCP Phuong Dong">OCB</option>
                                            <option value="Mirae Asset - TNHH MTV Mirae Asset (Viet Nam)">Mirae Asset
                                            </option>
                                            <option value="Keb Hana - Ho Chi Minh - Keb Hana - TP HCM">Keb Hana - Ho Chi
                                                Minh</option>
                                            <option value="Keb Hana - Ha Noi - Keb Hana - Ha Noi">Keb Hana - Ha Noi
                                            </option>
                                            <option value="Standard Chartered - Standard Chartered">Standard Chartered
                                            </option>
                                            <option value="CAKE - So CAKE by VPBank">CAKE</option>
                                            <option value="Ubank - So Ubank by VPBank">Ubank</option>
                                            <option value="Nonghyup Bank - HN - Nonghyup - Ha Noi">Nonghyup Bank - HN
                                            </option>
                                            <option value="Kookmin - HN - Kookmin - Ha Noi">Kookmin - HN</option>
                                            <option value="Kookmin - HCM - Kookmin - TP. HCM">Kookmin - HCM</option>
                                            <option value="DBS - HCM - DBS - TP. HCM">DBS - HCM</option>
                                            <option value="CBBank - TM TNHH MTV Xay Dung">CBBank</option>
                                            <option value="KBank - HCM - Dai Chung TNHH Kasikornbank">KBank - HCM
                                            </option>
                                            <option value="HSBC - TNHH MTV HSBC Viet Nam">HSBC</option>
                                            <option value="Timo - So Timo">Timo</option>
                                            <option value="NCB - TMCP Quoc Dan">NCB</option>
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
                                            value="<?=date('H:i d/m/Y')?>" placeholder="Ví dụ: <?=date('H:i d/m/Y')?>"
                                            required>
                                        <div class="nui-input-icon">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                function generateTransactionCode() {
                                    $part1 = strtoupper(bin2hex(random_bytes(10))); // tạo chuỗi chữ + số độ dài 20
                                    $part1 = substr($part1, 0, 20); // cắt chính xác 20 ký tự
                                    $part2 = '_';
                                    $part3 = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT); // tạo 8 số ngẫu nhiên, ví dụ: 77881955
                                    return $part1 . $part2 . $part3;
                                }
                            ?>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="30" for="magiaodich">Mã Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="magiaodich"
                                            value="<?= generateTransactionCode() ?>"
                                            placeholder="Ví dụ: <?= generateTransactionCode() ?>" required>
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
                                <label class="nui-label text-[0.825rem]" for="noidungchuyen" data-limit-text="30">Nội
                                    Dung Chuyển</label>
                                <div
                                    class="nui-textarea-wrapper nui-textarea-default nui-textarea-md nui-textarea-rounded-sm nui-textarea-not-resize">
                                    <div class="nui-textarea-outer">
                                        <textarea class="nui-textarea" name="noidungchuyen" rows="2"
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
                        <?=$Bill->Demo('https://files.catbox.moe/yuvfw4.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>