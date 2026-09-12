<?php $options_header = ['title' => 'Tạo Bill Fake VietBank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-vietbank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill VietBank</p>
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
                                                placeholder="Ví dụ: 10<?=WsRandomString::Number(9)?>"
                                                value="1223304323" required>
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
                                                value="18666761" required>
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
  <option value="NH TMCP Ngoai Thuong Viet Nam (VietcomBank)">VietcomBank</option>
  <option value="NH TMCP Cong Thuong Viet Nam (VietinBank)">VietinBank</option>
  <option value="NH TMCP Ky Thuong Viet Nam (Techcombank)">Techcombank</option>
  <option value="NH TMCP Dau Tu Va Phat Trien (BIDV)">BIDV</option>
  <option value="NH Nong Nghiep Va PT Nong Thon (AgriBank)">AgriBank</option>
  <option value="NH TMCP Quoc Dan (Navibank)">Navibank</option>
  <option value="NH TMCP Sai Gon Thuong Tin (Sacombank)">Sacombank</option>
  <option value="NH TMCP A Chau (ACB)">ACB</option>
  <option value="NH TMCP Quan Doi (MBBank)">MBBank</option>
  <option value="NH TMCP Tien Phong (TPBank)">TPBank</option>
  <option value="NH TNHH MTV Shinhan Viet Nam (Shinhan Bank)">Shinhan Bank</option>
  <option value="NH TMCP Quoc Te Viet Nam (VIB Bank)">VIB Bank</option>
  <option value="NH TMCP Viet Nam Thinh Vuong (VPBank)">VPBank</option>
  <option value="NH TMCP Sai Gon Ha Noi (SHB)">SHB</option>
  <option value="NH TMCP Xuat Nhap Khau Viet Nam (Eximbank)">Eximbank</option>
  <option value="NH TMCP Bao Viet (BaoVietBank)">BaoVietBank</option>
  <option value="NH TMCP Ban Viet (VietcapitalBank)">VietcapitalBank</option>
  <option value="NH TMCP Sai Gon (SCB)">SCB</option>
  <option value="NH Lien Doanh Viet Nga (VietNam - Russia Bank)">VietNam - Russia Bank</option>
  <option value="NH TMCP An Binh (ABBank)">ABBank</option>
  <option value="NH TMCP Dai Chung Viet Nam (PVCombank)">PVCombank</option>
  <option value="NH TM TNHH MTV Dai Duong (OceanBank)">OceanBank</option>
  <option value="NH TMCP Nam A (NamA bank)">NamA bank</option>
  <option value="NH TMCP Phat Trien TPHCM (HDBank)">HDBank</option>
  <option value="NH TMCP Viet Nam Thuong Tin (VietBank)">VietBank</option>
  <option value="NH Cong ty Tai chinh Co Phan Tin Viet (VietCredit)">VietCredit</option>
  <option value="NH TNHH MTV Public VN (Public bank)">Public bank</option>
  <option value="NH TNHH MTV Hongleong VN (Hongleong Bank)">Hongleong Bank</option>
  <option value="NH TMCP Xang Dau Petrolimex (PG Bank)">PG Bank</option>
  <option value="NH Hop Tac (Co.op Bank)">Co.op Bank</option>
  <option value="NH TNHH MTV CIMB Viet Nam (CIMB)">CIMB</option>
  <option value="NH TNHH Indovina (Indovina)">Indovina</option>
  <option value="NH TMCP Dong A (DongABank)">DongABank</option>
  <option value="NH TM TNHH MTV Dau Khi Toan Cau (GPBank)">GPBank</option>
  <option value="NH TMCP Bac A (BacABank)">BacABank</option>
  <option value="NH TMCP Viet A (VietABank)">VietABank</option>
  <option value="NH TMCP Sai Gon Cong Thuong (SaigonBank)">SaigonBank</option>
  <option value="NH TMCP Hang Hai Viet Nam (Maritime Bank)">Maritime Bank</option>
  <option value="NH TMCP Buu Dien Lien Viet (LienVietPostBank)">LienVietPostBank</option>
  <option value="NH TMCP Kien Long (KienLongBank)">KienLongBank</option>
  <option value="NH Cong Nghiep Han Quoc - Ha Noi (IBK - Ha Noi)">IBK - Ha Noi</option>
  <option value="NH Wooribank (Woori bank)">Woori bank</option>
  <option value="NH TMCP Dong Nam A (SeABank)">SeABank</option>
  <option value="NH TNHH MTV United Overseas Bank (UOB)">UOB</option>
  <option value="NH TMCP Phuong Dong (OCB)">OCB</option>
  <option value="NH TNHH MTV Mirae Asset (Viet Nam) (Mirae Asset)">Mirae Asset</option>
  <option value="NH Keb Hana - TP HCM (Keb Hana - Ho Chi Minh)">Keb Hana - Ho Chi Minh</option>
  <option value="NH Keb Hana - Ha Noi (Keb Hana - Ha Noi)">Keb Hana - Ha Noi</option>
  <option value="NH Standard Chartered (Standard Chartered)">Standard Chartered</option>
  <option value="NH So CAKE by VPBank (CAKE)">CAKE</option>
  <option value="NH So Ubank by VPBank (Ubank)">Ubank</option>
  <option value="NH Nonghyup - Ha Noi (Nonghyup Bank - HN)">Nonghyup Bank - HN</option>
  <option value="NH Kookmin - Ha Noi (Kookmin - HN)">Kookmin - HN</option>
  <option value="NH Kookmin - TP. HCM (Kookmin - HCM)">Kookmin - HCM</option>
  <option value="NH DBS - TP. HCM (DBS - HCM)">DBS - HCM</option>
  <option value="NH TM TNHH MTV Xay Dung (CBBank)">CBBank</option>
  <option value="NH Dai Chung TNHH Kasikornbank (KBank - HCM)">KBank - HCM</option>
  <option value="NH TNHH MTV HSBC Viet Nam (HSBC)">HSBC</option>
  <option value="NH So Timo (Timo)">Timo</option>
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
                        <?=$Bill->Demo('https://files.catbox.moe/t3fub3.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>