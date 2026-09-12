<?php $options_header = ['title' => 'Tạo Bill Fake SHB Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-shb hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill SHB Cũ</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="17" for="stkgui">Số Tài Khoản Người
                                        Gửi</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stkgui"
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>" value="1223304323"
                                                required>
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
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>" value="18666761"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="name_nhan">Tên Người
                                        Nhận</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input td-format-text" name="name_nhan"
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
                                            <option value="TMCP Ngoai Thuong Viet Nam (VCB)">VietcomBank</option>
                                            <option value="TMCP Cong Thuong Viet Nam (CTG)">VietinBank</option>
                                            <option value="TMCP Ky Thuong Viet Nam (TCB)">Techcombank</option>
                                            <option value="TMCP Dau Tu Va Phat Trien (BIDV)">BIDV</option>
                                            <option value="Nong Nghiep Va PT Nong Thon (AGRIBANK)">AgriBank</option>
                                            <option value="TMCP Quoc Dan (NVB)">Navibank</option>
                                            <option value="TMCP Sai Gon Thuong Tin (STB)">Sacombank</option>
                                            <option value="TMCP A Chau (ACB)">ACB</option>
                                            <option value="TMCP Quan Doi (MBB)">MBBank</option>
                                            <option value="TMCP Tien Phong (TPB)">TPBank</option>
                                            <option value="TNHH MTV Shinhan Viet Nam (SHBVN)">Shinhan Bank</option>
                                            <option value="TMCP Quoc Te Viet Nam (VIB)">VIB Bank</option>
                                            <option value="TMCP Viet Nam Thinh Vuong (VPB)">VPBank</option>
                                            <option value="TMCP Sai Gon Ha Noi (SHB)">SHB</option>
                                            <option value="TMCP Xuat Nhap Khau Viet Nam (EIB)">Eximbank</option>
                                            <option value="TMCP Bao Viet (BVB)">BaoVietBank</option>
                                            <option value="TMCP Ban Viet (VCB)">VietcapitalBank</option>
                                            <option value="TMCP Sai Gon (SCB)">SCB</option>
                                            <option value="Lien Doanh Viet Nga (VRB)">VietNam - Russia Bank</option>
                                            <option value="TMCP An Binh (ABB)">ABBank</option>
                                            <option value="TMCP Dai Chung Viet Nam (PVCB)">PVCombank</option>
                                            <option value="TNHH MTV Dai Duong (OJB)">OceanBank</option>
                                            <option value="TMCP Nam A (NAB)">NamA bank</option>
                                            <option value="TMCP Phat Trien TPHCM (HDB)">HDBank</option>
                                            <option value="TMCP Viet Nam Thuong Tin (VBB)">VietBank</option>
                                            <option value="Tai chinh Co Phan Tin Viet (VietCredit)">VietCredit</option>
                                            <option value="TNHH MTV Public VN (PBVN)">Public bank</option>
                                            <option value="TNHH MTV Hongleong VN (HLBVN)">Hongleong Bank</option>
                                            <option value="TMCP Xang Dau Petrolimex (PGB)">PG Bank</option>
                                            <option value="Hop Tac (COOPBANK)">Co.op Bank</option>
                                            <option value="TNHH MTV CIMB Viet Nam (CIMB)">CIMB</option>
                                            <option value="TNHH Indovina (IVB)">Indovina</option>
                                            <option value="TMCP Dong A (DAB)">DongABank</option>
                                            <option value="TNHH MTV Dau Khi Toan Cau (GPB)">GPBank</option>
                                            <option value="TMCP Bac A (BAB)">BacABank</option>
                                            <option value="TMCP Viet A (VAB)">VietABank</option>
                                            <option value="TMCP Sai Gon Cong Thuong (SGB)">SaigonBank</option>
                                            <option value="TMCP Hang Hai Viet Nam (MSB)">Maritime Bank</option>
                                            <option value="TMCP Buu Dien Lien Viet (LPB)">LienVietPostBank</option>
                                            <option value="TMCP Kien Long (KLB)">KienLongBank</option>
                                            <option value="Cong Nghiep Han Quoc - Ha Noi (IBK-HN)">IBK - Ha Noi</option>
                                            <option value="Wooribank (WOO)">Woori bank</option>
                                            <option value="TMCP Dong Nam A (SEAB)">SeABank</option>
                                            <option value="TNHH MTV United Overseas Bank (UOB)">UOB</option>
                                            <option value="TMCP Phuong Dong (OCB)">OCB</option>
                                            <option value="TNHH MTV Mirae Asset (MIRAE)">Mirae Asset</option>
                                            <option value="Keb Hana - TP HCM (KEB-HCM)">Keb Hana - Ho Chi Minh</option>
                                            <option value="Keb Hana - Ha Noi (KEB-HN)">Keb Hana - Ha Noi</option>
                                            <option value="Standard Chartered (SCVN)">Standard Chartered</option>
                                            <option value="So CAKE by VPBank (CAKE)">CAKE</option>
                                            <option value="So Ubank by VPBank (UBANK)">Ubank</option>
                                            <option value="Nonghyup - Ha Noi (NH-HN)">Nonghyup Bank - HN</option>
                                            <option value="Kookmin - Ha Noi (KB-HN)">Kookmin - HN</option>
                                            <option value="Kookmin - TP. HCM (KB-HCM)">Kookmin - HCM</option>
                                            <option value="DBS - TP. HCM (DBS-HCM)">DBS - HCM</option>
                                            <option value="TM TNHH MTV Xay Dung (CBB)">CBBank</option>
                                            <option value="Dai Chung TNHH Kasikornbank (KBANK)">KBank - HCM</option>
                                            <option value="TNHH MTV HSBC Viet Nam (HSBC)">HSBC</option>
                                            <option value="So Timo (TIMO)">Timo</option>
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
                                    <label class="nui-input-label" data-limit-text="17" for="magiaodich">Mã Giao
                                        Dịch</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="magiaodich"
                                                placeholder="Ví dụ: UUU<?=WsRandomString::Number(9)?>"
                                                value="UUU<?=WsRandomString::Number(9)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="19" for="thoigianchuyen">Thời Gian
                                        Chuyển </label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('d/m/Y H:i')?>" placeholder="Ví dụ: <?=date('d/m/Y H:i')?>"
                                            required>
                                        <div class="nui-input-icon">
                                            <i class="ri-time-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="5" for="thoigiantrendt">Thời Gian
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
                                <label class="nui-label text-[0.825rem]" for="noidung" data-limit-text="37">Nội
                                    Dung Chuyển</label>
                                <div
                                    class="nui-textarea-wrapper nui-textarea-default nui-textarea-md nui-textarea-rounded-sm nui-textarea-not-resize">
                                    <div class="nui-textarea-outer">
                                        <textarea class="nui-textarea" name="noidung" rows="3"
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
                        <?=$Bill->Demo('https://files.catbox.moe/nvzgvp.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>