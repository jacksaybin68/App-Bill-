<div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
    <div>
        <h3
            class="nui-heading nui-heading-lg nui-weight-semibold nui-lead-tight text-muted-800 dark:text-muted-100 mb-1">
            <span>
                <?php
                if (strpos($current_url, 'fake-bill-chuyen-khoan')!==false) 
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
            class="nui-button-action <?=(strpos($current_url, 'fake-bill-chuyen-khoan')!==false) ? 'nui-button-primary' : 'nui-button-default';?> nui-button-rounded-lg bill-transfer">
            <?php if (strpos($current_url, 'fake-bill-chuyen-khoan')!==false): ?>
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


<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6 <?php if (strpos($current_url, 'fake-bill-chuyen-khoan')===false): ?>hidden<?php endif;?>"
    id="bill-chuyen-khoan">
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/mb-bank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/mbbank2.png" alt="Logo Mbbank" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>MB Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MB Bank','type' => 'Chuyển Khoản']);?> bill</p>
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
            <a href="javascript:;" data-target-href="/fake-bill/mb-bank-don-luu">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/mbbank.png" alt="Logo Mbbank" class="nui-avatar-img rounded-lg">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>MB Bank (Đơn Lưu)</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MB Bank','type' => 'Đơn Lưu']);?> bill</p>
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
            <a href="javascript:;" data-target-href="/fake-bill/mb-bank-tet">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/mb-tet.png" alt="Logo Mbbank" class="nui-avatar-img rounded-lg">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>MB Bank (Nền Tết)</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MB Bank Tết','type' => 'Chuyển Khoản']);?> bill</p>
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
            <a href="javascript:;" data-target-href="/fake-bill/vietcombank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vietcombank.png" alt="Logo Vietcombank"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Vietcombank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vietcombank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Ngoại Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/vietcombank-new">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vietcombank.png" alt="Logo Vietcombank New"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Vietcombank New</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vietcombank-New','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Ngoại Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/techcombank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/techcombank.png" alt="Logo Techcombank"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Techcombank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Techcombank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Kỹ Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/vietinbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vietinbank.png" alt="Logo Vietinbank"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Vietinbank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vietinbank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Công Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/vietinbank-1">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vietinbank.png" alt="Logo Vietinbank"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Vietinbank (Nền Đỏ)</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vietinbankred','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Công Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/acb">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/acb.png" alt="Logo Acb" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>ACB</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'ACB','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Á Châu</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/acb-new">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/acbbank.png" alt="Logo Acb" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>ACB New</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'ACB-New','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Á Châu</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/momo">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/momo.png" alt="Logo Momo" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Ví Momo (Liên Bank)</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Ví Momo','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ví điện tử Momo</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/zalopay">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/zalopay.png" alt="Logo Zalo Pay" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Zalo Pay</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Ví Zalopay','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ví điện tử ZaloPay</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/agribank">
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
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Agribank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Nông nghiệp</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/msb">
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
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MSB','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Hàng Hải</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/tp-bank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/tpbank2.jpg" alt="Logo TP Bank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>TP Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'TP Bank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Tiên Phong</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
     <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/tp-bank-new">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/tpbank2.jpg" alt="Logo TP Bank New"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>TP Bank New</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'TP Bank New','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Tiên Phong</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/vp-bank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vpbank-neo.png" alt="Logo VP Bank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>VP Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'VP Bank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Thịnh Vượng</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/cake">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="//i.ibb.co/jksKBzC3/unnamed.png" alt="Logo Cake"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>CAKE</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Cake','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Thịnh Vượng</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/bvbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://www.saokim.com.vn/wp-content/uploads/2023/02/Bieu-Tuong-Logo-Ngan-Hang-Ban-Viet.png" alt="Logo BVBank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>BV Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'BVBank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Thịnh Vượng</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/seabank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="//i.ibb.co/vvJBHDrS/unnamed.png" alt="Logo Seabank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Sea Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Seabank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Thịnh Vượng</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/bacabank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="//i.ibb.co/YTFQV6mR/bacabank.png" alt="Logo BacABank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Bắc Á Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Bacabank','type' => 'Chuyển Khoản']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Thịnh Vượng</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/viettel-money">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/viettel-money.png" alt="Logo Viettelmoney"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Viettel Money</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Viettel Money','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/hdbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/hdbank.png" alt="Logo HDBank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>HD Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Hdbank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/vibbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vib.png" alt="Logo VibBank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>VIB</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'VibBank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/vietbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vietbank.png" alt="Logo VietBank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Viet Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'VietBank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/bidv">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/bidv2.png" alt="Logo BIDV"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>BIDV</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'BIDV','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/liobank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="//i.ibb.co/jk5BR9G7/unnamed.png" alt="Logo Liobank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Liobank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Liobank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/shinhanbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/shinhanbank.png" alt="Logo Shinhanbank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Shinhanbank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Shinhanbank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/pgbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/pgb.png" alt="Logo Pg Bank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>PGBank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'PGBank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/sacombank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/sacombank.png" alt="Logo Sacombank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Sacombank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Sacombank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/worri">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="//i.ibb.co/sdCb1cS6/simbolo-woori-bank-Prancheta-1.webp" alt="Logo Worri"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Woori</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Worri','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/namabank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/4/45/Nam_A_Bank_Logo.jpg" alt="Logo Nam Á Bank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Nam Á Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Namabank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/pvbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://files.catbox.moe/cqmhum.png" alt="Logo PV Bank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>PV Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'PVBank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/ocb">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/ocb.png" alt="Logo OCB"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>OCB</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'OCB','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/chinhsachxahoi">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://files.catbox.moe/3gkow0.png" alt="Logo Chính sách xã hội"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Chính Sách Xã Hội</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Chính sách xã hội','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/eximbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://files.catbox.moe/xg4uka.png" alt="Logo Eximbank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Eximbank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Eximbank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/saigonbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/sg-bank.png" alt="Logo Saigonbank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Saigonbank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Saigonbank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/abbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://play-lh.googleusercontent.com/DPT0tkkufSaDOyToT-tA3GVKj1b6_b7fWBt27NHebdVhkqTemHJKOntP5sIKkb6zFN8" alt="Logo ABBank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>ABBank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'ABBank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/ncb">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/ncb-bank.png" alt="Logo NCB"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>NCB</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'NCB','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/lpbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://cdn6.aptoide.com/imgs/f/f/8/ff8fd642bcd571a2fa6f9b308a463658_icon.png" alt="Logo LP Bank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Liên Việt Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'LP Bank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/kienlongbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://kienlongbank.com/Data/Sites/1/media/logo-klb/logo-kienlongbank-favicon.png" alt="Logo Kiên Long Bank"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Kiên Long Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'KienLongBank','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bill/shb">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="https://play-lh.googleusercontent.com/v5oiUb9OH80qpTRgcKPpXHkqmkO5MAZfxldamoCPCbdUMOruCabujukSJmXF2FK3hco" alt="Logo SHB"
                                class="nui-avatar-img rounded-md">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>SHB</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'SHB','type' => 'Chuyển Khoản']);?> bill</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- / End Col -->
