<?php $options_header = ['title' => 'Kho Mã Nguồn','description'=> 'Hệ thống cung cấp kho mã nguồn đa dạng, không cần bạn phải biết gì về lập trình, chỉ cần biết Mua/Tải/Chỉnh/Sao Chép/Dán còn lại cứ để chúng tôi lo']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/server/models/views/products.php');
ProductManager::CleanInvalidHistory();
$totalProducts = ProductManager::ThanhDieuDB()->query("SELECT COUNT(*) as total FROM ws_products WHERE trangthai = 1")->fetch_assoc()['total'];?>
<main class="lg:max-w-[calc(100%_-_280px)] mx-auto thanhdieu-refresh mb-10">
    <div class="flex w-full flex-col items-center justify-between gap-4 sm:flex-row">
        <div class="flex w-full items-center gap-4 sm:w-auto">
            <div
                class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-lg nui-has-icon w-full sm:w-auto">
                <div class="nui-input-outer">
                    <div>
                        <input type="text" class="nui-input" placeholder="Có không giữ mất thì tìm...">
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
            </div>
        </div>
        <div class="nui-message nui-message-rounded-lg nui-message-warning nui-has-icon">
            <div class="nui-message-icon-outer">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="icon nui-message-icon" width="1em" height="1em" viewBox="0 0 256 256">
                    <path fill="currentColor"
                        d="m227.31 80.23l-51.54-51.54A16.13 16.13 0 0 0 164.45 24h-72.9a16.13 16.13 0 0 0-11.32 4.69L28.69 80.23A16.13 16.13 0 0 0 24 91.55v72.9a16.13 16.13 0 0 0 4.69 11.32l51.54 51.54A16.13 16.13 0 0 0 91.55 232h72.9a16.13 16.13 0 0 0 11.32-4.69l51.54-51.54a16.13 16.13 0 0 0 4.69-11.32v-72.9a16.13 16.13 0 0 0-4.69-11.32M120 80a8 8 0 0 1 16 0v56a8 8 0 0 1-16 0Zm8 104a12 12 0 1 1 12-12a12 12 0 0 1-12 12">
                    </path>
                </svg>
            </div>
            <span class="nui-message-inner-text font-bold">Nếu có bất kỳ code nào lỗi đừng ngại báo lỗi vào:&nbsp;<a
                    data-target-href-open="<?=$TD->Setting('boxchat')?>" class="text-nowrap text-primary-500"
                    href="javascript:void(0)">📞 Telegram</a></span>
        </div>
        <div class="flex w-full items-center justify-end gap-4 sm:w-auto">
            <div class="nui-card nui-card-rounded-lg nui-card-default min-w-[340px]">
                <div class="grid grid-cols-3 p-3">
                    <div class="relative flex flex-col text-center">
                        <span
                            class="text-muted-800 dark:text-muted-100 font-sans text-2xl font-bold"><?=CountFormatter::EN($totalProducts)?>
                        </span>
                        <p class="text-muted-400 font-sans text-xs">Kho Mã Nguồn </p>
                        <span class="bg-primary-500 absolute end-0 top-0 size-2 rounded-full"></span>
                    </div>
                    <div class="relative flex flex-col text-center">
                        <span
                            class="text-muted-800 dark:text-muted-100 font-sans text-2xl font-bold"><?=CountFormatter::EN(ProductManager::TotalPurchases($taikhoan))?></span>
                        <p class="text-muted-400 font-sans text-xs"> Bạn Đã Mua </p>
                        <span class="bg-success-500 absolute end-0 top-0 size-2 rounded-full"></span>
                    </div>
                    <div class="relative flex flex-col text-center">
                        <span class="text-muted-800 dark:text-muted-100 font-sans text-2xl font-bold">
                            <?= CountFormatter::EN(ProductManager::TotalSoldAll()) ?> </span>
                        <p class="text-muted-400 font-sans text-xs"> Tổng Đã Bán </p>
                        <span class="absolute end-0 top-0 size-2 rounded-full bg-amber-500"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$product = ProductManager::Products(8,$page);
