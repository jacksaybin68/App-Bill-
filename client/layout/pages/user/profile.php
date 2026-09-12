<?php $options_header = ['title' => 'Thông Tin Tài Khoản']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php if(!$isLogin->check()&&basename(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH))!==$taikhoan){header("Location: /oauth/dang-nhap");exit();}?>
<div class="dark:bg-muted-900 min-h-screen bg-white">
    <div class="absolute start-0 top-0 w-full">
        <div class="mx-auto w-full max-w-6xl px-4">
            <div class="flex w-full items-center justify-between py-5">
                <div class="flex flex-1 items-center">
                    <a href="/trang-chu#!back-to-home" class="flex items-center gap-2">
                        <img src="/<?=__IMG__?>/icon/front-pages/settings.png"
                            alt="<?=$TD->Setting('name-site')?>" class="object-contain h-8 mx-auto">
                    </a>
                </div>
                <div class="grow">
                    <div class="flex w-full items-center justify-center">
                        <p
                            class="nui-paragraph nui-paragraph-md nui-weight-medium nui-lead-normal text-muted-700 dark:text-muted-200">
                            Cài Đặt Thông Tin</p>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-end">
                        <a href="/trang-chu#!back-to-home" class="group text-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                class="icon text-muted-800 dark:text-muted-500 dark:group-hover:text-muted-200 size-8 transition-colors duration-300"
                                width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M18 6L6 18M6 6l12 12"></path>
                            </svg> <span
                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400 dark:text-muted-400 dark:group-hover:text-muted-200 block transition-colors duration-300">Thoát</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full pb-20 pt-32">
        <div class="mx-auto w-full max-w-6xl px-4">
            <div class="grid w-full gap-8-none md:grid-cols-12 md:gap-16">
                <div class="md:col-span-3 lg:col-span-3">
                    <div class="border-muted-200 dark:border-muted-800 h-full border-r">
                        <ul class="xs:flex xs:gap-4 -me-0.5 font-sans text-nowrap">
                            <li>
                                <a href="#info"
                                    class="router-link-active router-link-exact-active font-heading xs:border-b-[3px] flex w-full cursor-pointer py-2 text-sm md:border-r-[3px] text-muted-800 dark:text-muted-100 border-primary-500"
                                    data-tab-setting="tab-info"> Thông Tin Chung </a>
                            </li>
                            <li>
                                <a href="#security"
                                    class="font-heading xs:border-b-[3px] flex w-full cursor-pointer py-2 text-sm md:border-r-[3px] text-muted-500 dark:text-muted-400 border-transparent"
                                    data-tab-setting="tab-security"> Bảo Mật</a>
                            </li>
                            <li>
                                <a href="#log"
                                    class="font-heading xs:border-b-[3px] flex w-full cursor-pointer py-2 text-sm md:border-r-[3px] text-muted-500 dark:text-muted-400 border-transparent"
                                    data-tab-setting="tab-log"> Lịch Sử Hoạt Động</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:col-span-9 lg:col-span-9" id="tab-info">
                    <div class="divide-muted-200 dark:divide-muted-800 space-y-20 py-6">
                        <div class="grid gap-8 md:grid-cols-12">
                            <div class="md:col-span-4">
                                <h3
                                    class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100 mb-1">
                                    Thông Tin Cá Nhân </h3>
                                <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    Một số thông tin cơ bản mà bạn đã cung cấp cho chúng tôi thông qua việc đăng ký trên
                                    nền tảng.</p>
                            </div>
                            <div class="md:col-span-8">
                                <h3
                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal border-muted-200 dark:border-muted-800 text-muted-800 dark:text-muted-100 border-b px-4 pb-4">
                                    Thông tin của bạn</h3>
                                <div class="divide-muted-200 dark:divide-muted-800 flex flex-col divide-y">
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                    Địa chỉ E-mail </h3>
                                                <span
                                                    class="nui-text nui-content-sm nui-weight-normal nui-lead-normal"><?=valid_email($user['email']) ? $user['email'] : 'Chưa xác minh email'?></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                    Tên Đăng Nhập </h3>
                                                <span
                                                    class="nui-text nui-content-sm nui-weight-normal nui-lead-normal"><?=$user['username']?></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                   Địa Chỉ IP </h3>
                                                <span
                                                    class="nui-text nui-content-sm nui-weight-normal nui-lead-normal"><?=$user['ip']?></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                    Ngày Tham Gia </h3>
                                                <span
                                                    class="nui-text nui-content-sm nui-weight-normal nui-lead-normal"><?=FormatTime::TD($user['ngaythamgia'], 1)?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-8 md:grid-cols-12">
                            <div class="md:col-span-4">
                                <h3
                                    class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100 mb-1">
                                    Thông Tin Ví </h3>
                                <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    Một số thông tin quan trọng về số dư của bạn trong việc sử dụng dịch vụ có trên nền
                                    tảng.</p>
                            </div>
                            <div class="md:col-span-8">
                                <h3
                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal border-muted-200 dark:border-muted-800 text-muted-800 dark:text-muted-100 border-b px-4 pb-4">
                                    Thông Tin Quỹ </h3>
                                <div class="divide-muted-200 dark:divide-muted-800 flex flex-col divide-y">
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                    Số Dư Còn Lại</h3>
                                                <span
                                                    class="nui-text nui-content-sm nui-weight-normal nui-lead-normal"><?=FormatNumber::TD($user['sodu'])?>đ</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                    Tổng Tiền Đã Tiêu</h3>
                                                <span
                                                    class="nui-text nui-content-sm nui-weight-normal nui-lead-normal"><?=FormatNumber::TD($user['tongtieu'])?>đ</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                    Tổng Tiền Đã Nạp</h3>
                                                <p
                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal">
                                                    <?= FormatNumber::TD($user['tongnap']) ?>đ</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                    Hoa Hồng Khả Dụng</h3>
                                                <p
                                                    class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal">
                                                    <?= FormatNumber::TD($user['hoahong']) ?>đ</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-9 lg:col-span-9" id="tab-security">
                    <div class="divide-muted-200 dark:divide-muted-800 space-y-20 py-6">
                        <div class="grid gap-8 md:grid-cols-12">
                            <div class="md:col-span-4">
                                <h3
                                    class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100 mb-1">
                                    Cài Đặt Bảo Mật</h3>
                                <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    Đặt mật khẩu duy nhất để bảo vệ tài khoản của bạn. Đừng quên thay đổi mật khẩu theo
                                    định kỳ.</p>
                            </div>
                            <div class="md:col-span-8">
                                <h3
                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal border-muted-200 dark:border-muted-800 text-muted-800 dark:text-muted-100 border-b px-4 pb-4">
                                    Thông tin tài khoản </h3>
                                <div class="divide-muted-200 dark:divide-muted-800 flex flex-col divide-y">
                                    <div class="group">
                                        <a href="javascript:;" target-modal="#change-pw"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3 class="font-heading text-muted-400 text-xs">Mật Khẩu</h3>
                                                <span>Thay đổi mật khẩu</span>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon ms-auto size-4" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 20h9M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z">
                                                </path>
                                            </svg>
                                            <span
                                                class="nui-text nui-content-xs nui-weight-semibold nui-lead-normal text-primary-500 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                                Thay đổi </span>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3 class="font-heading text-muted-400 text-xs"> API Tokens </h3>
                                                <span id="api-key"
                                                    data-ws-copy="<?=$user['access_key'] ?? 'WusThanhDieu'?>"><?=$user['access_key']?></span>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon ms-auto size-4 change-apikey" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 20h9M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z">
                                                </path>
                                            </svg>
                                            <span
                                                class="nui-text nui-content-xs nui-weight-semibold nui-lead-normal text-primary-500 opacity-0 transition-opacity duration-300 group-hover:opacity-100 change-apikey text-nowrap">
                                                Thay đổi </span>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="javascript:;"
                                            class="font-heading text-muted-600 dark:text-muted-400 hover:bg-muted-50 dark:hover:bg-muted-800 flex items-center gap-4 p-4 text-sm transition-colors duration-300">
                                            <div>
                                                <h3
                                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400">
                                                   Thiết Bị </h3>
                                                <span
                                                    class="nui-text nui-content-sm nui-weight-normal nui-lead-normal"><?=isset($_COOKIE['_window'])&&$_COOKIE['_window']==11?'Window 11':$device_info->name?> / <?=$browser_info->name?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-8 md:grid-cols-12">
                            <div class="md:col-span-4">
                                <h3
                                    class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100 mb-1">
                                    Xác Minh E-mail </h3>
                                <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    Để tiếp tục sử dụng dịch vụ trên nền tảng, vui lòng xác thực địa chỉ email của bạn.
                                </p>
                            </div>
                            <div class="md:col-span-8 select-none">
                                <div class="px-8 py-12 text-center bg-muted-200 dark:bg-muted-800 rounded-lg">
                                    <div class="mx-auto w-full max-w-lg">
                                        <h3 class="font-heading text-muted-800 mb-2 text-lg dark:text-white">Xác Minh
                                            Địa Chỉ Email</h3>
                                        <p class="text-muted-500 font-sans">Hãy cho chúng tôi biết địa chỉ email thật
                                            của bạn, và chúng tôi sẽ giúp bạn xác minh nó vào tài khoản của bạn bằng
                                            cách bạn nhấn vào nút Xác Minh</p>
                                    </div>
                                    <div class="mt-3 flex justify-center">
                                        <button type="button" onclick="FuiToast.info('Not available yet :(')"
                                            class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-primary w-40">
                                            Xác Minh
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-9 lg:col-span-9 w-full overflow-auto" id="tab-log">
                    <div class="divide-muted-200 dark:divide-muted-800 space-y-20 py-6">
                        <div
                            class="w-full overflow-x-auto rounded-lg border border-muted-200 bg-transparent dark:border-muted-900">
                            <p class="max-w-xl font-sans text-sm text-muted-500 dark:text-muted-400">😄 Chúng tôi sẽ
                                hiển thị tối đa <b>200</b> lịch sử hoạt động gần nhất của bạn.</p>
                                <div class="max-log-wrapper max-h-80 overflow-y-auto">
                            <table class="w-full overflow-auto">
                                <?php
                                  /**
                                    * @author Vương Thanh Diệu
                                   */
                                     class ListDiary extends DatabaseConnection 
                                     {
                                        public function Show() {
                                        global $taikhoan;
                                        $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT * FROM ws_logs WHERE username='$taikhoan' ORDER BY time DESC LIMIT 200");
                                if ($oOo) {
                                 $count = mysqli_num_rows($oOo);?>
                                <thead>
                                    <tr class="bg-muted-50 dark:bg-muted-900 text-nowrap">
                                        <th
                                            class="bg-transparent py-4 px-3 text-start font-sans text-xs font-medium uppercase text-muted-400 tracking-wide">
                                            # STT</th>
                                        <th
                                            class="bg-transparent py-4 px-3 text-start font-sans text-xs font-medium uppercase text-muted-400 tracking-wide">
                                            Nhật Ký</th>
                                        <th
                                            class="bg-transparent py-4 px-3 text-start font-sans text-xs font-medium uppercase text-muted-400 tracking-wide">
                                            Thời Gian</th>
                                        <th
                                            class="bg-transparent py-4 px-3 text-start font-sans text-xs font-medium uppercase text-muted-400 tracking-wide">
                                            Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $stt = $count;
                                        while ($log = mysqli_fetch_assoc($oOo)) { ?>
                                    <tr>
                                        <td class="border-t border-muted-200 py-4 px-3 font-sans font-normal dark:border-muted-800"
                                            valign="middle">
                                            <div class="flex items-center gap-2">
                                                <p class="text-sm text-muted-800 dark:text-muted-100"><?= $stt-- ?></p>
                                            </div>
                                        </td>
                                        <td class="border-t border-muted-200 py-4 px-3 font-sans font-normal dark:border-muted-800 text-nowrap"
                                            valign="middle">
                                            <p class="line-clamp-2 text-sm text-muted-500 dark:text-muted-400">Bạn
                                                <?=$log['content']?></p>
                                        </td>
                                        <td class="border-t border-muted-200 text-sm py-4 px-3 font-sans font-normal dark:border-muted-800 text-nowrap"
                                            valign="middle">
                                            <span><?=FormatTime::TD($log['time'],1)?></span>
                                        </td>
                                        <td class="border-t border-muted-200 text-sm py-4 px-3 font-sans font-normal dark:border-muted-800 text-nowrap"
                                            valign="middle">
                                            <?=$log['action']?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <?php 
                              } else { 
                               ?>
                                <tr>
                                    <td colspan="4">Chưa có dữ liệu.</td>
                                </tr>
                                <?php }
                                }
                                }
                             (new ListDiary())->Show();
                                   ?>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center modal z-[200] hidden select-none"
        id="change-pw">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div
                class="dark:bg-muted-800 w-full bg-white text-left align-middle shadow-xl transition-all rounded-md max-w-xl z-[9999]">
                <div class="flex w-full items-center justify-between p-4">
                    <h3 class="text-gray-900 text-lg font-medium"><i class="ri-lock-star-line"></i> Thay Đổi Mật Khẩu
                    </h3>
                    <button type="button"
                        class="nui-button-close nui-button-sm nui-button-rounded-full nui-button-default close-modal">
                        <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-button-icon">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="w-full items-center gap-x-2 justify-top">
                    <div class="p-4">
                        <form class="user-change-password space-y-2">
                            <div
                                class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                <label class="nui-input-label nui-input-eye" for="password-old">Nhập Mật Khẩu Cũ</label>
                                <div class="nui-input-outer">
                                    <div>
                                        <input type="password" class="nui-input h-12 !ps-12 is-pw"
                                            placeholder="••••••••••" name="password-old" required>
                                        <div class="h-12 w-12 nui-input-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon nui-input-icon-inner" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2">
                                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <button
                                            class="wt-pw-eye leading-0 text-muted-400 peer-focus-within:text-primary-500 nui-focus absolute right-0 top-0 flex size-10 items-center justify-center text-center text-xl disabled:cursor-not-allowed"
                                            type="button" tabindex="0" data-nui-tooltip="Hiện mật khẩu">
                                            <div class="relative flex size-full items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="icon size-5" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13">
                                                    </path>
                                                </svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <div class="group/password-strength relative">
                                    <div
                                        class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                        <label class="nui-input-label nui-input-eye" for="password-new">Nhập Mật
                                            Khẩu Mới</label>
                                        <div class="nui-input-outer">
                                            <div>
                                                <input type="password" class="nui-input h-12 !ps-12 is-pw"
                                                    placeholder="••••••••••" name="password-new" required>
                                                <div class="h-12 w-12 nui-input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                        role="img" class="icon nui-input-icon-inner" width="1em"
                                                        height="1em" viewBox="0 0 24 24">
                                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2">
                                                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2">
                                                            </rect>
                                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <button
                                                    class="wt-pw-eye leading-0 text-muted-400 peer-focus-within:text-primary-500 nui-focus absolute right-0 top-0 flex size-10 items-center justify-center text-center text-xl disabled:cursor-not-allowed"
                                                    type="button" tabindex="0" data-nui-tooltip="Hiện mật khẩu">
                                                    <div class="relative flex size-full items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            aria-hidden="true" role="img" class="icon size-5"
                                                            width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="border-muted-200 dark:border-muted-700 shadow-muted-300/30 dark:shadow-muted-800/20 dark:bg-muted-800 pointer-events-none absolute -bottom-1 start-0 z-20 translate-y-full rounded-lg border bg-white p-6 opacity-0 shadow-xl transition-opacity duration-300 group-focus-within/password-strength:pointer-events-auto group-focus-within/password-strength:opacity-100">
                                        <ul class="flex flex-col gap-4">
                                            <!---->
                                            <li class="flex items-center justify-between gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img"
                                                    class="icon text-muted-400 dark:text-muted-500 size-4 shrink-0"
                                                    width="1em" height="1em" viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3m.08 4h.01"></path>
                                                    </g>
                                                </svg>
                                                <span
                                                    class="grow text-xs dark:text-slate-400 dark:text-slate-350 font-semibold">Tối
                                                    thiểu 6 ký tự, càng nhiều càng tốt.</span>
                                            </li>
                                            <li class="flex items-center justify-between gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img"
                                                    class="icon text-muted-400 dark:text-muted-500 size-4 shrink-0"
                                                    width="1em" height="1em" viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3m.08 4h.01"></path>
                                                    </g>
                                                </svg>
                                                <span
                                                    class="grow text-xs dark:text-slate-400 dark:text-slate-350 font-semibold">Hãy
                                                    sử dụng mật khẩu có chữ cái và kèm theo số (hoặc chữ in hoa).</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label nui-input-eye" for="password-new-again">Nhập Lại Mật
                                        Khẩu Mới</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="password" class="nui-input h-12 !ps-12 is-pw"
                                                placeholder="••••••••••" name="password-new-again" required>
                                            <div class="h-12 w-12 nui-input-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="icon nui-input-icon-inner" width="1em"
                                                    height="1em" viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2">
                                                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <input type="hidden" name="auth" value="user-change-password">
                                            <button
                                                class="wt-pw-eye leading-0 text-muted-400 peer-focus-within:text-primary-500 nui-focus absolute right-0 top-0 flex size-10 items-center justify-center text-center text-xl disabled:cursor-not-allowed"
                                                type="button" tabindex="0" data-nui-tooltip="Hiện mật khẩu">
                                                <div class="relative flex size-full items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                        role="img" class="icon size-5" width="1em" height="1em"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="flex w-full items-center gap-x-2 justify-end">
                        <div class="p-4 md:p-6">
                            <div class="flex gap-x-2">
                                <button type="submit"
                                    class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-primary"><i
                                        class="ri-check-line me-2"></i>Đổi Mật Khẩu</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>