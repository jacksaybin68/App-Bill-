<?php require $_SERVER['DOCUMENT_ROOT'].'/include/head.php';?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/include/nav.php';?>
<main>
    <div class="container-none">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <div class="bg-primary-800 flex flex-col items-center rounded-2xl p-4 sm:flex-row select-none">
                    <div class="relative h-[168px] w-[280px] shrink-0">
                        <img class="pointer-events-none absolute md:-start-6 -top-20 sm:-start-10"
                            src="https://user-images.githubusercontent.com/74038190/219923809-b86dc415-a0c2-4a38-bc88-ad6cf06395a8.gif" alt="Doctor illustration">
                    </div><!--https://user-images.githubusercontent.com/74038190/219923809-b86dc415-a0c2-4a38-bc88-ad6cf06395a8.gif-->
                    <div class="mt-6 grow sm:mt-0">
                        <div class="text-center sm:text-left">
                            <p class="nui-heading nui-heading-xl nui-weight-semibold nui-lead-normal text-white opacity-90"
                                tag="h1">
                                <span>Chào mừng trở lại <?=$taikhoan?? 'Thành Viên'?></span>
                            </p>
                            <p
                                class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-white opacity-70">
                                <span><b> "Tên miền chính thức: <?=$TD->Setting('name-site')?> | Mọi tên miền khác đều là giả mạo !"</b></span>
                            </p>
                            <div
                                class="mt-6 flex flex-wrap gap-y-6 pb-4 text-center sm:mt-4 sm:gap-x-8 sm:pb-0 sm:text-left">
                                <div class="min-w-[33.3%] sm:min-w-0">
                                    <p
                                        class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-white opacity-70">
                                        <span>Tổng Khách Hàng</span>
                                    </p>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-white opacity-90"
                                        tag="h4">
                                        <span><?=FormatNumber::TD($totals->Users())?> members</span>
                                    </p>
                                </div>
                                <div class="min-w-[33.3%] sm:min-w-0">
                                    <p
                                        class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-white opacity-70">
                                        <span>Giá Bill</span>
                                    </p>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-white opacity-90"
                                        tag="h4">
                                        <span><?= FormatNumber::TD($TD->Setting('giataobill'), 2) ?>đ</span>
                                    </p>
                                </div>
                                <div class="min-w-[33.3%] sm:min-w-0">
                                    <p
                                        class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-white opacity-70">
                                        <span>Máy Chủ</span>
                                    </p>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-white opacity-90"
                                        tag="h4">
                                        <span>Singapore (SG)</span>
                                    </p>
                                </div>
                                <!--<div class="min-w-[33.3%] sm:min-w-0">
                                    <p
                                        class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-white opacity-70">
                                        <span>Tổng Gói Đã Bán</span>
                                    </p>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-white opacity-90"
                                        tag="h4">
                                        <span><?=FormatNumber::TD($totals->AllPlans())?> VIP</span>
                                    </p>
                                </div>
                                -->
                                <!--<div class="min-w-[33.3%] sm:min-w-0 md:block hidden">
                                    <p
                                        class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-white opacity-70">
                                        <span>Cache</span>
                                    </p>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-white opacity-90"
                                        tag="h4">
                                        <span><?=FormatNumber::TD($totals->Logs())?></span>
                                    </p>
                                </div>-->
                                <!--<div class="min-w-[33.3%] sm:min-w-0">
                                    <p
                                        class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-white opacity-70">
                                        <span>Tổng Bill Đã Tạo <i class="ri-information-line" data-nui-tooltip="Chỉ tính tổng lần tạo trong <?=$TD->Setting('auto-delete')?> ngày"></i></span>
                                    </p>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-white opacity-90"
                                        tag="h4">
                                        <span><?=FormatNumber::TD($totals->HistoryFakeBill())?></span>
                                    </p>
                                </div>-->
                                <div class="ptablet:hidden min-w-[33.3%] sm:min-w-0 md:block hidden">
                                    <p
                                        class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal text-white opacity-70">
                                        <span>Thời Gian Hiện Tại</span>
                                    </p>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-white opacity-90"
                                        tag="h4">
                                        <span><?=getFormattedDate();?> GMT+7</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--TREO QUẢNG CÁO-->
        <style>
