<?php $options_header = ['title' => 'Thông Tin Thành Viên VIP']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<?php if(!$isLogin->check()||!$plans->TD('tengoi', $taikhoan)){exit('<meta http-equiv="refresh" content="0; url=/">');}?>
<main class="lg:max-w-[calc(100%_-_280px)] mx-auto">
    <div class="flex items-center justify-center py-<?=isMobile() ? 4 : 20?>">
        <div class="mx-auto w-full max-w-4xl">
            <div class="nui-card nui-card-rounded-sm nui-card-default border-none<?=isMobile() ? '' : '-0'?> shadow-lg">
                <div
                    class="divide-muted-200 dark:divide-muted-700 grid divide-y sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                    <div class="flex flex-col p-8">
                        <div class="nui-avatar nui-avatar-xl nui-avatar-rounded-full mx-auto">
                            <div class="nui-avatar-inner">
                                <img src="<?=Avatar($user['username'], $user['avatar'])?>"
                                    class="nui-avatar-img nui-avatar-rounded-full">
                                <img class="crown3" src="/<?= __IMG__ ?>/icon/menu/premium.webp">
                            </div>
                            <div class="nui-avatar-badge" style="background-color:transparent!important">
                                <img src="/<?= __IMG__ ?>/icon/front-pages/angry-birds.gif" class="nui-badge-img"
                                    alt="">
                            </div>
                        </div>
                        <div class="mx-auto mb-4 max-w-xs text-center">
                            <h2 class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal mt-4">Xin chào <span class="text-primary-500"><?=$taikhoan?></span>, bạn đang là thành viên <?=strtoupper($plans->TD('tengoi', $taikhoan))?> trên nền tảng.</h2>
                        </div>
                        <div class="mx-auto max-w-sm">
                            <div class="nui-card nui-card-rounded-sm nui-card-default p-6" elevated="">
                                <h3
                                    class="nui-heading nui-heading-xs nui-weight-medium nui-lead-normal text-muted-400 mb-2 !text-[0.65rem] uppercase">
                                    Lợi ích của thành viên vip là gì? </h3>
                                <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                  1. Sở hữu đặc quyền xoá quảng cáo trên nền tảng (nếu có).
                                  </p>
                                  <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    2. Bỏ qua việc tạo bill theo số dư, tiết kiệm chi phí. 
                                  </p>
                                  <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    3. Không có watermark, logo dính kèm khi tạo bill.
                                  </p>
                                  <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    4. Tạo số lượng lớn bill, theo nhu cầu của bạn.
                                  </p>
                                  <p
                                    class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400">
                                    5. Mở khoá tất cả tính năng trên nền tảng.
                                  </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col p-8">
                            <p class="nui-heading nui-heading-md nui-weight-medium nui-lead-normal mt-4" tag="h2">
                                Thông Tin Chi Tiết Gói </p>
                            <span
                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-xs">
                                Giới hạn tạo bill không cộng dồn vì vậy mõi ngày cứ đúng 00:00 sẽ làm mới lại số lần tạo về ban đầu.
                            </span>
                            <div class="mt-6">
                                <ul class="space-y-6">
                                    <li class="flex gap-3">
                                        <div
                                            class="border-muted-200 dark:border-muted-600 dark:bg-muted-700 shadow-muted-300/30 dark:shadow-muted-800/20 flex size-9 items-center justify-center rounded-full border bg-white shadow-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon text-success-500 size-4" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal">
                                            Ngày Mua</h3>
                                            <span
                                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-[210px]">
                                                <?=FormatTime::TD($plans->TD('ngaymua', $taikhoan),1)?></span>
                                        </div>
                                    </li>
                                    <li class="flex gap-3">
                                        <div
                                            class="border-muted-200 dark:border-muted-600 dark:bg-muted-700 shadow-muted-300/30 dark:shadow-muted-800/20 flex size-9 items-center justify-center rounded-full border bg-white shadow-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon text-success-500 size-4" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal"> Ngày Hết Hạn</h3>
                                            <span
                                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-[210px]">
                                                <?= (date('Y') - date('Y', strtotime(FormatTime::TD($plans->TD('ngayhethan', $taikhoan), 1)))) > 10 ? '∞/Vĩnh viễn' : FormatTime::TD($plans->TD('ngayhethan', $taikhoan), 1) ?></span>
                                        </div>
                                    </li>
                                    <li class="flex gap-3">
                                        <div
                                            class="border-muted-200 dark:border-muted-600 dark:bg-muted-700 shadow-muted-300/30 dark:shadow-muted-800/20 flex size-9 items-center justify-center rounded-full border bg-white shadow-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon text-success-500 size-4" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal">Giới Hạn Tạo Bill </h3>
                                            <span
                                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-[210px]">
                                               Tổng <b class="text-primary-500"><?= (intval($plans->TD('gioihanbill', $taikhoan)) > 1999) ? '∞' : $plans->TD('gioihanbill', $taikhoan) ?></b> lần tạo/ngày của gói <?= strtoupper($plans->TD('tengoi', $taikhoan)) ?>
</span>
                                        </div>
                                    </li>
                                    <li class="flex gap-3">
                                        <div
                                            class="border-muted-200 dark:border-muted-600 dark:bg-muted-700 shadow-muted-300/30 dark:shadow-muted-800/20 flex size-9 items-center justify-center rounded-full border bg-white shadow-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon text-success-500 size-4" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal">Số Lần Tạo Bill </h3>
                                            <span
                                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-500 dark:text-muted-400 max-w-[210px]">
                                              Còn lại <b class="text-red-500"><?= (max(0, $plans->ConLaiLanTao($taikhoan)) > 1999) ? '∞' : max(0, $plans->ConLaiLanTao($taikhoan)) ?></b> lần tạo hôm nay</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>