<?php $options_header = ['title' => 'Thuê APP Bank Ảo']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="w-full pb-6">
        <div class="bg-muted-200 dark:bg-muted-950/50 rounded-xl p-4 sm:p-6">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h3
                        class="nui-heading nui-heading-xl nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100">
                        APP Ngân Hàng</h3>
                    <p
                        class="nui-paragraph nui-paragraph-md nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                        Hướng dẫn sử dụng cho người mới</p>
                </div>
            </div>
            <div class="ltablet:grid-cols-2 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="relative <?=isMobile() ? 'hidden' : ''?>">
                    <div
                        class="nui-card nui-card-rounded-md nui-card-default flex flex-col gap-4 <?=isMobile() ? 'p-3' : 'p-4'?> sm:flex-row sm:items-center shadow-lg border-none">
                        <div
                            class="flex w-full shrink-0 items-center justify-center rounded-xl sm:size-32 <?=isMobile() ? 'hidden' : ''?>">
                            <img src="https://i.ibb.co/SgQ2fg4/image.png" class="w-full" alt="">
                        </div>
                        <div class="flex flex-col">
                            <h3
                                class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100 mb-2">
                                Cách Thuê APP</h3>
                            <p
                                class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 mb-4">
                                • Bạn cần phải có một tài khoản trên trang web này, nếu chưa có hãy đến trang "<b> Đăng
                                    Ký </b>" hoặc "<b> Đăng Nhập </b>".
                                <br>• Hãy nhấn vào nút <b>Thuê Ngay</b> vào ngân hàng bạn muốn thuê bank ảo để bắt đầu.
                                <br>• Tất cả app bank điều là giao diện mới nhất thời điểm hiện tại. <br> <br> <br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div
                        class="nui-card nui-card-rounded-md nui-card-default flex flex-col gap-4 <?=isMobile() ? 'p-3' : 'p-4'?> sm:flex-row sm:items-center shadow-lg border-none">
                        <div
                            class="flex w-full shrink-0 items-center justify-center rounded-xl sm:size-32 <?=isMobile() ? 'hidden' : ''?>">
                            <img src="https://i.ibb.co/7JjmhF2m/image.png" class="w-full" alt="">
                        </div>
                        <div class="flex flex-col">
                            <h3
                                class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100 mb-2">
                                Hướng Dẫn Sử Dụng</h3>
                            <p
                                class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 mb-4">
                                • Hãy gửi các thông tin cần thiết để tạo tài khoản và thông tin trên app bank ảo.
                                <br>• <font color="green">Số Điện Thoại:</font> là tài khoản tự chọn để đăng nhập vào app bank ảo.
                                <br>• <font color="green">Mật Khẩu:</font> tự chọn để đăng nhập vào app bank ảo.
                                <br>• <font color="green">Số Tài Khoản:</font> phải tồn tại bên app bank thật, có thể lấy của người khác.
                                <br>• <font color="green">Số Tiền Trong APP:</font> số tiền mong muốn có trong app bank ảo.
                                <br>• <font color="green">OTP Giao Dịch:</font> chọn 6 mã số để làm mã OTP khi chuyển tiền.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-thue-bank hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Thông Tin Bank Ảo</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo thông tin bank ảo</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="12" for="sdt">Số Điện Thoại</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="number" class="nui-input" name="sdt"
                                                placeholder="Số điện thoại để đăng nhập vào app" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="mk">Mật Khẩu</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="mk"
                                                placeholder="Mật khẩu để đăng nhập vào app" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="stk">Số Tài Khoản</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="number" class="nui-input" name="stk"
                                                placeholder="Số tài khoản phải tồn tại bên bank thật" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md nui-has-icon">
                                    <label class="nui-select-label" for="nh">Chọn APP Ngân Hàng</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="nh">
                                            <option data-bank="MB Bank 30-4" selected value="MB Bank">MB Bank 30-4</option>
                                            <option data-bank="MB Bank" selected value="MB Bank">MB Bank</option>
                                            <option data-bank="Vietinbank"
                                                value="Vietinbank">Vietinbank</option>
                                            <option data-bank="TP Bank" value="TP Bank">TP Bank</option>
                                            <option data-bank="Vietcombank" value="Vietcombank">
                                                Vietcombank</option>
                                                <option data-bank="Techcombank" value="Techcombank">
                                                Techcombank</option> 
                                                <option data-bank="MB Bank Priority" value="MB Bank Priority">
                                                MB Bank Priority</option>
                                            <option data-bank="BIDV" value="BIDV">BIDV</option>
                                            <option data-bank="MB Bank Priority 30-4" value="MB Bank Priority 30-4">
                                                MB Bank Priority 30-4</option>
                                            
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
                                    class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="gia">Chọn Gói</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="gia">
                                            
                                            <option value="5" >1.400.000đ - 1 Tuần | Gói Sale | Hỗ Trợ Cài APP</option>
                                            <option value="2">2.200.000đ - 1 Tháng | Hỗ Trợ Cài APP</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-select-wrapper nui-select-default nui-select-md nui-select-rounded-md">
                                    <label class="nui-select-label" for="tb">Thiết Bị</label>
                                    <div class="nui-select-outer">
                                        <select class="nui-select" name="tb">
                                            <option value="iPhone">iPhone/IPA</option>
                                            <option value="Android">Android/APK</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <div
                                        class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                                        <label class="nui-input-label" for="sotien" data-limit-text="40">Số Tiền
                                            Trong APP</label>
                                        <div class="nui-input-number-outer">
                                            <input type="text" class="nui-input-number td-format-money"
                                                data-td-msg="Số tiền phải là một con số!" name="sotien"
                                                placeholder="Số tiền mong muốn trong app" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="6" for="otp">OTP Giao Dịch</label>
                                    <div class="nui-input-outer">
                                        <input type="number" class="nui-input" name="otp"
                                            placeholder="Đặt mã làm otp khi chuyển tiền" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="lh">Telegram Liên Hệ</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="lh"
                                                placeholder="Nhập telegram để chúng tôi liên lạc với bạn" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="thue-app-bank-ao">
                            <div class="mt-auto flex flex-col-reverse text-end md:block md:space-x-3 gap-2 text-nowrap">
                                <button type="button"
                                    class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-muted w-full sm:w-32 clear-form">
                                    <i class="ri-refresh-line me-2"></i>Làm Mới
                                </button>
                                <button type="submit"
                                    class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-primary w-full sm:w-32">
                                    <i class="ri-check-line me-2"></i>Thuê Ngay
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>