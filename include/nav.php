<div
    class="shadow-lg border-none wt-sidebar dark:bg-muted-800 border-muted-200 dark:border-muted-700 fixed start-0 top-0 z-[60] flex h-full flex-col border-r bg-white transition-all duration-300 w-[280px] -translate-x-full lg:translate-x-0">
    <div class="flex h-16 w-full items-center justify-between px-6">
        <div class="flex items-center justify-center w-full mt-4 navbar-brand hk-bg-animate">
            <a href="/trang-chu" class="flex items-center justify-center">
                <img src="<?=$TD->Setting('navbar-logo')?>" alt="<?=$TD->Setting('name-site')?>"
                    class="object-contain h-13 mx-auto">
            </a>
        </div>
        <button type="button"
            class="layout-nav-close nui-mask nui-mask-blob hover:bg-muted-200 dark:hover:bg-muted-800 text-muted-700 dark:text-muted-400 flex cursor-pointer items-center justify-center transition-colors duration-300 lg:hidden">
            <i class="ri-close-fill"></i>
        </button>
    </div>
    <div class="relative flex w-full grow flex-col py-6 px-5 nui-slimscroll overflow-y-auto">
        <ul class="space-y-2 wt-menu">
            <li>
                <div class="border-muted-200 dark:border-muted-700 my-3 h-px w-full border-t"></div>
            </li>
            <li>
                <a href="/trang-chu"
                    class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex cursor-pointer items-center gap-4 rounded-lg py-3 transition-colors duration-300 px-4">
                    <img src="/<?=__IMG__?>/icon/menu/home.png" width="21" alt="Icon Menu">
                    <span class="whitespace-nowrap font-sans text-sm block">Trang Chủ</span></a>
            </li>
            <li>
                <div class="group">
                    <button data-menu="sub-menu"
                        class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex w-full cursor-pointer items-center rounded-lg py-3 transition-colors duration-300 gap-4 px-4">
                        <img src="/<?=__IMG__?>/icon/menu/bank.png?v=1" width="19" alt="Icon Menu">
                        <span class="block whitespace-nowrap font-sans text-sm block">Tạo Bill Chuyển Khoản</span>
                        <span class="ms-auto items-center justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img"
                                class="icon size-4 transition-transform duration-200 rotate-180" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m18 15l-6-6l-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <ul data-menu="sub-menu"
                        class="border-muted-200 relative block ps-4 max-h-0 overflow-hidden opacity-0 transition-all duration-150">
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-bill-chuyen-khoan"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Bill Chuyển
                                    Tiền</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-bill-priority"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Bill Priority, Premium</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-so-du"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Bill Số Dư Tài Khoản</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-bdsd"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Bill Biến
                                    Động Số Dư</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-bill/man-hinh-khoa"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Bill Màn Hình Khóa</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-bill/binance"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Bill Tiền Điện Tử</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="group">
                    <button data-menu="sub-menu"
                        class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex w-full cursor-pointer items-center rounded-lg py-3 transition-colors duration-300 gap-4 px-4">
                        <img src="https://i.imgur.com/WRblEdE.png" width="20" alt="Icon Menu">
                        <span class="block whitespace-nowrap font-sans text-sm block">Mua, Thuê Bank</span>
                        <span class="ms-auto items-center justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img"
                                class="icon size-4 transition-transform duration-200 rotate-180" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m18 15l-6-6l-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <ul data-menu="sub-menu"
                        class="border-muted-200 relative block ps-4 max-h-0 overflow-hidden opacity-0 transition-all duration-150">
                        <!--<li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/thue-app-bank-ao"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Thiết Bị iPhone/Android</span>
                            </a>
                        </li>-->
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="#" onclick="swal('BILLVIET','Thuê bank ảo, mua bank quầy - online vui lòng liên hệ Telegram @BILLVIET88 để được hỗ trợ !','info')"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Android / IOS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="group">
                    <button data-menu="sub-menu"
                        class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex w-full cursor-pointer items-center rounded-lg py-3 transition-colors duration-300 gap-4 px-4">
                        <img src="/<?=__IMG__?>/icon/menu/card.png" width="20" alt="Icon Menu">
                        <span class="block whitespace-nowrap font-sans text-sm block">Tạo Giấy Tờ</span>
                        <span class="ms-auto items-center justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img"
                                class="icon size-4 transition-transform duration-200 rotate-180" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m18 15l-6-6l-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <ul data-menu="sub-menu"
                        class="border-muted-200 relative block ps-4 max-h-0 overflow-hidden opacity-0 transition-all duration-150">
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-cccd"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">CCCD 2 Mặt</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/tao-qr/cccd"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">QR CCCD Zalo</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-velenmaybay"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Vé Máy Bay Economy 1</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-velenmaybay3"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Vé Máy Bay Economy 2</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-velenmaybay2"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Vé Máy Bay Business</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-vedientu"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Vé Máy Bay Điện Tử</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
                        <li>
                <div class="group">
                    <button data-menu="sub-menu"
                        class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex w-full cursor-pointer items-center rounded-lg py-3 transition-colors duration-300 gap-4 px-4">
                        <img src="https://cdn-icons-png.freepik.com/256/17470/17470916.png?semt=ais_hybrid" width="20" alt="Icon Menu">
                        <span class="block whitespace-nowrap font-sans text-sm block">Dịch Vụ Khác</span>
                        <span class="ms-auto items-center justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img"
                                class="icon size-4 transition-transform duration-200 rotate-180" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m18 15l-6-6l-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <ul data-menu="sub-menu"
                        class="border-muted-200 relative block ps-4 max-h-0 overflow-hidden opacity-0 transition-all duration-150">
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="#" onclick="swal('BILLVIET','Liên hệ Telegram @BILLVIET88 để được hỗ trợ, xin cảm ơn !','info')"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Tổng Đài Ảo 02,09,1900</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="#" onclick="swal('BILLVIET','Liên hệ Telegram @BILLVIET88 để được hỗ trợ, xin cảm ơn !','info')"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Code App, Hậu Đài</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="#" onclick="swal('BILLVIET','Chúng tôi hỗ trợ quảng cáo treo Banner trên website, ghim nhóm vui lòng liên hệ Telegram @BILLVIET88 để được hỗ trợ, xin cảm ơn !','info')"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Treo Quảng Cáo</span>
                            </a>
                        </li>
                        <!--<li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/lich-su/mua-hang"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Lịch Sử Mua Hàng</span>
                            </a>
                        </li>-->
                    </ul>
                </div>
            </li>
            <!--<li>
                <div class="group">
                    <button data-menu="sub-menu"
                        class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex w-full cursor-pointer items-center rounded-lg py-3 transition-colors duration-300 gap-4 px-4">
                        <img src="//files.catbox.moe/bb87ml.png" width="20" alt="Icon Menu">
                        <span class="block whitespace-nowrap font-sans text-sm block">Hệ Thống Fake Vé</span>
                        <span class="ms-auto items-center justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img"
                                class="icon size-4 transition-transform duration-200 rotate-180" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m18 15l-6-6l-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <ul data-menu="sub-menu"
                        class="border-muted-200 relative block ps-4 max-h-0 overflow-hidden opacity-0 transition-all duration-150">
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-velenmaybay"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Fake Vé Máy Bay Loại 1</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-velenmaybay2"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Fake Vé Máy Bay Loại 2</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/fake-vedientu"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Fake Vé Điện Tử</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>-->
            <li>
                <div class="border-muted-200 dark:border-muted-700 my-3 h-px w-full border-t"></div>
            </li>
            <li>
                <a href="/thue-goi"
                    class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex cursor-pointer items-center gap-4 rounded-lg py-3 transition-colors duration-300 px-4">
                    <img src="/<?=__IMG__?>/icon/menu/shop.png" width="21" alt="Icon Menu">
                    <span class="whitespace-nowrap font-sans text-sm block">Thuê Gói VIP</span>
                </a>
            </li>
            <!--<li>
                <a href="/danh-muc/ma-nguon"
                    class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex cursor-pointer items-center gap-4 rounded-lg py-3 transition-colors duration-300 px-4">
                    <img src="/<?=__IMG__?>/icon/menu/shoping.png" width="21" alt="Icon Menu">
                    <span class="whitespace-nowrap font-sans text-sm block">Kho Mã Nguồn</span>
                </a>
            </li>-->
            <?php if($isLogin->check()):?>
            <?php if($plans->TD('tengoi', $taikhoan)):?>
            <li>
                <a href="/thong-tin-goi"
                    class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex cursor-pointer items-center gap-4 rounded-lg py-3 transition-colors duration-300 px-4">
                    <img src="/<?=__IMG__?>/icon/menu/user-plan.png" width="21" alt="Icon Menu">
                    <span class="whitespace-nowrap font-sans text-sm block">Thông Tin Gói</span>
                </a>
            </li>
            <?php endif?>
            <li>
                <div class="group">
                    <button data-menu="sub-menu"
                        class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex w-full cursor-pointer items-center rounded-lg py-3 transition-colors duration-300 gap-4 px-4">
                        <img src="/<?=__IMG__?>/icon/menu/deposit.png" width="20" alt="Icon Menu">
                        <span class="block whitespace-nowrap font-sans text-sm block">Nạp Tiền</span>
                        <span class="ms-auto items-center justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img"
                                class="icon size-4 transition-transform duration-200 rotate-180" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m18 15l-6-6l-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <ul data-menu="sub-menu"
                        class="border-muted-200 relative block ps-4 max-h-0 overflow-hidden opacity-0 transition-all duration-150">
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/nap-tien/<?=$user['username']?>/send"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Chuyển Khoản Nhanh</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="#" onclick="swal('BILLVIET','Tính năng đang được phát triển, vui lòng thử lại sau.','info')"
                                class="nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Tiền Mã Hóa</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="group">
                    <button data-menu="sub-menu"
                        class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex w-full cursor-pointer items-center rounded-lg py-3 transition-colors duration-300 gap-4 px-4">
                        <img src="/<?=__IMG__?>/icon/menu/htr-plan.png" width="20" alt="Icon Menu">
                        <span class="block whitespace-nowrap font-sans text-sm block">Lịch Sử Của Tôi</span>
                        <span class="ms-auto items-center justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img"
                                class="icon size-4 transition-transform duration-200 rotate-180" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m18 15l-6-6l-6 6"></path>
                            </svg>
                        </span>
                    </button>
                    <ul data-menu="sub-menu"
                        class="border-muted-200 relative block ps-4 max-h-0 overflow-hidden opacity-0 transition-all duration-150">
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/lich-su/nap-tien"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Lịch Sử Nạp Tiền</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/lich-su/mua-goi"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Lịch Sử Mua Gói</span>
                            </a>
                        </li>
                        <li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/lich-su/tao-bill"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Lịch Sử Tạo Bill</span>
                            </a>
                        </li>
                        <!--<li class="border-muted-300 dark:border-muted-700 ms-2 border-s-2 first:mt-2">
                            <a href="/lich-su/mua-hang"
                                class="router-link-active nui-focus text-muted-500 hover:text-muted-600 dark:text-muted-400/80 dark:hover:text-muted-200 relative -start-0.5 flex cursor-pointer items-center gap-2 border-s-2 border-transparent py-2 ps-4 transition-colors duration-300">
                                <i class="ri-git-commit-line"></i>
                                <span class="whitespace-nowrap font-sans text-[0.85rem] block">Lịch Sử Mua Hàng</span>
                            </a>
                        </li>-->
                    </ul>
                </div>
            </li>
            <?php endif?>
            <li>
                <div class="border-muted-200 dark:border-muted-700 my-3 h-px w-full border-t"></div>
            </li>
            <li>
                <a href="javascript:;" data-target-href-open="https://t.me/billvietreal" class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex cursor-pointer items-center gap-4 rounded-lg py-3 transition-colors duration-300 px-4 font-medium">
                      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Telegram_logo.svg/2048px-Telegram_logo.svg.png" width="19" alt="Icon Menu"> 
                      <span class="whitespace-nowrap font-sans text-sm block"><font color="green">Kênh Thông Báo (Nên Vào)</font></span> 
                </a>
            </li>
            <li>
                <a href="javascript:;" data-target-href-open="<?=$TD->Setting('telegram')?>"
                    class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex cursor-pointer items-center gap-4 rounded-lg py-3 transition-colors duration-300 px-4">
                    <img src="/<?=__IMG__?>/icon/menu/support.png" width="19" alt="Icon Menu">
                    <span class="whitespace-nowrap font-sans text-sm block">Liên Hệ Hỗ Trợ</span>
                </a>
            </li>
            <?php if ($isLogin->check()): ?>
            <li>
                <a href="javascript:;"
                    class="nui-focus text-muted-500 dark:text-muted-400/80 hover:bg-muted-100 dark:hover:bg-muted-700/60 hover:text-muted-600 dark:hover:text-muted-200 flex cursor-pointer items-center gap-4 rounded-lg py-3 log-out transition-colors duration-300 px-4">
                    <img src="/<?=__IMG__?>/icon/menu/logout.png?v=1" width="19" alt="Icon Menu">
                    <span class="whitespace-nowrap font-sans text-sm block">Đăng Xuất</span>
                </a>
            </li>
            <?php endif?>
        </ul>
        <div class="mb-2 grow"></div>
        <ul class="space-y-2">
            <li>
                <div class="w-full flex-none space-y-3 p-4">
                    <a href="javascript:void(0)"
                        class="group flex items-center gap-3 justify-center rounded-xl border border-transparent dark:bg-muted-800 px-4 py-2.5 font-semibold text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100">
                        <div class="grow leading-5 text-center whitespace-normal">
                            <span class="text-xs font-medium opacity-70 uppercase"><?=$TD->Setting('name-site')?>
                                version: <?=$TD->Setting('version-code')?></span>
                        </div>
                    </a>
                    <li><center> <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.startgif', '1,4959394,4,10045,"div#histatsC {position: absolute;top:0px;left:0px;}body>div#histatsC {position: fixed;}"']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_gif_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" alt="" target="_blank" ><div id="histatsC"><img border="0" src="//s4is.histats.com/stats/i/4959394.gif?4959394&103"></div></a>
