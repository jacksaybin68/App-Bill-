<?php $options_header = ['title' => 'Tạo Bill Fake Liobank Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-liobank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill Liobank</p>
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
                                    <label class="nui-input-label" data-limit-text="50" for="tennguoigui">Tên Người
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
                                    <label class="nui-input-label" data-limit-text="17" for="stkgui">Số Tài Khoản Người
                                        Gửi</label>
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
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nganhangnhan">Ngân Hàng Nhận</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nganhangnhan">
                                        <option value="Vietcombank">VietcomBank</option>
    <option value="VietinBank">VietinBank</option>
    <option value="Techcombank">Techcombank</option>
    <option value="BIDV">BIDV</option>
    <option value="AgriBank">AgriBank</option>
    <option value="Navibank">Navibank</option>
    <option value="Sacombank">Sacombank</option>
    <option value="ACB">ACB</option>
    <option value="MBBank">MBBank</option>
    <option value="TPBank">TPBank</option>
    <option value="Shinhan Bank">Shinhan Bank</option>
    <option value="VIB Bank">VIB Bank</option>
    <option value="VPBank">VPBank</option>
    <option value="SHB">SHB</option>
    <option value="Eximbank">Eximbank</option>
    <option value="BaoVietBank">BaoVietBank</option>
    <option value="VietcapitalBank">VietcapitalBank</option>
    <option value="SCB">SCB</option>
    <option value="VietNam - Russia Bank">VietNam - Russia Bank</option>
    <option value="ABBank">ABBank</option>
    <option value="PVCombank">PVCombank</option>
    <option value="OceanBank">OceanBank</option>
    <option value="NamA bank">NamA bank</option>
    <option value="HDBank">HDBank</option>
    <option value="VietBank">VietBank</option>
    <option value="VietCredit">VietCredit</option>
    <option value="Public bank">Public bank</option>
    <option value="Hongleong Bank">Hongleong Bank</option>
    <option value="PG Bank">PG Bank</option>
    <option value="Co.op Bank">Co.op Bank</option>
    <option value="CIMB">CIMB</option>
    <option value="Indovina">Indovina</option>
    <option value="DongABank">DongABank</option>
    <option value="GPBank">GPBank</option>
    <option value="BacABank">BacABank</option>
    <option value="VietABank">VietABank</option>
    <option value="SaigonBank">SaigonBank</option>
    <option value="Maritime Bank">Maritime Bank</option>
    <option value="LienVietPostBank">LienVietPostBank</option>
    <option value="KienLongBank">KienLongBank</option>
    <option value="IBK - Ha Noi">IBK - Ha Noi</option>
    <option value="Woori bank">Woori bank</option>
    <option value="SeABank">SeABank</option>
    <option value="UOB">UOB</option>
    <option value="OCB">OCB</option>
    <option value="Mirae Asset">Mirae Asset</option>
    <option value="Keb Hana - Ho Chi Minh">Keb Hana - Ho Chi Minh</option>
    <option value="Keb Hana - Ha Noi">Keb Hana - Ha Noi</option>
    <option value="Standard Chartered">Standard Chartered</option>
    <option value="CAKE">CAKE</option>
    <option value="Ubank">Ubank</option>
    <option value="Nonghyup Bank - HN">Nonghyup Bank - HN</option>
    <option value="Kookmin - HN">Kookmin - HN</option>
    <option value="Kookmin - HCM">Kookmin - HCM</option>
    <option value="DBS - HCM">DBS - HCM</option>
    <option value="CBBank">CBBank</option>
    <option value="KBank - HCM">KBank - HCM</option>
    <option value="HSBC">HSBC</option>
    <option value="NCB">NCB</option>
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
                                    <label class="nui-input-label" data-limit-text="27" for="thoigianchuyen">Thời Gian
                                        Chuyển</label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('H:i, j.n.Y');?>"
                                            placeholder="Ví dụ: <?=date('H:i, j.n.Y');?>" required>
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
                        <?=$Bill->Demo('https://files.catbox.moe/zifcz2.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>