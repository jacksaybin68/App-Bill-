<?php $options_header = ['title' => 'Trang Thuê Gói Thành Viên VIP']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="mx-auto w-full max-w-6xl-none pb-4">
        <div class="mb-8 flex flex-col justify-between md:flex-row md:items-center">
            <div
                class="ltablet:max-w-full flex max-w-[425px] flex-col items-center gap-4 text-center md:flex-row md:text-left lg:max-w-full">
                <div class="nui-avatar nui-avatar-lg nui-avatar-rounded-full">
                    <div class="nui-avatar-inner">
                        <img src="/<?=__IMG__?>/icon/front-pages/badgesroll.gif" class="nui-avatar-img nui-avatar-rounded-full">
                    </div>
                </div>
                <div>
                    <h2
                        class="nui-heading nui-heading-xl nui-weight-light nui-lead-tight text-muted-800 dark:text-white">
                        <span class="font-bold">Mua Gói VIP</span>
                    </h2>
                    <p class="nui-paragraph nui-paragraph-md nui-weight-normal nui-lead-normal">
                        <span class="text-muted-500"> Sở hữu nhiều đặc quyền khi mua gói thành viên / hãy chọn gói phù hợp với nhu cầu của bạn</span>
                    </p>
                    <p class="nui-paragraph nui-paragraph-md nui-weight-normal nui-lead-normal">
                        <span class="text-muted-500"><b>Chỉ đăng nhập 1 thiết bị, nếu có nhu cầu mua gói cho công ty vui lòng liên hệ @BILLVIET88</span></b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="md:flex items-center justify-center thanhdieu-refresh">
    <div class="grid grid-cols-1<?=($thanhdieudb->query("SELECT * FROM ws_dsgoi")->num_rows > 0 ? ' sm:grid-cols-2 lg:grid-cols-3' :null)?> gap-<?=isMobile() ? 0 : 16?>">
    <?php 
    $OoO = $thanhdieudb->query("SELECT * FROM ws_dsgoi");
    if ($OoO->num_rows > 0) 
    {
        $userPlan = $plans->TD('tengoi', $taikhoan) ?? null;
        while ($data = $OoO->fetch_assoc()) 
        {
            $ds = new DanhSachGoi($data, $userPlan); 
        ?>
        <div class="plans-card">
            <div class="nui-card nui-card-rounded-sm nui-card-default p-4 border-none thanhdieu-border-card popular">
                <div class="flex flex-col py-2">
                    <div class="mx-auto">
                        <div class="nui-avatar-inner vip-color">
                            <img src="/<?=__IMG__?>/main/vip/<?=$ds->id?>.png" class="icon-vip">
                        </div>
                    </div>
                    <div class="mx-auto mb-4 max-w-xs text-center">
                        <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-normal mt-4 text-primary-600"
                            tag="h2">
                            <span class="font-bold fs-27px"><?=$ds->tengoi?></span>
                        </p>
                        <span
                            class="px-1 nui-heading nui-heading-lg nui-weight-medium nui-lead-none"><?=FormatNumber::TD($ds->giagoi)?>đ</span><span
                            class="text-muted-400 text-sm">/<?=FormatHsdGoi(FormatNumber::PREG($ds->hansudung))?></span>
                    </div>
                </div>
                <div class="mx-auto max-w-sm">
                    <p class="flex items-center mb-2 text-primary-500 font-bold">
                            <span class="nui-button-icon nui-button-rounded-full nui-button-small nui-button-primary plan-text">
                                <i class="ri-check-line"></i>
                            </span>&ensp;VIP 3 trở lên mở khóa fake giấy tờ
                        </p>
                    <p class="flex items-center mb-2 text-primary-500 font-bold">
                        <span
                            class="nui-button-icon nui-button-rounded-full nui-button-small nui-button-primary plan-text">
                            <i class="ri-check-line"></i>
                        </span>&ensp;Không có watermark
                    </p>
                    <p class="flex items-center mb-2 text-primary-500 font-bold">
                        <span
                            class="nui-button-icon nui-button-rounded-full nui-button-small nui-button-primary plan-text">
                            <i class="ri-check-line"></i>
                        </span>&ensp;<?=$ds->gioihanbill?>
                    </p>
                    <p class="flex items-center mb-2 text-primary-500 font-bold">
                        <span
                            class="nui-button-icon nui-button-rounded-full nui-button-small nui-button-primary plan-text">
                            <i class="ri-check-line"></i>
                        </span>&ensp;Tạo Bill chất lượng Full HD
                    </p>
                    <p class="flex items-center mb-2 text-primary-500 font-bold">
                        <span
                            class="nui-button-icon nui-button-rounded-full nui-button-small nui-button-primary plan-text">
                            <i class="ri-check-line"></i>
                        </span>&ensp;Hạn sử dụng: <?=$ds->hansudung?>
                    </p>
                    <div class="mt-6 flex items-center justify-between gap-2">
                        <?= $ds->render() ?>
                    </div>
                </div>
            </div>
        </div>   
        <?php
        } ?>
    <?php 
   } else { ?>
    <div class="nui-placeholder-page nui-placeholder-xs flex items-center justify-center">
        <div class="nui-placeholder-page-inner flex flex-col items-center text-center select-none">
            <div class="nui-placeholder-page-img pointer-events-none">
                <img class="block dark:hidden" src="/<?=__IMG__?>/icon/front-pages/shop-null.png" alt="No Shop">
                <img class="hidden dark:block" src="/<?=__IMG__?>/icon/front-pages/shop-null.png" alt="No Shop">
            </div>
            <div class="nui-placeholder-page-content">
                <h4 class="nui-heading nui-heading-xl nui-weight-medium nui-lead-normal nui-placeholder-page-title">Chưa Mở Shop Thuê Gói</h4>
                <p class="nui-placeholder-page-subtitle">Xin lỗi vì sự bất tiện, có vẻ như chủ sở hữu trang web vẫn chưa triển khai chức năng thuê gói.</p>
            </div>
        </div>
    </div>
    <?php } ?>
    <!---->
    </div>
    </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>