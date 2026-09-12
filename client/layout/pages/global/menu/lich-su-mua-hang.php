<?php $options_header = ['title' => 'Lịch Sử Mua Hàng']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<?php if(!$isLogin->check()){die('<meta http-equiv="refresh"content="0; url=/oauth/dang-nhap?redirect='.urlencode($actual_link).'">');}?>
<main>
    <div class="w-full pb-24">
        <div class="border-muted-200 dark:border-muted-800 border-b py-6">
            <div class="flex flex-col items-center gap-3 text-center sm:flex-row sm:text-start">
                <div class="nui-icon-box nui-box-md nui-box-pastel nui-box-success nui-mask nui-mask-blob">
                    <i class="ri-shopping-basket-2-line fs-24px"></i>
                </div>
                <div>
                    <h2
                        class="nui-heading nui-heading-2xl nui-weight-medium nui-lead-normal text-muted-800 dark:text-white">
                        Lịch Sử Mua Hàng</h2>
                    <p
                        class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                        Có lỗi khi tải xuống, hãy báo ngay cho admin để được nhanh chóng cập nhật lại liên
                        kết tải xuống.<?=isMobile() ?'<br/><br/><b class="text-red-500">Kéo lịch sử qua bên phải để hiển thị thao tác<br/>Tải Xuống.</b>':null?></p>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between py-6">
            <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-lg nui-has-icon">
                <div class="nui-input-outer">
                    <input type="search" class="nui-input" id="search" placeholder="Có không giữ mất thì tìm...">
                    <div class="nui-input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="icon nui-input-icon-inner" width="1em" height="1em"
                            viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21l-4.3-4.3"></path>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 hidden md:block">
                <span class="text-muted-400 font-sans text-sm total-records">0-0</span>
            </div>
        </div>
        <div class="mt-2 overflow-x-auto ThanhDieu_dataTables_wrapper" id="ThanhDieu_DataTables_Table">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <th
                        class="text-muted-400 dark:text-muted-300 px-4 pb-3 text-start font-sans text-xs font-semibold md:w-1/5">
                        <span>Mã Giao Dịch</span>
                    </th>
                    <th
                        class="text-muted-400 dark:text-muted-300 px-4 pb-3 text-start font-sans text-xs font-semibold md:w-1/5">
                        <span>Đơn Hàng</span>
                    </th>
                    <th class="text-muted-400 dark:text-muted-300 px-4 pb-3 text-start font-sans text-xs font-semibold">
                        <span>Số Tiền</span>
                    </th>
                    <th class="text-muted-400 dark:text-muted-300 px-4 pb-3 text-start font-sans text-xs font-semibold">
                        <span>Ngày Mua</span>
                    </th>
                    <th class="text-muted-400 dark:text-muted-300 px-4 pb-3 text-start font-sans text-xs font-semibold">
                        <span>Thao Tác</span>
                    </th>
                </thead>
                <tbody class="rl-history-purchase">
                    <tr class="odd">
                        <td colspan="5" class="dataTables_empty text-muted-400 fs-13px text-center p-1">Đang tải lịch
                            sử...</td>
                    </tr>
                </tbody>
            </table>
            <hr class="separator">
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>