/*<![CDATA[*/
#overlay{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.7);align-items:center;justify-content:center;z-index:999}
#popup{background-color:#0f172a;padding:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.3);position:relative;z-index:2;animation:fadeIn 0.5s ease-out}
#closeBtn{position:absolute;top:10px;right:10px;cursor:pointer;font-size:30px;color:#555;background-color:#eee;border:none;padding:0px 10px;border-radius:50%;transition:background-color 0.3s;z-index:999;height:38px;line-height:33px;}
#closeBtn:hover{background-color:#ddd}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
@keyframes fadeOut{from{opacity:1}to{opacity:0}}
#popup img{max-width:100%;height:auto;display:block;margin:0 auto}
/*]]>*/
</style>
<div id="overlay">
  <div id="popup">
    <span id="closeBtn" onclick="closePopup()">×</span>
    <img src="https://files.catbox.moe/u0zvev.png" alt="Popup Image"/>
  </div>
</div>
<script>
  //<![CDATA[
  document.addEventListener("DOMContentLoaded", function() {
    if (!sessionStorage.getItem("popupShown")) {
      document.getElementById("overlay").style.display = "flex";
    }
  });
  function closePopup() {
    document.getElementById("overlay").style.display = "none";
    sessionStorage.setItem("popupShown", "true");
  }
  //]]>
