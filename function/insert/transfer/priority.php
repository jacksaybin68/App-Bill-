<div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
    <div>
        <h3
            class="nui-heading nui-heading-lg nui-weight-semibold nui-lead-tight text-muted-800 dark:text-muted-100 mb-1">
            <span>
                <?php
                if (strpos($current_url, 'fake-bill-priority')!==false) 
                {?>
                Fake Bill Chuyển Khoản
                <?php } elseif (strpos($current_url, 'fake-so-du')!==false) 
                {?>
                Fake Bill Số Dư
                <?php } elseif (strpos($current_url, 'fake-bdsd')!==false) 
                {?>
                Fake Bill Biến Động
                <?php }
                ?>
            </span>
        </h3>
    </div>
    <div class="flex gap-2 sm:justify-end">
        <button type="button" target="bill-chuyen-khoan"
            class="nui-button-action <?=(strpos($current_url, 'fake-bill-priority')!==false) ? 'nui-button-primary' : 'nui-button-default';?> nui-button-rounded-lg bill-transfer">
            <?php if (strpos($current_url, 'fake-bill-priority')!==false): ?>
            <i class="ri-arrow-left-s-line me-1"></i>
            <?php endif;?>
            Bill chuyển khoản
        </button>
        <button type="button" target="bill-so-du"
            class="nui-button-action <?=(strpos($current_url, 'fake-so-du')!==false) ? 'nui-button-primary' : 'nui-button-default';?> nui-button-rounded-lg bill-transfer">
            <?php if (strpos($current_url, 'fake-so-du')!==false): ?>
            <i class="ri-arrow-left-s-line me-1"></i>
            <?php endif;?>
            Bill số dư
        </button>
        <button type="button" target="bill-bien-dong"
            class="nui-button-action <?=(strpos($current_url, 'fake-bdsd')!==false) ? 'nui-button-primary' : 'nui-button-default';?> nui-button-rounded-lg bill-transfer">
            <?php if (strpos($current_url, 'fake-bdsd')!==false): ?>
            <i class="ri-arrow-left-s-line me-1"></i>
            <?php endif;?>
            Bill biến động
        </button>
    </div>
</div>
<!-- / Bill Chuyển Khoản / -->
<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6 <?php if (strpos($current_url, 'fake-bill-priority')===false): ?>hidden<?php endif;?>"
    id="bill-chuyen-khoan">
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill-chuyen-khoan/mb-bank-priority">
                <div class="flex flex-col">
                    <div class="logo-ck-full nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/mb-priority.png" alt="Logo Mbbank Priority" class="">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex items-baseline justify-center space-x-1">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                MB
                            </h4>
                            <span class="text-sm relative -top-1 text-muted-500">&nbsp;|Priority</span>
                        </div>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo:
                            <?=$Bill->totalCreated(['namebill' => 'MB Bank Priority','type' => 'Chuyển Khoản']);?> bill
                        </p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Quân Đội</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill-chuyen-khoan/seabank-premium">
                <div class="flex flex-col">
                    <div class="logo-ck-full nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://i.ibb.co/V03nVSdK/sea.png" alt="Logo Seabank Premium" class="">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex items-baseline justify-center space-x-1">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                Seabank
                            </h4>
                            <span class="text-sm relative -top-1 text-muted-500">&nbsp;|Premium</span>
                        </div>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo:
                            <?=$Bill->totalCreated(['namebill' => 'Seabank Premium','type' => 'Chuyển Khoản']);?> bill
                        </p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Quân Đội</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill-chuyen-khoan/acb-privilege">
                <div class="flex flex-col">
                    <div class="logo-ck-full nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://i.ibb.co/xq9X9J24/acb.png" alt="Logo Acb Privilege" class="">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex items-baseline justify-center space-x-1">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                ACB
                            </h4>
                            <span class="text-sm relative -top-1 text-muted-500">&nbsp;|Privilege</span>
                        </div>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo:
                            <?=$Bill->totalCreated(['namebill' => 'ACB Privilege','type' => 'Chuyển Khoản']);?> bill
                        </p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Quân Đội</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill-chuyen-khoan/vietcombank-priority">
                <div class="flex flex-col">
                    <div class="logo-ck-full nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://i.ibb.co/1ffSPDXc/VCB.png" alt="Logo VCB Priority" class="">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex items-baseline justify-center space-x-1">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                Vietcombank
                            </h4>
                            <span class="text-sm relative -top-1 text-muted-500">&nbsp;|Priority</span>
                        </div>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo:
                            <?=$Bill->totalCreated(['namebill' => 'Vietcombank-Priority','type' => 'Chuyển Khoản']);?> bill
                        </p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Quân Đội</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill-chuyen-khoan/vietcombank-galaxy">
                <div class="flex flex-col">
                    <div class="logo-ck-full nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://i.ibb.co/v6PY2K1R/vcb-glx.png" alt="Logo VCB Galaxy" class="">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex items-baseline justify-center space-x-1">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                Vietcombank
                            </h4>
                            <span class="text-sm relative -top-1 text-muted-500">&nbsp;|Galaxy</span>
                        </div>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo:
                            <?=$Bill->totalCreated(['namebill' => 'VCB-Galaxy','type' => 'Chuyển Khoản']);?> bill
                        </p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Quân Đội</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill-chuyen-khoan/bidv-premier">
                <div class="flex flex-col">
                    <div class="logo-ck-full nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://i.ibb.co/Gfy08tFs/BIDV.png" alt="Logo BIDV Premier" class="">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex items-baseline justify-center space-x-1">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                BIDV
                            </h4>
                            <span class="text-sm relative -top-1 text-muted-500">&nbsp;|Premier</span>
                        </div>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo:
                            <?=$Bill->totalCreated(['namebill' => 'BIDV-Premier','type' => 'Chuyển Khoản']);?> bill
                        </p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Quân Đội</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</div>
<!-- / Bill Số Dư / -->
<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6 <?php if (strpos($current_url, 'fake-so-du')===false): ?>hidden<?php endif;?>"
    id="bill-so-du">
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/mb-bank-priority">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/mbbank.png" alt="Logo Mb Bank"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>MB Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MB Bank Priority','type' => 'Số Dư']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Công Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
<!-- / Bill Biến Động / -->
<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6 <?php if (strpos($current_url, 'fake-bdsd')===false): ?>hidden<?php endif;?>"
    id="bill-bien-dong">
    <div class="nui-placeholder-page-content">
        <p class="nui-placeholder-page-subtitle <?=isMobile() ? '' : 'text-nowrap'?> text-red-500">Hiện chưa tìm thấy
            tạo bill biến động Priority khả dụng, hãy quay lại sau nhé !</p>
    </div>
</div>
</div>