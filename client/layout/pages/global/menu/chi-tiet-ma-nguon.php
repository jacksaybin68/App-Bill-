<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php'); 
require_once($_SERVER['DOCUMENT_ROOT'].'/server/models/views/products.php'); 
$product = new ProductManager();
ProductManager::CleanInvalidHistory();
$options_header = [
    'title' => ($product->col('tieude') && $product->col('trangthai') == 1) 
        ? $product->col('tieude') 
        : 'Đơn Hàng Không Tìm Thấy',
    'description' => ($product->col('trangthai') == 0)
        ? 'Có vẻ như sản phẩm mà bạn đang tìm kiếm đã bị xoá hoặc chưa từng tồn tại.'
        : (trim(strip_tags($product->col('noidung'))) === ''
        ? 'Không có thông tin mô tả về đơn hàng này'
        : strip_tags($product->col('noidung'))),
    'og:image' => '/'.__IMG__.'/uploads/t/'.$product->col('hinhthunho')
];
?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="w-full pb-2">
        <div class="border-muted-200 dark:border-muted-800 border-b py-6 pc">
            <div class="flex flex-col items-center gap-3 text-center sm:flex-row sm:text-start">
                <div class="nui-icon-box nui-box-md nui-box-pastel nui-box-primary nui-mask nui-mask-blob">
                    <i class="ri-shopping-cart-line fs-22px"></i>
                </div>
                <div>
                    <h2
                        class="nui-heading nui-heading-xl nui-weight-medium nui-lead-normal text-muted-800 dark:text-white">
                        Chi tiết đơn hàng </h2>
                    <p
                        class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                        <?= ($product->col('tieude') && $product->col('trangthai') == 1) ? $product->col('tieude') : '<strike>Đơn Hàng Không Tìm Thấy</strike>' ?>
                    </p>
                </div>
            </div>
        </div>
        <?php if ($product->exists() && $product->col('trangthai')) : ?>
        <div class="divide-muted-200 dark:divide-muted-800 space-y-10 py-6 select-none">
            <div class="grid gap-8 md:grid-cols-12">
                <div class="md:col-span-4">
                    <div class="flex gap-3">
                        <div class="asp-detail">
                            <?php foreach (explode('|', $product->col('anhsanpham')) as $asp):?>
                            <div class="col-span-6 sm:col-span-3 swiper-slide">
                                <a href="javascript:void(0)" class="product-img">
                                    <img class="lazyload"
                                        data-zoom-img="/<?=__IMG__.'/uploads/t/'.$asp.''?>"
                                        src="/<?=__IMG__?>/main/loading.gif"
                                        data-src="/<?=__IMG__?>/uploads/t/<?=$asp?>" alt="<?=$product->col('tieude')?>">
                                    <!-- <div class="dark absolute inset-x-0 bottom-8 flex items-center justify-center px-6">
                                        <div role="progressbar" aria-valuemax="100"
                                            class="nui-progress nui-progress-xs nui-progress-default nui-progress-primary nui-progress-rounded-full">
                                            <div class="nui-progress-bar nui-progress-indeterminate animate-nui-progress-indeterminate"
                                                style="width: 100%;"></div>
                                        </div>
                                    </div> -->
                                </a>
                            </div>
                            <?php endforeach; ?>
                            <?php if (!isMobile() && count(explode('|', $product->col('anhsanpham'))) > 1): ?>
                            <div class="swiper-nav">
                                <i class="ri-arrow-left-s-line prev-arrow"></i>
                                <i class="ri-arrow-right-s-line next-arrow"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <span class="pc border-muted-200 dark:border-muted-800 border-r"></span>
                    </div>
                </div>
                </a>
                <div class="md:col-span-8 thanhdieu-refresh">
                    <div class="w-full md:w-1/2 md:pl-10 w-product break-words">
                        <span
                            class="nui-tag nui-tag-md nui-tag-rounded-lg nui-tag-pastel nui-tag-primary border-none-disabled"><i
                                class="ri-time-line"></i> Cập nhật gần đây:
                            <?=FormatTime::TD($product->col('ngaycapnhat'))?></span>
                        <h1 class="text-2xl font-bold mb-4 mt-2"><?=$product->col('tieude')?></h1>
                        <?php if ($product->col('noidung') === '<p><br></p>' || $product->col('noidung') === '' || strip_tags($product->col('noidung')) === ''):?>
                        <div class="flex items-center mb-4">
                            <span class="text-sm text-gray-400">Không có thông tin mô tả về đơn hàng này.</span>
                        </div>
                        <?php else: ?>
                        <div class="flex items-center mb-4">
                            <span class="text-sm text-gray-400"><?= nl2br($product->col('noidung')) ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="flex items-center mb-4 space-x-4">
                            <div
                                class="relative inline-flex items-center px-6 py-3 bg-purple-600 text-white font-bold text-2xl rounded-md shadow-lg bang-ron">
                                <?=FormatNumber::TD($product->col('giatien'))?>đ
                                <span class="after"></span>
                            </div>
                            <!-- <div class="flex flex-col">
                                    <span class="line-through text-primary-400 fs-12px">Ngày đăng: <?=$product->col('ngaydang')?></span>
                                    <span class="text-primary-500 font-semibold fs-12px">Cập nhật gần đây: <?=$product->col('ngaycapnhat')?></span>
                                </div> -->
                        </div>
                        <div class="mb-4 text-sm">
                            <div class="space-y-2">
                                <span class="block">📲 Liên hệ cho chúng tôi:
                                    <i><a class="font-bold text-primary-500 underline" target="_blank"
                                            href="<?=$TD->Setting('telegram')?>">Nhấn vào đây</a></i>
                                </span>
                                <span class="block text-red-500 font-semibold pc">⚠️ Nếu tải về mà thấy hơi sai sai? Có
                                    thể là do link lỗi, hãy báo cho admin, chúng tôi sẽ update link mới và đồng bộ với
                                    lịch sử mua của bạn</span>
                                <span class="block text-red-500 font-semibold mobile">Không tải được? Đừng lo, link được
                                    admin chăm sóc như con! Có vấn đề chắc do... bạn chưa kiểm tra lại lịch sử
                                    mua!</span>
                            </div>
                        </div>
                        <?php if(!ProductManager::CheckPurchase($taikhoan, $product->col('id'))) :?>
                        <button data-product-id="<?=$product->col('id')?>"
                            data-product-price="<?=FormatNumber::TD($product->col('giatien'))?>đ" type="button"
                            class="nui-button nui-button-md nui-button-rounded-md order-product nui-button-solid nui-button-primary nui-button-shadow w-full"><i
                                class="ri-shopping-cart-line me-2"></i>Mua Ngay</button>
                        <?php else: ?>
                        <button type="download" data-product-id="<?=$product->col('id')?>"
                            class="nui-button nui-button-md download-product nui-button-rounded-md nui-button-solid nui-button-success nui-button-shadow w-full"><i
                                class="ri-download-cloud-2-line me-1"></i>Tải Xuống</button>
                        <?php endif;?>
                        <button type="button" data-target-href="/danh-muc/ma-nguon"
                            class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-default nui-button-shadow w-full mt-4"><i
                                class="ri-arrow-left-line me-1"></i>Quay lại</button>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="nui-placeholder-page nui-placeholder-xs select-none">
            <div class="nui-placeholder-page-inner">
                <div class="nui-placeholder-page-img <?=isMobile() ? 'mt-12' : 'mt-16'?> pointer-events-none">
                    <img class="block dark:hidden" src="/<?=__IMG__?>/main/no-found.png" alt="Page not found">
                    <img class="hidden dark:block" src="/<?=__IMG__?>/main/no-found.png" alt="Page not found">
                </div>
                <div class="nui-placeholder-page-content">
                    <h4 class="nui-heading nui-heading-xl nui-weight-medium nui-lead-normal nui-placeholder-page-title">
                        Đơn hàng không tìm thấy</h4>
                    <p class="nui-placeholder-page-subtitle">Có vẻ như sản phẩm mà bạn đang tìm kiếm đã bị xoá hoặc chưa
                        từng tồn tại.</p>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="button" data-target-href="/danh-muc/ma-nguon"
                        class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-default nui-button-shadow">
                        <i class="ri-arrow-left-line me-2"></i>Quay lại
                    </button>
                </div>
            </div>
        </div>
        <!-- <div class="w-full pt-5">
            <div class="nui-card nui-card-rounded-lg nui-card-default nui-focus nui-text-700 group relative mx-auto mt-6 max-w-3xl border-2 border-dashed p-8 hover:border-solid"
                tabindex="0">
                <div
                    class="mb-3 flex items-center justify-start gap-1 opacity-90 transition-opacity duration-300 group-hover:opacity-100 group-focus:opacity-100">
                    <span class="nui-tag nui-tag-sm nui-tag-rounded-lg nui-tag-outline nui-tag-danger">Response
                        Code</span>
                    <span class="nui-tag nui-tag-sm nui-tag-rounded-lg nui-tag-solid nui-tag-danger">404</span>

                </div>
                <div class="mb-4 flex items-center gap-2">
                    <div class="nui-icon-box nui-box-rounded-full nui-box-md nui-box-solid nui-box-danger">
                        <svg data-v-b4402e20="" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="icon size-6"
                            width="1em" height="1em" viewBox="0 0 256 256">
                            <g fill="currentColor">
                                <path
                                    d="M128 24c-53 0-96 41.19-96 92c0 34.05 19.31 63.78 48 79.69V216a8 8 0 0 0 8 8h80a8 8 0 0 0 8-8v-20.31c28.69-15.91 48-45.64 48-79.69c0-50.81-43-92-96-92M92 152a20 20 0 1 1 20-20a20 20 0 0 1-20 20m72 0a20 20 0 1 1 20-20a20 20 0 0 1-20 20"
                                    opacity=".2"></path>
                                <path
                                    d="M92 104a28 28 0 1 0 28 28a28 28 0 0 0-28-28m0 40a12 12 0 1 1 12-12a12 12 0 0 1-12 12m72-40a28 28 0 1 0 28 28a28 28 0 0 0-28-28m0 40a12 12 0 1 1 12-12a12 12 0 0 1-12 12M128 16C70.65 16 24 60.86 24 116c0 34.1 18.27 66 48 84.28V216a16 16 0 0 0 16 16h80a16 16 0 0 0 16-16v-15.72C213.73 182 232 150.1 232 116c0-55.14-46.65-100-104-100m44.12 172.69a8 8 0 0 0-4.12 7V216h-16v-24a8 8 0 0 0-16 0v24h-16v-24a8 8 0 0 0-16 0v24H88v-20.31a8 8 0 0 0-4.12-7C56.81 173.69 40 145.84 40 116c0-46.32 39.48-84 88-84s88 37.68 88 84c0 29.83-16.81 57.69-43.88 72.69">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-danger-500 font-mono text-lg font-medium [overflow-wrap:anywhere]">404 / Not
                            Found</h4>
                        <p class="nui-text-500 font-sans text-xs font-medium">Ôi không!, đơn hàng bạn đang cố tìm hiện
                            đã mất tích,
                            chắc nó thấy bạn ế lâu năm quá nên trốn mất tiêu rồi !!!</p>
                    </div>
                </div>
                <div class="mt-6 p-2 text-center">
                    <img class="notfound-img pointer-events-none select-none mx-auto"
                        src="/<?=__IMG__?>/main/no-found.png" alt="Not Found">
                </div>
                <div class="flex justify-center mt-4">
                    <button type="button" data-target-href="/danh-muc/ma-nguon"
                        class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-default nui-button-shadow">
                        <i class="ri-arrow-left-line me-2"></i>Quay lại
                    </button>
                </div>
            </div>
        </div> -->
        <?php endif; ?>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>