</div>
</div>
<!-- / Bill Số Dư / -->
<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6 <?php if (strpos($current_url, 'fake-so-du')===false): ?>hidden<?php endif;?>"
    id="bill-so-du">
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/vietinbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vietinbank.png" alt="Logo Vietinbank"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Vietinbank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vietinbank','type' => 'Số Dư']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Công Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/techcombank">
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
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Techcombank','type' => 'Số Dư']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Techcombank</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/momo">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/momo.png" alt="Logo Momo" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Ví Momo</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Ví Momo','type' => 'Số Dư']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ví điện tử Momo</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/mb-bank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/mbbank2.png" alt="Logo Momo" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>MB Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MB Bank','type' => 'Số Dư']);?> bill</p>
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
            <a href="javascript:;" data-target-href="/fake-so-du/zalopay">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/zalopay.png" alt="Logo Momo" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Zalo Pay</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Ví Zalo Pay','type' => 'Số Dư']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ví điện tử ZaloPay</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/acb">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/acb.png" alt="Logo Acb" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>ACB</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'ACB','type' => 'Số Dư']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Á Châu</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/cake">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="//i.ibb.co/jksKBzC3/unnamed.png" alt="Logo Cake"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>CAKE</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Cake','type' => 'Số Dư']);?> bill</p>

                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/agribank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/agribank.png" alt="Logo Agribank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Agribank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Agribank','type' => 'Số Dư']);?> bill</p>

                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/tpbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/tpbank.png" alt="Logo Tpbank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>TP Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'TPbank','type' => 'Số Dư']);?> bill</p>

                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/vpbank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vpbank.png" alt="Logo Vpbank"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>VP Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'VPBank','type' => 'Số Dư']);?> bill</p>

                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-so-du/vietcombank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/vietcombank.png" alt="Logo vcb"
                                class="nui-avatar-img rounded-full">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Vietcombank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Vcb','type' => 'Số Dư']);?> bill</p>

                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- / Bill Biến Động / -->
<div class="grid lg:grid-cols-5 md:grid-cols-1 gap-6 mt-6 select-none mb-6 <?php if (strpos($current_url, 'fake-bdsd')===false): ?>hidden<?php endif;?>"
    id="bill-bien-dong">
    <div class="col-bank">
        <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
            <a href="javascript:;" data-target-href="/fake-bdsd/mb-bank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/mbbank2.png" alt="Logo Mbbank" class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>MB Bank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'MB Bank','type' => 'Biến Động']);?> bill</p>
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
            <a href="javascript:;" data-target-href="/fake-bdsd/techcombank">
                <div class="flex flex-col">
                    <div class="nui-avatar nui-avatar-md mx-auto mb-4">
                        <div class="nui-avatar-inner">
                            <img src="/<?=__IMG__?>/icon/bank/techcombank.png" alt="Logo Techcombank"
                                class="nui-avatar-img">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4
                            class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                            <span>Techcombank</span>
                        </h4>
                        <p class="text-muted-400 font-sans fs-14px mt-1">Đã tạo: <?=$Bill->totalCreated(['namebill' => 'Techcombank','type' => 'Biến Động']);?> bill</p>
                        <!-- <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal p-1">
                            <span class="text-muted-400">Ngân hàng Kỹ Thương</span>
                        </p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>