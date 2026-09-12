<?php $options_header = ['title' => 'Hệ Thống Website Fakebill Màn Hình Khoá Biến Động Số Dư']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<!-- / Bill Màn Hình Khoá / -->
<div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
    <div>
        <h3 class="nui-heading nui-heading-lg nui-weight-semibold nui-lead-tight text-muted-800 dark:text-muted-100 mb-1">
            <span>Fake Bill Màn Hình Khoá</span>
        </h3>
    </div>
</div>
<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6">
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/mb-bank">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/mbbank2.png" alt="Logo Binance" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>MB Bank</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MB Bank','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/acb">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/acb.png" alt="Logo ACB" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>ACB</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'ACB','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/momo">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/momo.png" alt="Logo Momo" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Momo</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Momo','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/binance">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/menu/binance.png" alt="Logo Binance" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Binance</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Binance','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/vietcombank">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/vietcombank.png" alt="Logo Vietcombank" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Vietcombank</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vietcombank','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/zalopay">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/zalopay.png" alt="Logo Zalopay" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Zalopay</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Zalopay','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/zlpay">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/zalopay.png" alt="Logo Zalopay" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Zalopay (loại 1)</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Zalopay1','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/bidv">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/bidv.png" alt="Logo BIDV" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>BIDV</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'BIDV','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/sacombankpay">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/sacombank.png" alt="Logo SacomBankPay" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Sacombank Pay</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'SacombankPay','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/vietinbank">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/vietinbank.png" alt="Logo Vietinbank" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>VIetinbank IPay</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vietinbank','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/techcombank">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/techcombank.png" alt="Logo Techcombank" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Techcombank</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Techcombank','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/vib">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/vib.png" alt="Logo VIB" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>VIB</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'VIB','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/msb">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/msb.png" alt="Logo MSB" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>MSB</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MSB','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/tpbank">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/tpbank.png" alt="Logo TP Bank" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>TP Bank</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'TPBank','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/man-hinh-khoa/agribank">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/bank/agribank.png" alt="Logo Agribank" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Agribank</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Agribank','type' => 'Màn Hình Khoá']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>