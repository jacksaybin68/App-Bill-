<?php $options_header = ['title' => 'Nạp Tiền Vào Tài Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php if(!$isLogin->check()){die('<meta http-equiv="refresh"content="0; url=/oauth/dang-nhap?redirect='.urlencode($actual_link).'">');}?>
<main>
    <div class="dark:bg-muted-900 bg-muted-50 min-h-screen">
        <div class="absolute start-0 top-0 w-full">
            <div class="mx-auto w-full max-w-6xl px-4">
                <div class="flex w-full items-center justify-between py-5">
                    <div class="flex flex-1 items-center">
                        <a href="/trang-chu#!back" class="flex items-center gap-2">
                            <img src="/<?=__IMG__?>/icon/front-pages/deposit.png" alt="<?=$TD->Setting('name-site')?>"
                                class="object-contain h-12 mx-auto">
                        </a>
                    </div>
                    <div class="grow">
                        <div class="flex w-full items-center justify-center">
                            <p
                                class="nui-paragraph nui-paragraph-md nui-weight-medium nui-lead-normal text-muted-700 dark:text-muted-200">
                                Nạp Tiền Vào Tài Khoản
                            </p>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-end">
                            <a href="/trang-chu#!back" class="group text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img"
                                    class="icon text-muted-800 dark:text-muted-500 dark:group-hover:text-muted-200 size-8 transition-colors duration-300"
                                    width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"></path>
                                </svg>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400 dark:text-muted-400 dark:group-hover:text-muted-200 block transition-colors duration-300">
                                    Đóng
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full pb-20 pt-32">
            <div class="mx-auto w-full max-w-6xl px-4">
                <div class="grid w-full gap-10 md:grid-cols-12">
                    <div class="md:col-span-3 lg:col-span-4">
                        <div class="xs:w-full xs:max-w-xs xs:mx-auto flex flex-col gap-4 md:flex-row">
                            <div class="xs:max-w-xs xs:mx-auto relative flex justify-between gap-7 md:flex-col">
                                <div
                                    class="xs:top-1.5 xs:inset-x-0 bg-muted-200 dark:bg-muted-700 absolute start-2 top-2 z-0 mx-auto h-1 w-[calc(100%_-_1rem)] md:h-[calc(100%_-_1rem)] md:w-1 md:-translate-x-1/2">
                                </div>
                                <div class="bg-primary-500 absolute start-2 top-0 z-10 mx-auto hidden w-0.5 -translate-x-1/2 rounded-full transition-all duration-300 md:block"
                                    style="height: <?=(parse_url($current_url, PHP_URL_PATH) === '/nap-tien/'.$taikhoan.'/send') ? '50.33%' : '100%'; ?>">
                                </div>
                                <div
                                    class="bg-muted-200 dark:bg-muted-700 relative z-20 flex size-4 items-center justify-center rounded-full">
                                    <span
                                        class="scale-1 bg-primary-500 block size-2 rounded-full transition-transform duration-300"></span>
                                </div>
                                <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/nap-tien/'.$taikhoan.'/send'): ?>
                                <div
                                    class="bg-muted-200 dark:bg-muted-700 relative z-20 flex size-4 items-center justify-center rounded-full">
                                    <span
                                        class="bg-primary-500 block size-2 rounded-full transition-transform duration-300 scale-0"></span>
                                </div>
                                <?php else:?>
                                <div
                                    class="bg-muted-200 dark:bg-muted-700 relative z-20 flex size-4 items-center justify-center rounded-full">
                                    <span
                                        class="bg-primary-500 block size-2 rounded-full transition-transform duration-300 scale-1"></span>
                                </div>
                                <?php endif;?>
                            </div>
                            <div class="relative flex justify-center gap-7 md:flex-col md:justify-between">
                                <a role="button" tabindex="0" class="h-4 leading-none xs:hidden cursor-default">
                                    <span class="text-muted-400 dark:text-muted-500 font-heading block text-xs">Tạo Đơn
                                        Nạp Tiền</span>
                                </a>
                                <a role="button" tabindex="0" class="h-4 leading-none xs:hidden cursor-default">
                                    <span class="text-muted-400 dark:text-muted-500 font-heading block text-xs">Chi Tiết
                                        Thanh Toán</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/nap-tien/'.$taikhoan.'/send'):unset($_SESSION["session_deposit"]);?>
                    <div class="md:col-span-9 lg:col-span-8">
                        <form class="user-deposit-step-send">
                            <div class="w-full">
                                <div class="mb-8 space-y-2">
                                    <h2
                                        class="nui-heading nui-heading-2xl nui-weight-medium nui-lead-normal md:!3xl text-muted-800 dark:text-white">
                                        Nhập số tiền cần nạp</h2>
                                    <p class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                       - Chúng tôi sẽ thường xuyên thay đổi ngân hàng nhận, vui lòng không lưu mã QR ( Nếu chuyển vào tài khoản cũ sẽ không thể xử lý ).</p>
                                    <p
                                        class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                        - Nạp tối thiểu <?=FormatNumber::TD($TD->Setting('min-nap'))?>đ, cố tình nạp dưới mức này sẽ không xử lý
                                    </p>
                                    <div class="w-full max-w-md">
                                        <div class="relative">
                                            <div class="nui-input-wrapper nui-input-default nui-input-md nui-has-icon">
                                                <div class="nui-input-outer">
                                                    <input type="hidden" name="action" value="user-deposit-step-send">
                                                    <input type="hidden" name="stk">
                                                    <input type="hidden" name="method">
                                                    <input type="hidden" name="holder">
                                                    <input type="text"
                                                        class="nui-input !ps-14 !py-2 !h-14 !text-4xl !leading-5 !border-t-0 !border-l-0 !border-r-0 !border-b-2 focus:!border-primary-500 dark:!bg-muted-900 dark:focus:!border-primary-500 number-deposit"
                                                        placeholder="10.000" name="amount" value="100.000" required>
                                                    <div class="nui-input-icon !h-14 !w-14">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            aria-hidden="true" role="img"
                                                            class="icon nui-input-icon-inner" width="1em" height="1em"
                                                            viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 2v20m5-17H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="py-10">
                                            <h4 class="font-heading text-muted-600 dark:text-muted-400 mb-4 text-sm">
                                                Chuyển
                                                đến: </h4>
                                            <div class="nui-dropdown">
                                                <div class="nui-menu w-full [&>div]:right-0">
                                                    <button type="button"
                                                        class="nui-button nui-button-xl nui-button-rounded-lg nui-button-solid nui-button-default !h-auto w-full !p-4"
                                                        id="open-method-transfer" aria-haspopup="menu"
                                                        aria-expanded="false">
                                                        <span class="flex w-full items-center gap-3 text-start">
                                                            <svg id="icon-method-transfer"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                aria-hidden="true" role="img"
                                                                class="icon text-muted-500 mx-1 my-2 size-6" width="1em"
                                                                height="1em" viewBox="0 0 24 24">
                                                                <g fill="none" stroke="currentColor"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2">
                                                                    <path
                                                                        d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1">
                                                                    </path>
                                                                    <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                            <span id="container-transfer"> Chọn Ngân Hàng Chuyển
                                                                Khoản</span>
                                                            <i
                                                                class="ri-arrow-down-s-line icon icon-rotate text-muted-400 ms-auto transition-transform duration-300"></i>
                                                        </span>
                                                    </button>
                                                    <div id="method-transfer">
                                                        <div role="menu" tabindex="0"
                                                            class="nui-dropdown-menu nui-menu-md nui-menu-rounded-lg nui-menu-default !w-full">
                                                            <?php 
                                                         $wt = $thanhdieudb->query("SELECT * FROM ws_transfer");
                                                         if ($wt->num_rows > 0) 
                                                         {
                                                         while ($transfer = $wt->fetch_assoc()) { $kieubank = $transfer['kieubank'] ==='thucong' ? 'Nạp Thủ Công' : 'Nạp Tự Động (Ưu Tiên)';?>
                                                            <div class="nui-menu-content" role="none">
                                                                <div id="method-<?=$transfer['nganhang']?>"
                                                                    role="menuitem" tabindex="-1">
                                                                    <button type="button"
                                                                        class="nui-dropdown-item nui-item-rounded-sm nui-item-default nui-item-primary">
                                                                        <img src="/<?=__IMG__?>/icon/bank/<?=strtolower($transfer['nganhang'])?>.png"
                                                                            width="30" alt="<?=$transfer['nganhang']?>">
                                                                        <div class="nui-item-content">
                                                                            <p
                                                                                class="text-muted-400 font-sans text-xs text-muted-400  font-semibold text-xs dark:text-white">
                                                                                <?=$transfer['chutaikhoan']?>
                                                                            </p>
                                                                            <div
                                                                                class="font-heading text-muted-400 text-xs font-sans leading-tight">
                                                                                <?=$transfer['stk']?> |
                                                                                <?=$transfer['nganhang']?> |
                                                                                <?=$kieubank?>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <?php } 
                                                      } ?>
                                                        </div>
                                                    </div>
                                                    <!---->
                                                </div>
                                                
                                            </div>
                                            <p
                                        class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm"></br>
                                        <b>Lưu ý:</b> Thời gian xử lý 5p-1h. Chúng tôi luôn đặt an toàn và bảo mật thông tin cho khách hàng lên đầu, vui lòng liên hệ CSKH nếu số dư vẫn chưa được cộng sau thời gian này.
                                    </p>
                                        </div>
                                        <div class="flex gap-4">
                                            <a href="javascript:;" onclick="history.go(-1)"
                                                class="nui-button nui-button-lg nui-button-rounded-sm nui-button-solid nui-button-default w-full"
                                                disabled="false">
                                                <span><i class="ri-arrow-left-s-line"></i> Quay lại</span>
                                            </a>
                                            <button type="submit"
                                                class="nui-button nui-button-lg nui-button-rounded-sm nui-button-solid nui-button-primary w-full">
                                                <span>Tiếp Tục <i class="ri-arrow-right-s-line"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <?php elseif (parse_url($current_url, PHP_URL_PATH)==='/nap-tien/'.$taikhoan.'/transfer'):?>
                    <?php 
                    $deposit = new Deposit($TD);
                    $transferData = $deposit->validate($taikhoan);
                    if ($transferData==true){?>
                    <div class="md:col-span-9 lg:col-span-8" id="lavender-transfer">
                        <form class="user-deposit-step-transfer">
                            <div class="w-full">
                                <div>
                                    <div class="mb-2 space-y-2">
                                        <h2
                                            class="nui-heading nui-heading-2xl nui-weight-medium nui-lead-normal md:!3xl text-muted-800 dark:text-white">
                                            Thông tin nạp tiền</h2>
                                        <div class="w-full max-w-md hidden md:block" style="margin-left:-14px;">
                                            <div class="flex w-full flex-col">
                                                <button type="button"
                                                    class="naptien-ask border-muted-200 dark:border-muted-900 hover:bg-muted-100 dark:hover:bg-muted-800 flex w-full cursor-pointer items-center justify-between border-y p-4 transition-colors duration-300">
                                                    <span
                                                        class="nui-text nui-content-xs nui-weight-medium nui-lead-normal text-muted-500 dark:text-muted-400 uppercase">
                                                        Làm Thế Nào Để Nạp Tiền Vào Tài Khoản? </span>
                                                    <i
                                                        class="ri-arrow-down-s-line icon text-muted-400 fs-19px transition-transform duration-300"></i>
                                                </button>
                                                <div class="w-full p-4 hidden naptien-reply">
                                                    <div class="space-y-6">
                                                        <div>
                                                            <h5
                                                                class="nui-heading nui-heading-sm nui-weight-semibold nui-lead-normal text-muted-800 mb-4 dark:text-white">
                                                                Trả Lời </h5>
                                                            <div class="font-heading w-full space-y-3 text-sm">
                                                                <p
                                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                                    - Để nạp tiền vào tài khoản, quý khách vui lòng
                                                                    chuyển khoản cho chúng tôi
                                                                    theo thông tin bên dưới.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--#-->
                                            <div class="flex w-full flex-col">
                                                <button type="button"
                                                    class="naptien-ask border-muted-200 dark:border-muted-900 hover:bg-muted-100 dark:hover:bg-muted-800 flex w-full cursor-pointer items-center justify-between border-y p-4 transition-colors duration-300">
                                                    <span
                                                        class="nui-text nui-content-xs nui-weight-medium nui-lead-normal text-muted-500 dark:text-muted-400 uppercase">
                                                        Thời Gian Xử Lý Nạp Tiền Trong Bao Lâu? </span>
                                                    <i
                                                        class="ri-arrow-down-s-line icon text-muted-400 fs-19px transition-transform duration-300"></i>
                                                </button>
                                                <div class="w-full p-4 hidden naptien-reply">
                                                    <div class="space-y-6">
                                                        <div>
                                                            <h5
                                                                class="nui-heading nui-heading-sm nui-weight-semibold nui-lead-normal text-muted-800 mb-4 dark:text-white">
                                                                Trả Lời </h5>
                                                            <div class="font-heading w-full space-y-3 text-sm">
                                                                <p
                                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                                    - Nạp tự động 30s-1 phút nếu bạn chọn nạp qua <font
                                                                        color="red">thủ
                                                                        công</font> thì thời gian sẽ có
                                                                    thể lâu hơn dự kiến.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--#-->
                                            <div class="flex w-full flex-col">
                                                <button type="button"
                                                    class="naptien-ask border-muted-200 dark:border-muted-900 hover:bg-muted-100 dark:hover:bg-muted-800 flex w-full cursor-pointer items-center justify-between border-y p-4 transition-colors duration-300">
                                                    <span
                                                        class="nui-text nui-content-xs nui-weight-medium nui-lead-normal text-muted-500 dark:text-muted-400 uppercase">
                                                        Tôi Chuyển Tiền Rồi Mà Tiền Vẫn Chưa Vào? </span>
                                                    <i
                                                        class="ri-arrow-down-s-line icon text-muted-400 fs-19px transition-transform duration-300"></i>
                                                </button>
                                                <div class="w-full p-4 hidden naptien-reply">
                                                    <div class="space-y-6">
                                                        <div>
                                                            <h5
                                                                class="nui-heading nui-heading-sm nui-weight-semibold nui-lead-normal text-muted-800 mb-4 dark:text-white">
                                                                Trả Lời </h5>
                                                            <div class="font-heading w-full space-y-3 text-sm">
                                                                <p
                                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                                    - Nếu quá <font color="#14ff53">10 phút</font> đã
                                                                    chuyển tiền rồi mà tiền vẫn
                                                                    không vào tài khoản thì hãy chủ
                                                                    động liên hệ cho admin và kèm theo bill bằng chứng.
                                                                </p>
                                                                <p
                                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                                    - Hãy kiểm tra xem bạn đã chuyển khoản và kèm theo
                                                                    nội dung nạp chưa, nếu chưa buộc bạn phải liên hệ
                                                                    cho admin và gửi bill kèm nội dung nạp, chúng tôi sẽ
                                                                    trừ <font color="red">20% phí phạt.</font>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--#-->
                                        <div class="w-full max-w-md sm:hidden py-4">
                                            <div class="font-heading w-full space-y-3 text-sm">
                                                <p
                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                    - Để nạp tiền vào tài khoản, quý khách vui lòng
                                                    chuyển khoản cho chúng tôi
                                                    theo thông tin bên dưới.</p>
                                                <p
                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                    - Nạp tự động 30s-1 phút nếu bạn chọn nạp qua <font color="red">thủ
                                                        công</font> thì thời gian sẽ có
                                                    thể lâu hơn dự kiến.
                                                </p>
                                                <p
                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                    - Nếu quá <font color="#14ff53">10 phút</font> đã chuyển tiền rồi mà
                                                    tiền vẫn
                                                    không vào tài khoản thì hãy chủ
                                                    động liên hệ cho admin và kèm theo bill bằng chứng.
                                                </p>
                                                <p
                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-sm">
                                                    - Hãy kiểm tra xem bạn đã chuyển khoản và kèm theo
                                                    nội dung nạp chưa, nếu chưa buộc bạn phải liên hệ
                                                    cho admin và gửi bill kèm nội dung nạp, chúng tôi sẽ
                                                    trừ <font color="red">20% phí phạt.</font>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full max-w-md space-y-6">
                                    <div class="flex items-end justify-between pb-4">
                                        <div class="flex-1">
                                            <p
                                                class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-400 mb-1">
                                                Số tiền cần nạp </p>
                                            <h3
                                                class="nui-heading nui-heading-3xl nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100">
                                                <?=FormatNumber::TD($transferData->sotien)?>đ</h3>
                                        </div>
                                        <div class="flex-1 text-end">
                                            <p
                                                class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-400 mb-1">
                                                Mã đơn nạp </p>
                                            <h3
                                                class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100 flex h-10 items-center justify-end">
                                                <span>#<?=$user['user_id']?>-<?=$transferData->madonnap?></span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-heading text-muted-400 mb-1 text-xs"> Quét mã nhanh </p>
                                        <div class="flex w-full gap-6 py-2 call-demo">
                                            <p class="select-none pointer-events-none">
                                                <img src="/<?=__IMG__?>/main/loading.gif" data-src="<?php if ($transferData->nganhang == 'Momo'): ?>
                                                        https://api.viqr.net/Momo/?sdt=<?=$transferData->stk?>&name=<?=$transferData->chutaikhoan?>&mm=<?=$transferData->sotien?>&banks=MoMo
                                                        <?php else: ?>
                                                        https://api.vietqr.io/<?=$transferData->nganhang?>/<?=$transferData->stk?>/<?=$transferData->sotien?>/<?=isset($user['user_id']) ?$TD->Setting('cuphap-naptien').$user['user_id'] : 'Bạn chưa đăng nhập'?>/vietqr_net_2.jpg?accountName=<?=$transferData->chutaikhoan?>
                                              <?php endif; ?>" alt="QR Code <?=$transferData->nganhang?>"
                                                    class="lazyload qr-code-fix">
                                            </p>
                                            <div class="fs-13px">
                                                <span class="me-1">-
                                                    Quý khách nạp tiền chú ý nhớ ghi nội dung:</span>
                                                <b class="cursor-pointer"
                                                    data-ws-copy="<?=isset($user['user_id']) ?$TD->Setting('cuphap-naptien').$user['user_id'] : 'Bạn chưa đăng nhập'?>"><?=isset($user['user_id']) ?$TD->Setting('cuphap-naptien').$user['user_id'] : 'Bạn chưa đăng nhập'?>&nbsp;<i
                                                        class="ri-file-copy-line text-muted-400"></i></b>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-heading text-muted-400 mb-1 text-xs"> Thông tin người nhận
                                        </p>
                                        <div
                                            class="dark:bg-muted-800 border-muted-200 dark:border-muted-700 w-full rounded-xl border bg-white p-4">
                                            <div class="flex w-full items-center gap-3 text-start">
                                                <img src="/<?=__IMG__?>/icon/bank/<?=strtolower($transferData->nganhang)?>.png"
                                                    width="40" alt="<?=$transferData->nganhang?>">
                                                <div>
                                                    <span data-ws-copy="<?=$transferData->chutaikhoan?>"
                                                        class="nui-text nui-content-sm nui-weight-normal nui-lead-normal text-muted-800 dark:text-muted-200 block capitalize"><?=$transferData->chutaikhoan?>
                                                        <i
                                                            class="ri-file-copy-line text-muted-500 cursor-pointer"></i></span>
                                                    <span data-ws-copy="<?=$transferData->stk?>"
                                                        class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 block">
                                                        <?=$transferData->stk?> <i
                                                            class="ri-file-copy-line text-muted-500 cursor-pointer"></i></span>
                                                </div>
                                                <div class="ms-auto pe-4">
                                                    <span
                                                        class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-800 dark:text-muted-200 block">
                                                        Ngân Hàng </span>
                                                    <span
                                                        class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 block"><?=$transferData->nganhang?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <a href="javascript:;" data-target-href="/nap-tien/<?=$taikhoan?>/send"
                                            class="nui-button nui-button-lg nui-button-rounded-sm nui-button-solid nui-button-default w-full"
                                            disabled="false">
                                            <span><i class="ri-arrow-left-s-line me-1"></i>Quay lại</span>
                                        </a>
                                        <button type="button" disabled
                                            class="nui-button nui-button-lg nui-button-rounded-sm nui-button-solid nui-button-primary w-full text-nowrap"
                                            id="status-deposit">
                                            <i class="ri-loader-4-line me-1 wt-spinner"></i>Chờ thanh toán
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <?php 
                    } else 
                    {
                        $deposit->redirect();
                    } 
                    ?>
                <?php else:die('<meta http-equiv="refresh" content="0;url=/nap-tien/'.$taikhoan.'/send">');endif;?>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>