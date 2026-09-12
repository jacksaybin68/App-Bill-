<?php $options_header = ['title' => 'Tạo Bill Fake BacABank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-bacabank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill BacABank</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
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
                                            <option value="VCB - NH TMCP NGOAI THUONG VIET NAM">VCB - NH TMCP NGOAI
                                                THUONG VIET NAM</option>
                                            <option value="CTG - NH TMCP CONG THUONG VIET NAM">CTG - NH TMCP CONG THUONG
                                                VIET NAM</option>
                                            <option value="TCB - NH TMCP KY THUONG VIET NAM">TCB - NH TMCP KY THUONG
                                                VIET NAM</option>
                                            <option value="BIDV - NH TMCP DAU TU VA PHAT TRIEN">BIDV - NH TMCP DAU TU VA
                                                PHAT TRIEN</option>
                                            <option value="VARB - NONG NGHIEP VA PT NONG THON">VARB - NONG NGHIEP VA PT
                                                NONG THON</option>
                                            <option value="NVB - NH TMCP QUOC DAN">NVB - NH TMCP QUOC DAN</option>
                                            <option value="STB - NH TMCP SAI GON THUONG TIN">STB - NH TMCP SAI GON
                                                THUONG TIN</option>
                                            <option value="ACB - NH TMCP A CHAU">ACB - NH TMCP A CHAU</option>
                                            <option value="MB - NH TMCP QUAN DOI">MB - NH TMCP QUAN DOI</option>
                                            <option value="TPB - NH TMCP TIEN PHONG">TPB - NH TMCP TIEN PHONG</option>
                                            <option value="SVB - TNHH MTV SHINHAN VIET NAM">SVB - TNHH MTV SHINHAN VIET
                                                NAM</option>
                                            <option value="VIB - NH TMCP QUOC TE VIET NAM">VIB - NH TMCP QUOC TE VIET
                                                NAM</option>
                                            <option value="VPB - NH TMCP VIET NAM THINH VUONG">VPB - NH TMCP VIET NAM
                                                THINH VUONG</option>
                                            <option value="SHB - NH TMCP SAI GON HA NOI">SHB - NH TMCP SAI GON HA NOI
                                            </option>
                                            <option value="EIB - NH TMCP XUAT NHAP KHAU VIET NAM">EIB - NH TMCP XUAT
                                                NHAP KHAU VIET NAM</option>
                                            <option value="BVB - NH TMCP BAO VIET">BVB - NH TMCP BAO VIET</option>
                                            <option value="VCCB - NH TMCP BAN VIET">VCCB - NH TMCP BAN VIET</option>
                                            <option value="SCB - NH TMCP SAI GON">SCB - NH TMCP SAI GON</option>
                                            <option value="VRB - LIEN DOANH VIET NGA">VRB - LIEN DOANH VIET NGA</option>
                                            <option value="ABB - NH TMCP AN BINH">ABB - NH TMCP AN BINH</option>
                                            <option value="PVCB - NH TMCP DAI CHUNG VIET NAM">PVCB - NH TMCP DAI CHUNG
                                                VIET NAM</option>
                                            <option value="OJB - NH TM TNHH MTV DAI DUONG">OJB - NH TM TNHH MTV DAI
                                                DUONG</option>
                                            <option value="NAB - NH TMCP NAM A">NAB - NH TMCP NAM A</option>
                                            <option value="HDB - NH TMCP PHAT TRIEN TPHCM">HDB - NH TMCP PHAT TRIEN
                                                TPHCM</option>
                                            <option value="VB - NH TMCP VIET NAM THUONG TIN">VB - NH TMCP VIET NAM
                                                THUONG TIN</option>
                                            <option value="CFC - CONG TY TAI CHINH CO PHAN TIN VIET">CFC - CONG TY TAI
                                                CHINH CO PHAN TIN VIET</option>
                                            <option value="PBVN - TNHH MTV PUBLIC VN">PBVN - TNHH MTV PUBLIC VN</option>
                                            <option value="HLB - TNHH MTV HONGLEONG VN">HLB - TNHH MTV HONGLEONG VN
                                            </option>
                                            <option value="PGB - NH TMCP XANG DAU PETROLIMEX">PGB - NH TMCP XANG DAU
                                                PETROLIMEX</option>
                                            <option value="COB - HOP TAC">COB - HOP TAC</option>
                                            <option value="CIMB - TNHH MTV CIMB VIET NAM">CIMB - TNHH MTV CIMB VIET NAM
                                            </option>
                                            <option value="IVB - TNHH INDOVINA">IVB - TNHH INDOVINA</option>
                                            <option value="DAB - NH TMCP DONG A">DAB - NH TMCP DONG A</option>
                                            <option value="GPB - NH TM TNHH MTV DAU KHI TOAN CAU">GPB - NH TM TNHH MTV
                                                DAU KHI TOAN CAU</option>
                                            <option value="NASB - NH TMCP BAC A">NASB - NH TMCP BAC A</option>
                                            <option value="VAB - NH TMCP VIET A">VAB - NH TMCP VIET A</option>
                                            <option value="SGB - NH TMCP SAI GON CONG THUONG">SGB - NH TMCP SAI GON CONG
                                                THUONG</option>
                                            <option value="MSB - NH TMCP HANG HAI VIET NAM">MSB - NH TMCP HANG HAI VIET
                                                NAM</option>
                                            <option value="LPB - NH TMCP BUU DIEN LIEN VIET">LPB - NH TMCP BUU DIEN LIEN
                                                VIET</option>
                                            <option value="KLB - NH TMCP KIEN LONG">KLB - NH TMCP KIEN LONG</option>
                                            <option value="IBKHN - CONG NGHIEP HAN QUOC - HA NOI">IBKHN - CONG NGHIEP
                                                HAN QUOC - HA NOI</option>
                                            <option value="WOO - WOORIBANK">WOO - WOORIBANK</option>
                                            <option value="SEAB - NH TMCP DONG NAM A">SEAB - NH TMCP DONG NAM A</option>
                                            <option value="UOB - TNHH MTV UNITED OVERSEAS BANK">UOB - TNHH MTV UNITED
                                                OVERSEAS BANK</option>
                                            <option value="OCB - NH TMCP PHUONG DONG">OCB - NH TMCP PHUONG DONG</option>
                                            <option value="MAFC - TNHH MTV MIRAE ASSET (VIET NAM)">MAFC - TNHH MTV MIRAE
                                                ASSET (VIET NAM)</option>
                                            <option value="KEBHANAHCM - KEB HANA - TP HCM">KEBHANAHCM - KEB HANA - TP
                                                HCM</option>
                                            <option value="KEBHANAHN - KEB HANA - HA NOI">KEBHANAHN - KEB HANA - HA NOI
                                            </option>
                                            <option value="STANDARD - STANDARD CHARTERED">STANDARD - STANDARD CHARTERED
                                            </option>
                                            <option value="CAKE - SO CAKE BY VPBANK">CAKE - SO CAKE BY VPBANK</option>
                                            <option value="UBANK - SO UBANK BY VPBANK">UBANK - SO UBANK BY VPBANK
                                            </option>
                                            <option value="NONGHYUPBANKHN - NONGHYUP - HA NOI">NONGHYUPBANKHN - NONGHYUP
                                                - HA NOI</option>
                                            <option value="KBHN - KOOKMIN - HA NOI">KBHN - KOOKMIN - HA NOI</option>
                                            <option value="KBHCM - KOOKMIN - TP. HCM">KBHCM - KOOKMIN - TP. HCM</option>
                                            <option value="DBSHCM - DBS - TP. HCM">DBSHCM - DBS - TP. HCM</option>
                                            <option value="CBBANK - NH TM TNHH MTV XAY DUNG">CBBANK - NH TM TNHH MTV XAY
                                                DUNG</option>
                                            <option value="KBANKHCM - DAI CHUNG TNHH KASIKORNBANK">KBANKHCM - DAI CHUNG
                                                TNHH KASIKORNBANK</option>
                                            <option value="HSBC - TNHH MTV HSBC VIET NAM">HSBC - TNHH MTV HSBC VIET NAM
                                            </option>
                                            <option value="TIMO - SO TIMO">TIMO - SO TIMO</option>
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
                        <?=$Bill->Demo('https://thanhdieu.com/bill/bacabank.jpg');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>