</script>
 <!--TREO QUẢNG CÁO-->

        <!-- <div class="container xlol hidden md:block">
            <div class="ltablet:grid-cols-3 sm:grid-cols-2 lg:grid-cols-5 mt-6" id="list-bank-home">
            <?php foreach ($fakebill as $truycapnhanh):?>
                <div class="">
                    <img src="<?=$truycapnhanh['icon']?>" class="banks" alt="">
                </div>
                <?php endforeach;?>
            </div>
        </div> -->
        </br><marquee><b>Giá Bill hiện tại <?= FormatNumber::TD($TD->Setting('giataobill'), 2) ?>đ, cân nhắc thuê gói để sử dụng khi có nhu cầu tạo số lượng lớn. Chúng tôi chỉ hỗ trợ qua Telegram @BILLVIET88, quý khách vui lòng đăng ký kênh thông báo để nhận link khi bị nhà mạng chặn !</b></marquee>
        <div class="grid grid-cols-12 gap-8 mt-6">
            <div class="ltablet:col-span-8 col-span-12 lg:col-span-8">
                <div class="nui-card nui-card-rounded-sm nui-card-default p-6 shadow-lg border-none">
                    <div class="mb-8 flex items-center justify-between">
                        <h3
                            class="nui-heading nui-heading-md nui-weight-semibold nui-lead-tight text-muted-800 dark:text-white">
                            <span>Tạo Bill Chuyển Khoản</span>
                        </h3>
                    </div>
                    <div class="ltablet:grid-cols-3 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($fakebill as $truycapnhanh):?>
                        <div class="nui-card nui-card-rounded-lg nui-card-default p-3 inline-block">
                            <div class="flex w-full items-center gap-2">
                                <div class="nui-avatar nui-avatar-md">
                                    <div class="nui-avatar-inner">
                                        <img src="<?=$truycapnhanh['icon']?>"
                                            class="nui-avatar-img nui-avatar-rounded-full pointer-events-none" <?=$truycapnhanh['stats']==='tpbank' ? 'style="border-radius:50%;"': null?>>
                                    </div>
                                </div>
                                <div>
                                    <p class="nui-heading nui-heading-sm nui-weight-medium nui-lead-normal text-muted-800 dark:text-muted-100"
                                        tag="h3"><?=$truycapnhanh['name']?></p>
                                    <div class="flex items-center justify-center gap-6 sm:justify-start sm:gap-0">
                                        <div
                                            class="text-muted-400 mt-3 flex items-center gap-1 text-left text-xs sm:mt-0 text-red-500">
                                            <svg class="icon size-3" width="1em" height="1em"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M18.122 17.645a7.185 7.185 0 0 1-2.656 2.495 7.06 7.06 0 0 1-3.52.853 6.617 6.617 0 0 1-3.306-.718 6.73 6.73 0 0 1-2.54-2.266c-2.672-4.57.287-8.846.887-9.668A4.448 4.448 0 0 0 8.07 6.31 4.49 4.49 0 0 0 7.997 4c1.284.965 6.43 3.258 5.525 10.631 1.496-1.136 2.7-3.046 2.846-6.216 1.43 1.061 3.985 5.462 1.754 9.23Z" />
                                            </svg>
                                            <span>Hot</span>
                                        </div>
                                        <div class="hidden px-2 sm:block">
                                            <span>·</span>
                                        </div>
                                        <div
                                            class="text-muted-400 mt-3 flex items-center gap-1 text-left text-xs sm:mt-0">
                                            <svg class="icon size-3" width="1em" height="1em" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3" />
                                            </svg>
                                            <span class="font-bold" id="stats-<?=$truycapnhanh['stats']?>">Truy cập ngay</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="nui-dropdown z-20">
                                        <div class="nui-menu">
                                            <a class="nui-context-button nui-focus" href="<?=$truycapnhanh['target']?>"
                                                data-nui-tooltip="Tới trang <?=$truycapnhanh['name']?>">
                                                <span class="nui-context-button-inner">
                                                    <svg class="icon nui-context-icon" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="ptablet:col-span-6 ltablet:col-span-4 col-span-12 lg:col-span-4">
                <div class="nui-card nui-card-rounded-sm nui-card-default p-5 shadow-lg border-none">
                    <div class="mb-8 flex items-center justify-between">
                        <h3
                            class="nui-heading nui-heading-md nui-weight-semibold nui-lead-tight text-muted-800 dark:text-white">
                            <span>Tạo Bill Priority</span>
                        </h3>
                    </div>
                    <div class="mb-2 space-y-5">
                        <?php foreach ($fakebillpriority as $truycapnhanh):?>
                        <div class="flex items-center gap-3">
                            <div class="flex size-10 items-center justify-center">
                                <img src="<?=$truycapnhanh['icon']?>"
                                    class="nui-avatar-img nui-avatar-rounded-full pointer-events-none">
                            </div>
                            <div>
                                <h4
                                    class="nui-heading nui-heading-sm nui-weight-light nui-lead-tight text-muted-800 dark:text-white">
                                    <span><?=$truycapnhanh['name']?></span>
                                </h4>
                                <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal">
                                    <span class="text-muted-400"> Tạo Bill
                                        <?=ucwords(strtolower($truycapnhanh['name']))?></span>
                                </p>
                            </div>
                            <div class="ms-auto flex items-center">
                                <a href="<?=$truycapnhanh['target']?>"
                                    class="nui-button-icon nui-button-rounded-lg nui-button-medium nui-button-default scale-75"
                                    muted="">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        aria-hidden="true" role="img" class="icon size-5" width="1em" height="1em"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7l-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>

                </div>
            </div>
            <!-- <div class="ptablet:col-span-6 ltablet:col-span-4 col-span-12 lg:col-span-6 mb-8">
                <div class="nui-card nui-card-rounded-sm nui-card-default p-5">
                    <div class="mb-8 flex items-center justify-between">
                        <h3
                            class="nui-heading nui-heading-md nui-weight-semibold nui-lead-tight text-muted-800 dark:text-white">
                        <span>Bảng Tin Mới Nhất</span>
                        </h3>
                    </div>
                    <?php
        /**
         * @author Vương Thanh Diệu
         */
        class BangTin extends DatabaseConnection
        {
            public function Show()
            {
                $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT * FROM ws_newfeeds WHERE trangthai !=0 ORDER BY ngaydang DESC");
                if ($oOo) { ?>
                    <div class="nui-slimscroll relative w-full overflow-y-auto newfeeds">
                        <div class="space-y-4">
                            <?php
                            if (mysqli_num_rows($oOo) > 0) {
                                while ($td = mysqli_fetch_assoc($oOo)) { ?>
                            <div
                                class="after:border-muted-300 dark:after:border-muted-600 relative flex pb-8 after:absolute after:start-4 after:top-10 after:h-[calc(100dvh_-_36px)] after:w-px after:border-l after:content-['']">
                                <div
                                    class="border-muted-200 text-muted-400 after:border-muted-300 dark:border-muted-600 dark:bg-muted-700 dark:after:border-muted-600 relative flex size-9 items-center justify-center rounded-full border bg-white shadow-lg after:absolute after:-end-8 after:top-4 after:h-px after:w-5 after:border-t after:content-['']">
                                    <div
                                        class="relative inline-flex size-7 items-center justify-center rounded-full w-10 h-10">
                                        <img src="<?php switch ($td['loai']) 
                                        {
                                        case 'primary':
                                        echo '//i.imgur.com/zE8lYcg.png';
                                        break;
                                        case 'warning':
                                        echo '//i.imgur.com/BU6EAgA.png';
                                         break;
                                        default:
                                         echo '//i.imgur.com/KuUOo2i.png';
                                        }
                                        ?>" class="max-w-full rounded-full object-cover" width="26rem" alt="">
                                    </div>
                                </div>
                                <div class="ms-10">
                                    <h6 class="font-heading text-muted-800 text-sm font-semibold dark:text-white">
                                        <?= THANHDIEU($td['tieude']); ?></h6>
                                    <p class="text-muted-400 font-sans text-sm"><?= nl2br($td['noidung']); ?></p>
                                </div>
                            </div>
                            <?php }
                            } else { ?>
                            <div class="timeline-item timeline-item-transparent">
                                <div class="d-flex flex-wrap">
                                    <div class="overflow-auto">
                                        🔴 Chưa có bảng tin nào
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        $newfeeds = new BangTin();
        $newfeeds->Show();
        ?>
                </div>
            </div> -->
        </div>

</br>
<!--/QUẢNG CÁO-->

<!--/END QUẢNG CÁO-->
        
        <div class="grid gap-6 sm:grid-cols-4 py-5">
            <div class="relative">
                <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
                    <div class="flex flex-col">
                        <div class="nui-avatar nui-avatar-xl mx-auto mb-4">
                            <div class="nui-avatar-inner">
                                <img src="/<?= __IMG__ ?>/icon/front-pages/an-toan.png"
                                    class="nui-avatar-img pointer-events-none">
                            </div>
                        </div>
                        <div class="text-center">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                <span>Độ An Toàn Cao</span>
                            </h4>
                            <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal">
                                <span class="text-muted-400 fs-13px">Chúng tôi tự hào là một trong những dịch vụ an toàn
                                    nhất hiện có.</span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
                    <div class="flex flex-col">
                        <div class="nui-avatar nui-avatar-xl mx-auto mb-4">
                            <div class="nui-avatar-inner">
                                <img src="/<?= __IMG__ ?>/icon/front-pages/uy-tin.png"
                                    class="nui-avatar-img pointer-events-none">
                            </div>
                        </div>
                        <div class="text-center">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                <span>Dịch Vụ Uy Tín</span>
                            </h4>
                            <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal">
                                <span class="text-muted-400 fs-13px">Châm ngôn của nền tảng chúng tôi là luôn đặt uy tín
                                    lên hàng đầu.</span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
                    <div class="flex flex-col">
                        <div class="nui-avatar nui-avatar-xl mx-auto mb-4">
                            <div class="nui-avatar-inner">
                                <img src="/<?= __IMG__ ?>/icon/front-pages/toc-do.png"
                                    class="nui-avatar-img pointer-events-none">
                            </div>
                        </div>
                        <div class="text-center">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                <span>Xử Lý Nhanh</span>
                            </h4>
                            <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal">
                                <span class="text-muted-400 fs-13px">Với hệ thống hoàn toàn tự động, đảm bảo tốc độ xử
                                    lý tốc độ cao.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="nui-card nui-card-rounded-lg nui-card-default p-6 shadow-lg border-none">
                    <div class="flex flex-col">
                        <div class="nui-avatar nui-avatar-xl mx-auto mb-4">
                            <div class="nui-avatar-inner">
                                <img src="/<?= __IMG__ ?>/icon/front-pages/ho-tro.png" class="nui-avatar-img">
                            </div>
                        </div>
                        <div class="text-center">
                            <h4
                                class="nui-heading nui-heading-md nui-weight-bold nui-lead-tight text-muted-800 dark:text-muted-100">
                                <span>Hỗ Trợ 24/7</span>
                            </h4>
                            <p class="nui-paragraph nui-paragraph-xs nui-weight-normal nui-lead-normal">
                                <span class="text-muted-400 fs-13px">Đội ngũ nhân viên hỗ trợ online mọi lúc, mọi nơi
                                    24/7 kể cả ngày lễ.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- <div class="fixed inset-x-0 bottom-6 z-40 mx-auto w-full max-w-[350px]">
            <div
                class="nui-card nui-card-rounded-sm nui-card-default shadow-muted-300/30 dark:shadow-muted-800/30 flex items-center justify-between gap-2 rounded-2xl p-4 shadow-xl">
                <a class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-default"
                    href="/thue-goi">
                    <span>
                        <i class="ri-arrow-left-s-line"></i> Thuê Gói VIP </span>
                </a>
                <a class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-primary"
                    href="/nap-tien/chuyen-khoan">
                    <span>Nạp Tiền Ngay <i class="ri-arrow-right-s-line"></i>
                    </span>
                </a>
            </div>
        </div> -->
</main>
</div>
</div>
<!-- <div
    class="after:bg-primary-600 after:shadow-primary-500/50 dark:after:shadow-muted-800/10 fixed end-[1em] top-[0.6em] z-[90] transition-transform duration-300 after:absolute after:end-0 after:top-0 after:block after:size-12 after:rounded-full after:shadow-lg after:transition-transform after:duration-300 after:content-[''] -translate-y-24">
    <button type="button"
        class="bg-primary-500 shadow-primary-500/50 dark:shadow-muted-800/10 relative z-30 flex size-12 items-center justify-center rounded-full text-white shadow-lg">
        <span class="relative block size-3 transition-all duration-300 -top-0.5">
            <span class="bg-muted-50 absolute block h-0.5 w-full transition-all duration-300 top-0.5"></span><span
                class="bg-muted-50 absolute top-1/2 block h-0.5 w-full transition-all duration-300"></span>
            <span class="bg-muted-50 absolute block h-0.5 w-full transition-all duration-300 bottom-0"></span>
        </span>
    </button>
    <div>
        <div
            class="absolute end-[0.2em] top-[0.2em] z-20 flex items-center justify-center transition-all duration-300 translate-x-0 translate-y-0">
            <label class="nui-theme-toggle nui-theme-toggle-inverted ms-auto"
                for="nui-input-ce4d3451-6e55-4b4d-8852-adf4df9ca537">
                <input type="checkbox" class="nui-theme-toggle-input"
                    id="nui-input-ce4d3451-6e55-4b4d-8852-adf4df9ca537" />
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
                            d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" class="stroke-2"></path>
                    </svg>
                </span>
            </label>
        </div>
        <div
            class="absolute end-[0.2em] top-[0.2em] z-20 flex items-center justify-center transition-all duration-300 translate-x-0 translate-y-0">
            <button type="button"
                class="bg-primary-700 flex size-9 items-center justify-center rounded-full transition-all duration-300">
                <img class="size-7 rounded-full" src="/<?=__IMG__?>/icon/menu/vietnam.png" alt="flag icon" />
            </button>
        </div>
        <div
            class="absolute end-[0.2em] top-[0.2em] z-20 flex items-center justify-center transition-all duration-300 translate-x-0 translate-y-0">
            <a aria-current="page" href="/dashboards#"
                class="router-link-active router-link-exact-active inline-flex size-9 items-center justify-center rounded-full transition-all duration-300">
                <span class="bg-primary-700 flex size-9 items-center justify-center rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="icon size-5 text-white" width="1em" height="1em"
                        viewBox="0 0 256 256">
                        <g fill="currentColor">
                            <path
                                d="M208 192H48a8 8 0 0 1-6.88-12C47.71 168.6 56 139.81 56 104a72 72 0 0 1 144 0c0 35.82 8.3 64.6 14.9 76a8 8 0 0 1-6.9 12"
                                opacity=".2"></path>
                            <path
                                d="M221.8 175.94c-5.55-9.56-13.8-36.61-13.8-71.94a80 80 0 1 0-160 0c0 35.34-8.26 62.38-13.81 71.94A16 16 0 0 0 48 200h40.81a40 40 0 0 0 78.38 0H208a16 16 0 0 0 13.8-24.06M128 216a24 24 0 0 1-22.62-16h45.24A24 24 0 0 1 128 216m-80-32c7.7-13.24 16-43.92 16-80a64 64 0 1 1 128 0c0 36.05 8.28 66.73 16 80Z">
                            </path>
                        </g>
                    </svg>
                </span>
            </a>
        </div>
        <div
            class="absolute end-[0.2em] top-[0.2em] z-20 flex items-center justify-center transition-all duration-300 translate-x-0 translate-y-0">
            <button type="button"
                class="bg-primary-700 flex size-9 items-center justify-center rounded-full transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="icon size-5 text-white" width="1em" height="1em" viewBox="0 0 256 256">
                    <g fill="currentColor">
                        <path
                            d="M112 80a32 32 0 1 1-32-32a32 32 0 0 1 32 32m64 32a32 32 0 1 0-32-32a32 32 0 0 0 32 32m-96 32a32 32 0 1 0 32 32a32 32 0 0 0-32-32m96 0a32 32 0 1 0 32 32a32 32 0 0 0-32-32"
                            opacity=".2"></path>
                        <path
                            d="M80 40a40 40 0 1 0 40 40a40 40 0 0 0-40-40m0 64a24 24 0 1 1 24-24a24 24 0 0 1-24 24m96 16a40 40 0 1 0-40-40a40 40 0 0 0 40 40m0-64a24 24 0 1 1-24 24a24 24 0 0 1 24-24m-96 80a40 40 0 1 0 40 40a40 40 0 0 0-40-40m0 64a24 24 0 1 1 24-24a24 24 0 0 1-24 24m96-64a40 40 0 1 0 40 40a40 40 0oli0-40-40m0 64a24 24 0 1 1 24-24a24 24 0 0 1-24 24">
                        </path>
                    </g>
                </svg>
            </button>
        </div>
    </div>
</div>
</div>
</div>
</div>
<svg id="SvgjsSvg1220" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
    style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
    <defs id="SvgjsDefs1221"></defs>
    <polyline id="SvgjsPolyline1222" points="0,0"></polyline>
    <path id="SvgjsPath1223"
        d="M-1 178.2L-1 178.2C-1 178.2 59.91917566445183 178.2 59.91917566445183 178.2C59.91917566445183 178.2 118.66346553156147 178.2 118.66346553156147 178.2C118.66346553156147 178.2 177.4077553986711 178.2 177.4077553986711 178.2C177.4077553986711 178.2 236.15204526578074 178.2 236.15204526578074 178.2C236.15204526578074 178.2 294.8963351328904 178.2 294.8963351328904 178.2C294.8963351328904 178.2 353.640625 178.2 353.640625 178.2C353.640625 178.2 353.640625 178.2 353.640625 178.2 ">
    </path>
</svg> -->
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>