$totalPages = ceil($totalProducts / 8);
$maxVisiblePages = isMobile() ? 8 : 8;
if ($product && $product->num_rows > 0): ?>
    <div class="ltablet:grid-cols-4 grid w-full gap-4 sm:grid-cols-3 lg:grid-cols-4 mt-8 select-none">
        <?php while ($item = $product->fetch_assoc()): ?>
        <div class="nui-card nui-card-rounded-lg nui-card-default group p-3 shadow-lg posts-item">
            <div class="relative cursor-pointer" data-target-href="/details/<?=$item['slug']?>">
                <img src="/<?= __IMG__ ?>/main/loading.gif" data-src="/<?= __IMG__ ?>/uploads/t/<?=$item['hinhthunho']?>"
                    class="h-40 w-full rounded-lg object-cover lazyload">
                <span data-nui-tooltip="Giá: <?=FormatNumber::TD($item['giatien'])?>đ - Mã code #<?=$item['id']?>"
                    class="nui-tag nui-tag-sm nui-tag-rounded-full nui-tag-pastel nui-tag-<?=isMobile() ? 'danger' : 'primary'?> font-bold absolute start-3 top-3 translate-y-1 opacity-1 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                    Giá: <?=FormatNumber::TD($item['giatien'])?>đ - Mã code #<?=$item['id']?>
                </span>
            </div>
            <div>
                <div class="mb-6 mt-3" data-nui-tooltip="Xem chi tiết code: #<?=THANHDIEU($item['id'])?>">
                    <a class="nui-heading nui-heading-md nui-weight-medium nui-lead-snug line-clamp-2 text-gray-800 dark:text-gray-100 cursor-pointer hover-transform"
                        tag="h3" href="javascript:void(0)" data-target-href="/details/<?=$item['slug']?>">
                        <?=THANHDIEU($item['tieude'])?>
                    </a>
                </div>
                <div class="mt-auto flex items-center gap-2">
                    <div class="nui-avatar nui-avatar-xs nui-avatar-rounded-full bg-muted-500/20 text-muted-500">
                        <div class="nui-avatar-inner pointer-events-none">
                            <img src="/<?= __IMG__ ?>/icon/front-pages/angry-birds.gif"
                                class="nui-avatar-img nui-avatar-rounded-full">
                        </div>
                    </div>
                   <div class="leading-none">
                        <h4 class="text-muted-800 dark:text-muted-100 font-sans text-sm font-medium leading-tight">
                            Việt Khánh                        </h4>
                        <p class="text-muted-400 font-sans text-xs time-ago" data-timeago="<?=$item['ngaydang']?>"><?=timeago(strtotime(($item['ngaydang'])))?>
                        </p>
                    </div>
                    <div class="ms-auto">
                        <?php if(!ProductManager::CheckPurchase($taikhoan, $item['id'])):?>
                        <button data-product-id="<?=$item['id']?>"
                            data-product-price="<?=FormatNumber::TD($item['giatien'])?>đ" type="button"
                            class="router-link-active router-link-exact-active order-product nui-button-action nui-button-primary nui-button-rounded-sm">
                            <i class="ri-shopping-cart-line me-1"></i>
                            <span>Mua Ngay</span>
                        </button>
                        <?php else: ?>
                        <button data-product-id="<?=$item['id']?>" type="button"
                            class="router-link-active router-link-exact-active download-product nui-button-action nui-button-success nui-button-rounded-sm">
                            <span><i class="ri-download-cloud-2-line me-1"></i>Tải Xuống</span>
                        </button>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
    <div class="nui-placeholder-page nui-placeholder-xs select-none">
        <div class="nui-placeholder-page-inner">
            <div class="nui-placeholder-page-img">
                <img class="block dark:hidden" src="/<?=__IMG__?>/svg/page-not-found.svg" alt="Page not found">
                <img class="hidden dark:block" src="/<?=__IMG__?>/svg/page-not-found.svg" alt="Page not found">
            </div>
            <div class="nui-placeholder-page-content">
                <h4 class="nui-heading nui-heading-xl nui-weight-medium nui-lead-normal nui-placeholder-page-title">
                    Không có
                    kết quả phù hợp</h4>
                <p class="nui-placeholder-page-subtitle">Có vẻ như chúng tôi không tìm thấy mã nguồn mà bạn đang tìm
                    kiếm, hoặc chưa có dữ liệu.</p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($totalProducts > 0 && $totalPages > 1 && ($page >= 1 && $page <= $totalPages)): ?>
    <div class="mb-6 mt-6">
        <div class="nui-pagination nui-pagination-rounded-lg nui-pagination-primary">
            <ul class="nui-pagination-list nui-pagination-rounded-lg">
                <?php
                if ($totalPages <= $maxVisiblePages) { ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li><a href="/danh-muc/ma-nguon/trang/<?= $i ?>"
                        class="nui-pagination-link nui-pagination-rounded-lg <?= ($i === $page ? 'nui-active' : '') ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <?php } else { ?>
                <?php
                    $startPage = max(1, $page - 3);
                    $endPage = min($totalPages, $page + 4);
                    $pageCount = 0;
                    if ($startPage > 1) { ?>
                <li><a href="/danh-muc/ma-nguon/trang/1" class="nui-pagination-link nui-pagination-rounded-lg">1</a>
                </li>
                <?php $pageCount++; ?>
                <?php if ($startPage > 2 && $pageCount < $maxVisiblePages - 1): ?>
                <li><span class="nui-pagination-ellipsis nui-pagination-rounded-lg">…</span></li>
                <?php $pageCount++; ?>
                <?php endif; ?>
                <?php }
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        if ($pageCount < $maxVisiblePages - 1) { ?>
                <li><a href="/danh-muc/ma-nguon/trang/<?= $i ?>"
                        class="nui-pagination-link nui-pagination-rounded-lg <?= ($i === $page ? 'nui-active' : '') ?>"><?= $i ?></a>
                </li>
                <?php $pageCount++; ?>
                <?php }
                    }
                    if ($endPage < $totalPages && $pageCount < $maxVisiblePages - 1) {
                        if ($pageCount < $maxVisiblePages - 2) { ?>
                <li><span class="nui-pagination-ellipsis nui-pagination-rounded-lg">…</span></li>
                <?php $pageCount++; ?>
                <?php }
                        ?>
                <li><a href="/danh-muc/ma-nguon/trang/<?= $totalPages ?>"
                        class="nui-pagination-link nui-pagination-rounded-lg"><?= $totalPages ?></a></li>
                <?php $pageCount++; ?>
                <?php }
                } ?>
            </ul>
            <div class="nui-pagination-buttons nui-pagination-rounded-lg">
                <?php if ($page > 1): ?>
                <a href="/danh-muc/ma-nguon/trang/<?= $page - 1 ?>" data-nui-tooltip="Về lại trang <?= $page - 1 ?>"
                    class="router-link-active router-link-exact-active nui-pagination-button" tabindex="0">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                        class="icon pagination-button-icon" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m15 18l-6-6l6-6"></path>
                    </svg>
                </a>
                <?php endif; ?>
                <?php if ($page < $totalPages): ?>
                <a href="/danh-muc/ma-nguon/trang/<?= $page + 1 ?>" data-nui-tooltip="Trang kế tiếp"
                    class="router-link-active router-link-exact-active nui-pagination-button" tabindex="0">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                        class="icon pagination-button-icon" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m9 18l6-6l-6-6"></path>
                    </svg>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>