</noscript>
<!-- Histats.com  END  --></center></li>
                </div>
            </li>
        </ul>
    </div>
</div>
<div role="button" id="layout-blur"
    class="bg-muted-800 dark:bg-muted-900 fixed start-0 top-0 z-[59] block size-full transition-opacity duration-300 lg:hidden opacity-0 pointer-events-none">
</div>
<div
    class="bg-muted-100 dark:bg-muted-900 relative min-h-screen w-full overflow-x-hidden px-4 transition-all duration-300 xl:px-10 lg:max-w-[calc(100%_-_280px)] lg:ms-[280px]">
    <div class="mx-auto w-full">
        <div class="relative z-[1] mb-5 flex h-16 items-center gap-2">
            <button id="layout-nav-open" type="button" class="flex size-10 items-center justify-center -ms-3">
                <div id="menu-icon" class="relative size-5 scale-90">
                    <span
                        class="line1 bg-primary-500 absolute block h-0.5 w-full transition-all duration-300 top-0.5"></span>
                    <span
                        class="line2 bg-primary-500 absolute top-1/2 block h-0.5 w-full max-w-[50%] transition-all duration-300"></span>
                    <span
                        class="line3 bg-primary-500 absolute block h-0.5 w-full transition-all duration-300 bottom-0"></span>
                </div>
            </button>
            <h1
                class="nui-heading nui-heading-2xl nui-weight-light nui-lead-normal text-muted-800 hidden md:block dark:text-white select-none">
                <span class="magic">
                    <span class="magic-star">
                        <svg viewBox="0 0 512 512">
                            <path
                                d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z">
                            </path>
                        </svg>
                    </span>
                <span class="magic-star">
                        <svg viewBox="0 0 512 512">
                            <path
                                d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z">
                            </path>
                        </svg>
                    </span>
                <span class="magic-star">
                        <svg viewBox="0 0 512 512">
                            <path
                                d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z">
                            </path>
                        </svg>
                    </span>
                <span class="magic-text"><?=$TD->Setting('name-site')?></span></span>
            </h1>
            <div class="ms-auto"></div>
            <div class="flex items-center gap-2 h-16">
                <?php if ($isLogin->check()):?>
                <span class="nui-tag nui-tag-md nui-tag-rounded-lg nui-tag-solid nui-tag-primary">
                    <span>Số Dư: <?=FormatNumber::TD($user['sodu'])?>đ</span></span>
                <?php endif;?>
                <label class="nui-theme-toggle" for="nui-theme-toggle-input">
                    <input type="checkbox" class="nui-theme-toggle-input" id="nui-theme-toggle-input" />
                    <span class="nui-theme-toggle-inner">
                        <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-sun">
                            <g fill="currentColor" stroke="currentColor" class="stroke-2">
                                <circle cx="12" cy="12" r="5"></circle>
                                <path
                                    d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72 1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42">
                                </path>
                            </g>
                        </svg>
                        <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-moon">
                            <path fill="currentColor" stroke="currentColor"
                                d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" class="stroke-2">
                            </path>
                        </svg>
                    </span>
                </label>
                <button type="button"
                    class="menu-country border-muted-200 hover:ring-muted-200 dark:hover:ring-muted-700 dark:border-muted-700 dark:bg-muted-800 dark:ring-offset-muted-900 flex size-9 items-center justify-center rounded-full border bg-white ring-1 ring-transparent transition-all duration-300 hover:ring-offset-4">
                    <img class="size-7 rounded-full" src="https://cdnl.iconscout.com/lottie/premium/thumb/security-loading-animated-icon-download-in-lottie-json-gif-static-svg-file-formats--protection-shield-lock-secure-pack-crime-icons-8836227.gif" alt="flag icon" />
                </button>
                <button type="button"
                    class="menu-country border-muted-200 hover:ring-muted-200 dark:hover:ring-muted-700 dark:border-muted-700 dark:bg-muted-800 dark:ring-offset-muted-900 flex size-9 items-center justify-center rounded-full border bg-white ring-1 ring-transparent transition-all duration-300 hover:ring-offset-4">
                    <img class="size-7 rounded-full" src="https://media1.giphy.com/media/v1.Y2lkPTZjMDliOTUyMG82eHUzaGtuZXpsaW9taXh5NWVmaDcwc3pqNzBndnYzd3JobmFtdSZlcD12MV9zdGlja2Vyc19zZWFyY2gmY3Q9cw/xmOMPI63SsyZyKz2Tx/source.gif" alt="flag icon" />
                </button>
                <?php if ($isLogin->check()):?>
                <div class="group relative z-20 inline-flex items-center justify-center text-end">
                    <div class="relative z-20 size-9 text-left">
                        <button
                            class="group-hover:ring-primary-500 dark:ring-offset-muted-900 inline-flex size-9 items-center justify-center rounded-full ring-1 ring-transparent transition-all duration-300 group-hover:ring-offset-4"
                            id="user-menu-button" type="button">
                            <div class="relative inline-flex size-9 items-center justify-center rounded-full">
                                <img src="<?=Avatar($user['username'], $user['avatar'])?>"
                                    class="max-w-full rounded-full object-cover shadow-sm dark:border-transparent"
                                    alt="User <?=$user['username']?>" role="<?=$user['rank']?>" />
                                <?php if ($plans->TD('tengoi', $taikhoan)||in_array($user['rank'],['admin','leader'])): ?>
                                <img class="crown3" src="/<?= __IMG__ ?>/icon/menu/premium.webp">
                                <?php endif; ?>
                            </div>
                        </button>
                        <div id="user-menu-items"
                            class="divide-muted-100 border-muted-200 dark:divide-muted-700 dark:border-muted-700 dark:bg-muted-800 absolute end-0 mt-2 w-64 origin-top-right divide-y transform scale-95 opacity-0 transition duration-300 rounded-md border bg-white shadow-lg focus:outline-none hidden">
                            <div class="bg-muted-50 dark:bg-muted-700/40 p-6" role="none">
                                <div class="flex items-center" role="none">
                                    <div class="relative inline-flex size-14 items-center justify-center rounded-full user-avatar"
                                        role="none">
                                        <img src="<?=Avatar($user['username'], $user['avatar'])?>"
                                            class="max-w-full rounded-full object-cover shadow-sm dark:border-transparent"
                                            alt="User <?=$user['username']?>" role="<?=$user['rank']?>">
                                        <?php if ($plans->TD('tengoi', $taikhoan)||in_array($user['rank'],['admin','leader'])): ?>
                                        <img class="crown3" src="/<?= __IMG__ ?>/icon/menu/premium.webp">
                                        <?php endif; ?>
                                    </div>
                                    <div class="ms-3" role="none">
                                        <h6 class="font-heading text-muted-800 text-sm font-medium dark:text-white"
                                            role="none">
                                            <?=$user['username']?>
                                        </h6>
                                        <p class="text-muted-400 font-sans text-xs" role="none">
                                            <?=valid_email($user['email']) ? $cut->characters($user['email'],18) : 'Chưa xác minh email'?>
                                        </p>
                                        <?php if ($plans->TD('tengoi', $taikhoan)):?>
                                        <img src="/<?=__IMG__?>/main/level/<?=$plans->TD('tengoi', $taikhoan)?>.gif"
                                            class="svip rounded-full object-cover shadow-sm dark:border-transparent"
                                            alt="<?=$plans->TD('tengoi', $taikhoan)?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2" role="none">
                                <div role="menuitem" tabindex="-1">
                                    <a href="javascript:;" data-target-href="/user/<?=$user['username']?>/settings#open"
                                        class="group flex w-full items-center rounded-md p-3 text-sm transition-colors duration-300 text-muted-400">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon size-5" width="1em" height="1em" viewBox="0 0 256 256">
                                            <g fill="currentColor">
                                                <path
                                                    d="M224 128a95.76 95.76 0 0 1-31.8 71.37A72 72 0 0 0 128 160a40 40 0 1 0-40-40a40 40 0 0 0 40 40a72 72 0 0 0-64.2 39.37A96 96 0 1 1 224 128"
                                                    opacity=".2"></path>
                                                <path
                                                    d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24M74.08 197.5a64 64 0 0 1 107.84 0a87.83 87.83 0 0 1-107.84 0M96 120a32 32 0 1 1 32 32a32 32 0 0 1-32-32m97.76 66.41a79.66 79.66 0 0 0-36.06-28.75a48 48 0 1 0-59.4 0a79.66 79.66 0 0 0-36.06 28.75a88 88 0 1 1 131.52 0">
                                                </path>
                                            </g>
                                        </svg>
                                        <div class="ms-3">
                                            <h6
                                                class="font-heading text-muted-800 text-xs font-medium leading-none dark:text-white">
                                                Thông Tin </h6>
                                            <p class="text-muted-400 font-sans text-xs mt-1"> Quản lý tài khoản </p>
                                        </div>
                                    </a>
                                </div>
                                <div role="menuitem" tabindex="-1">
                                    <a href="javascript:;" data-target-href="/nap-tien/<?=$user['username']?>/send"
                                        class="group flex w-full items-center rounded-md p-3 text-sm transition-colors duration-300 text-muted-400">
                                        <svg class="icon size-5" width="1em" height="1em" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z" />
                                        </svg>

                                        <div class="ms-3">
                                            <h6
                                                class="font-heading text-muted-800 text-xs font-medium leading-none dark:text-white">
                                                Nạp Tiền </h6>
                                            <p class="text-muted-400 font-sans text-xs mt-1"> Tới trang nạp tiền </p>
                                        </div>
                                    </a>
                                </div>
                                <div role="menuitem" tabindex="-1">
                                    <a href="javascript:;" data-target-href="/thue-goi"
                                        class="group flex w-full items-center rounded-md p-3 text-sm transition-colors duration-300 text-muted-400">
                                        <svg class="icon size-5" width="1em" height="1em" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                        </svg>

                                        <div class="ms-3">
                                            <h6
                                                class="font-heading text-muted-800 text-xs font-medium leading-none dark:text-white">
                                                Mua Gói VIP </h6>
                                            <p class="text-muted-400 font-sans text-xs mt-1"> Tới trang mua gói </p>
                                        </div>
                                    </a>
                                </div>
                                <?php if (isset($user['rank'])&&$user['rank']==='admin'){ ?>
                                <div role="menuitem" tabindex="-1">
                                    <a href="javascript:;" data-target-href-open="/admin/dashboard"
                                        class="group flex w-full items-center rounded-md p-3 text-sm transition-colors duration-300 text-muted-400">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon size-5" width="1em" height="1em" viewBox="0 0 256 256">
                                            <g fill="currentColor">
                                                <path
                                                    d="m230.1 108.76l-31.85-18.14c-.64-1.16-1.31-2.29-2-3.41l-.12-36A104.6 104.6 0 0 0 162 32l-32 17.89h-4L94 32a104.6 104.6 0 0 0-34.11 19.25l-.16 36c-.7 1.12-1.37 2.26-2 3.41l-31.84 18.1a99.2 99.2 0 0 0 0 38.46l31.85 18.14c.64 1.16 1.31 2.29 2 3.41l.12 36A104.6 104.6 0 0 0 94 224l32-17.87h4L162 224a104.6 104.6 0 0 0 34.08-19.25l.16-36c.7-1.12 1.37-2.26 2-3.41l31.84-18.1a99.2 99.2 0 0 0 .02-38.48M128 168a40 40 0 1 1 40-40a40 40 0 0 1-40 40"
                                                    opacity=".2"></path>
                                                <path
                                                    d="M128 80a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48m0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32m109.94-52.79a8 8 0 0 0-3.89-5.4l-29.83-17l-.12-33.62a8 8 0 0 0-2.83-6.08a111.9 111.9 0 0 0-36.72-20.67a8 8 0 0 0-6.46.59L128 41.85L97.88 25a8 8 0 0 0-6.47-.6a111.9 111.9 0 0 0-36.68 20.75a8 8 0 0 0-2.83 6.07l-.15 33.65l-29.83 17a8 8 0 0 0-3.89 5.4a106.5 106.5 0 0 0 0 41.56a8 8 0 0 0 3.89 5.4l29.83 17l.12 33.63a8 8 0 0 0 2.83 6.08a111.9 111.9 0 0 0 36.72 20.67a8 8 0 0 0 6.46-.59L128 214.15L158.12 231a7.9 7.9 0 0 0 3.9 1a8.1 8.1 0 0 0 2.57-.42a112.1 112.1 0 0 0 36.68-20.73a8 8 0 0 0 2.83-6.07l.15-33.65l29.83-17a8 8 0 0 0 3.89-5.4a106.5 106.5 0 0 0-.03-41.52m-15 34.91l-28.57 16.25a8 8 0 0 0-3 3c-.58 1-1.19 2.06-1.81 3.06a7.94 7.94 0 0 0-1.22 4.21l-.15 32.25a95.9 95.9 0 0 1-25.37 14.3L134 199.13a8 8 0 0 0-3.91-1h-3.83a8.1 8.1 0 0 0-4.1 1l-28.84 16.1A96 96 0 0 1 67.88 201l-.11-32.2a8 8 0 0 0-1.22-4.22c-.62-1-1.23-2-1.8-3.06a8.1 8.1 0 0 0-3-3.06l-28.6-16.29a90.5 90.5 0 0 1 0-28.26l28.52-16.28a8 8 0 0 0 3-3c.58-1 1.19-2.06 1.81-3.06a7.94 7.94 0 0 0 1.22-4.21l.15-32.25a95.9 95.9 0 0 1 25.37-14.3L122 56.87a8 8 0 0 0 4.1 1h3.64a8 8 0 0 0 4.1-1l28.84-16.1A96 96 0 0 1 188.12 55l.11 32.2a8 8 0 0 0 1.22 4.22c.62 1 1.23 2 1.8 3.06a8.1 8.1 0 0 0 3 3.06l28.6 16.29a90.5 90.5 0 0 1 .05 28.29Z">
                                                </path>
                                            </g>
                                        </svg>
                                        <div class="ms-3">
                                            <h6
                                                class="font-heading text-muted-800 text-xs font-medium leading-none dark:text-white">
                                                Trang Quản Trị </h6>
                                            <p class="text-muted-400 font-sans text-xs mt-1"> Tới trang quản trị website
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php }?>
                                <div role="menuitem" tabindex="-1">
                                    <a href="javascript:;"
                                        class="log-out group flex w-full items-center rounded-md p-3 text-sm transition-colors duration-300 text-muted-400">
                                        <svg class="icon size-4" style="margin-left:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                            viewBox="0 0 24 24">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4m7 14l5-5l-5-5m5 5H9"></path>
                                        </svg>
                                        <div class="ms-3">
                                            <h6
                                                class="font-heading text-muted-800 text-xs font-medium leading-none dark:text-white">
                                                Đăng Xuất </h6>
                                            <p class="text-muted-400 font-sans text-xs mt-1"> Đăng xuất tài khoản </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="user-menu-items"
                            class="divide-muted-100 border-muted-200 dark:divide-muted-700 dark:border-muted-700 dark:bg-muted-800 absolute end-0 mt-2 w-64 origin-top-right divide-y transform scale-95 opacity-0 transition duration-300 rounded-md border bg-white shadow-lg focus:outline-none hidden">
                            <div class="p-6 text-center" role="none">
                                <div class="relative mx-auto flex size-20 items-center justify-center rounded-full"
                                    role="none">
                                    <img src="<?=Avatar($user['username'], $user['avatar'])?>"
                                        class="max-w-full rounded-full object-cover shadow-sm dark:border-transparent"
                                        alt="User <?=$user['username']?>" role="<?=$user['rank']?>" />
                                    <?php if ($plans->TD('tengoi', $taikhoan) || in_array($user['rank'],['admin','leader'])): ?>
                                    <img class="crown3" src="/<?= __IMG__ ?>/icon/menu/premium.webp">
                                    <?php endif; ?>
                                </div>
                                <div class="mt-3" role="none">
                                    <h6 class="font-heading text-muted-800 text-sm font-medium dark:text-white"
                                        role="none"> <?=$user['username']?> </h6>
                                    <div class="status px-8">
                                        <span
                                            class="relative inline-flex h-5 items-center justify-center font-sans whitespace-nowrap px-3 text-center text-xs gap-1 leading-10 transition-all duration-300 rounded-full bg-success-500/10 dark:bg-success-500/20 text-success-500 w-15"><?=strtoupper($user['rank'])?></span>
                                    </div>
                                    <p class="text-muted-400 mb-4 font-sans text-xs pt-1" role="none">
                                        <?= valid_email($user['email']) ? $user['email'] : 'Chưa xác minh email' ?> </p>
                                    <a href="javascript:;" data-target-href="/user/<?=$user['username']?>/settings#open"
                                        class="nui-button nui-button-md nui-button-rounded-lg nui-button-solid nui-button-default w-full"
                                        disabled="false" role="none"> Quản lý tài khoản
                                    </a>
                                </div>
                            </div>
                            <div class="p-6" role="none">
                                <button type="button"
                                    class="nui-button nui-button-md nui-button-rounded-lg nui-button-solid nui-button-default w-full log-out"
                                    role="none"> Đăng xuất
                                </button>
                            </div>
                        </div> -->
                        <!---->
                    </div>
                </div>
                <?php else:?>
                <a data-nui-tooltip-position="down" data-nui-tooltip="Tới trang đăng nhập"
                    href="/oauth/dang-nhap?redirect=<?=urlencode($actual_link)?>"
                    class="nui-button nui-button-sm nui-button-rounded-lg nui-button-solid nui-button-danger">
                    <i class="ri-login-circle-line me-2"></i>Đăng Nhập
                </a>
                <?php endif;?>
            </div>
        </div>