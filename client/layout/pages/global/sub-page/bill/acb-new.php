<?php $options_header = ['title' => 'Tạo Bill Fake ACB Bank New Chuyển Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-acb-new hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill ACB Bank New</p>
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
                                    <label class="nui-input-label" data-limit-text="9" for="stk_nc">Số Tài Khoản Người
                                    Chuyển</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="stk_nc"
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
                                    <label class="nui-input-label" data-limit-text="20" for="stk">Số Tài Khoản Người
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
                                            <option data-bank="techcombank" value="Techcombank - NH TMCP Ky Thuong Viet Nam">Techcombank - NH TMCP Ky Thuong Viet Nam</option>
                                            <option data-bank="vietinbank" value="Vietinbank - NH TMCP Cong Thuong">Vietinbank - NH TMCP Cong Thuong</option>
                                            <option data-bank="vietcombank" value="Vietcombank - NH TMCP Ngoai Thuong">Vietcombank - NH TMCP Ngoai Thuong</option>
                                            <option data-bank="bidv" value="BIDV - NH TMCP Dau Tu Va Phat Trien VN">BIDV - NH TMCP Dau Tu Va Phat Trien VN</option>
                                            <option data-bank="agribank" value="Agribank - NH Nong Nghiep Va Phat Trien Nong Thon">Agribank - NH Nong Nghiep Va Phat Trien Nong Thon</option>
                                            <option data-bank="ocb" value="OCB - NH TMCP Phuong Dong">OCB - NH TMCP Phuong Dong</option>
                                            <option data-bank="mbbank" value="Mbbank - NH TMCP Quan Doi">Mbbank - NH TMCP Quan Doi</option>
                                            <option data-bank="acbbank" value="ACB - NH TMCP A Chau">ACB - NH TMCP A Chau</option>
                                            <option data-bank="vpbank" value="VPBank - NH TMCP Viet Nam Thinh Vuong">VPBank - NH TMCP Viet Nam Thinh Vuong</option>
                                            <option data-bank="tpbank" value="TPBank - NH TMCP Tien Phong">TPBank - NH TMCP Tien Phong</option>
                                            <option data-bank="scb" value="Sacombank - NH TMCP Sai Gon Thuong Tin">Sacombank - NH TMCP Sai Gon Thuong Tin</option>
                                            <option data-bank="shb" value="SHB - NH TMCP Sai Gon - Ha Noi">SHB - NH TMCP Sai Gon - Ha Noi</option>
                                            <option data-bank="sgb" value="Saigonbank - NH TMCP Sai Gon Cong Thuong">Saigonbank - NH TMCP Sai Gon Cong Thuong</option>
                                            <option data-bank="oceanbank" value="Oceanbank - NH TMCP Dai Duong">Oceanbank - NH TMCP Dai Duong</option>
                                            <option data-bank="vietabank" value="VietABank - NH TMCP Viet A">VietABank - NH TMCP Viet A</option>
                                            <option data-bank="namabank" value="NamABank - NH TMCP Nam A">NamABank - NH TMCP Nam A</option>
                                            <option data-bank="vietbank" value="Vietbank - NH TMCP Viet A Thuong Tin">Vietbank - NH TMCP Viet A Thuong Tin</option>
                                            <option data-bank="dongabank" value="DongABank - NH TMCP Dong A">DongABank - NH TMCP Dong A</option>
                                            <option data-bank="eximbank" value="Eximbank - NH TMCP Xuat Nhap Khau Viet Nam">Eximbank - NH TMCP Xuat Nhap Khau Viet Nam</option>
                                            <option data-bank="abbank" value="ABBank - NH TMCP An Binh">ABBank - NH TMCP An Binh</option>
                                            <option data-bank="lpb" value="Lienvietpostbank - NH TMCP Buu Dien Lien Viet">Lienvietpostbank - NH TMCP Buu Dien Lien Viet</option>
                                            <option data-bank="vib" value="VIB - NH TMCP Quoc Te">VIB - NH TMCP Quoc Te</option>
                                            <option data-bank="bvbank" value="BVBank - NH TMCP Ban Viet">BVBank - NH TMCP Ban Viet</option>
                                            <option data-bank="kienlongbank" value="Kienlongbank - NH TMCP Kien Long">Kienlongbank - NH TMCP Kien Long</option>
                                            <option data-bank="shinhanbank" value="Shinhanbank - Ngan Hang Shinhan Viet Nam">Shinhanbank - Ngan Hang Shinhan Viet Nam</option>
                                            <option data-bank="msb" value="MSB - NH TMCP Hang Hai">MSB - NH TMCP Hang Hai</option>
                                            <option data-bank="ncb" value="NCB - NH TMCP Quoc Dan">NCB - NH TMCP Quoc Dan</option>

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
                            <!-- <div class="col-span-1">
                                <div class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="kieuchuyen">Thông Báo Biến Động Số Dư</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="kieuchuyen" id="kieuchuyen-2">
                                            <option value="macdinh">Không</option>
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
                            </div> -->
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
                            <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                <label class="nui-input-label" data-limit-text="20" for="ngayhieuluc">Hiệu Lực</label>
                                <div class="nui-input-outer">
                                    <input type="text" class="nui-input" name="ngayhieuluc"
                                        value="<?= date('d/m/Y', strtotime('+1 day')); ?>"
                                        placeholder="Ví dụ: <?= date('d/m/Y', strtotime('+1 day')); ?>" required>
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
                        <?=$Bill->Demo('https://i.ibb.co/C3Y9xfKG/ACB-NEW-BILLVIET-PRO-17226.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>