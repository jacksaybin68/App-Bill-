<?php $options_header = ['title' => 'Hệ Thống Website Fakebill Binance']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<!-- / Bill Binance / -->
<div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
    <div>
        <h3 class="nui-heading nui-heading-lg nui-weight-semibold nui-lead-tight text-muted-800 dark:text-muted-100 mb-1">
            <span>Tạo Bill Sàn Giao Dịch</span>
        </h3>
    </div>
</div>
<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6">
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/sell-binance">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/menu/binance.png" alt="Logo Binance" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Bán Binance</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Binance','type' => 'Bán Binance']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/buy-binance">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/menu/binance.png" alt="Logo Binance" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>Chuyển Binance</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Binance','type' => 'Buy Binance']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-bank">
    <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
        <a href="javascript:;" data-target-href="/fake-bill/okx">
            <div class="flex flex-col">
                <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                    <div class="nui-avatar-inner">
                        <img src="https://files.catbox.moe/wfynhj.png" alt="Logo OKX" class="nui-avatar-img">
                    </div>
                </div>
                <div class="text-center">
                    <h4
                        class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                        <span>OKX</span>
                    </h4>
                    <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'OKX','type' => 'Sàn Giao Dịch']);?> bill</p>
                </div>
            </div>
        </a>
    </div>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>