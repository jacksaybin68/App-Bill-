<?php require('partials/head.php');?>
<?php require('partials/nav.php');?>
<div class="nk-content">
    <div class="container-fluid">
        <!-- <div class="container-xl wide-xl"> -->
        <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=$TD->Setting('name-site')?> Dashboard</h3>
                            <div class="nk-block-des text-soft">
                                <p>Chào mừng trở lại <?=$user['username']?>, chúc bạn 1 ngày mới vui vẻ.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a data-bs-toggle="modal" href="#" class="btn btn-icon btn-primary d-md-none">
                                <em class="icon ni ni-plus"></em>
                            </a>
                            <a data-bs-toggle="modal" href="#"
                                class="btn btn-primary d-none d-md-inline-flex">
                                <em class="icon ni ni-plus"></em>
                                <span>BILLVIET</span>
                            </a>
                        </div>
                    </div>
                </div>
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-sm-6 col-xxl-6">
                        <div class="card card-full">
                            <div class="card-inner border-start border-4 border-info">
                                <h5 class="fs-5 text-gray">Doanh Thu Ước Tính ( Đã Tính Admin Cộng Tay )
                                </h5>
                                <h5 class="fs-2 mt-1">
                                <?= FormatNumber::TD($totals->RevenueBank() + $totals->RevenueCard(), 1) ?> VND
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xxl-6">
                        <div class="card card-full">
                            <div class="card-inner border-start border-4 border-info">
                                <h5 class="fs-5 text-gray">Gói VIP Còn HSD
                                </h5>
                                <h5 class="fs-2 mt-1">
                                    <?=$totals->Plans()?>/<?=$totals->AllPlans()?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="nk-block-head">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Phím Tắt Nhanh</h4>
                    </div>
                </div>
            </div> -->
            <!--<div class="nk-block">
                <div class="row g-gs">
                    <div class="col-sm-6 col-xxl-3">
                        <a href="<?=$admin->Path()?>/create/newfeeds">
                            <div class="card card-full bg-anime bg-newfeeds">
                                <div class="card-inner center-content">
                                    <div style="width:50px !important;" class="user-avatar mb-3">
                                        <img src="<?=$admin->Path()?>/assets/img/svg/pen.svg" alt="">
                                    </div>
                                    <h5 class="fs-4 text-boldz">Đăng Bản Tin Mới</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xxl-3">
                        <a href="<?=$admin->Path()?>/users/list">
                            <div class="card card-full bg-anime bg-user">
                                <div class="card-inner center-content">
                                    <div style="width:50px !important;" class="user-avatar mb-3">
                                        <img src="<?=$admin->Path()?>/assets/img/svg/user.svg" alt="">
                                    </div>
                                    <h5 class="fs-4 text-boldz">Quản Lý Thành Viên</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xxl-3">
                        <a href="<?=$admin->Path()?>/manager/payment">
                            <div class="card card-full bg-anime bg-bank">
                                <div class="card-inner center-content">
                                    <div style="width:50px !important;" class="user-avatar mb-3">
                                        <img src="<?=$admin->Path()?>/assets/img/svg/bank.svg" alt="">
                                    </div>
                                    <h5 class="fs-4 text-boldz">Cấu Hình Nạp Tiền</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xxl-3">
                        <a href="<?=$admin->Path()?>/manager/plan">
                            <div class="card card-full bg-anime bg-vip">
                                <div class="card-inner center-content">
                                    <div style="width:50px !important;" class="user-avatar mb-3">
                                        <img src="<?=$admin->Path()?>/assets/img/svg/vip.svg" alt="">
                                    </div>
                                    <h5 class="fs-4 text-boldz">Quản Lý Gói VIP</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>-->
            <div class="nk-block-head">
                <div class="nk-block">
                    <div class="card card-full border-radius-10">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Thông Tin Máy Chủ</h6>
                                </div>
                            </div>
                        </div>
                        <div class="fs-sm">
                            <div class="rounded p-2 text-pulse-light">
                                <ul class="list-group text-dark border-start border-4 rounded-2 border-primary mb-2">
                                    <li class="list-group-item">
                                        <b>Phiên bản PHP: </b> <?=$phpversion?>
                                        <?=(ini_get('safe_mode') ? 'Ổn định' : 'Khá ổn định')?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phiên bản MySQL: </b> <?=$mysqlversion?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>WEB Phần mềm: </b> <?=$serversoftware?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tên Mã Nguồn: </b> Fakebill Lavender - Đã được tinh chỉnh bởi BILLVIET
                                        <!-- V<?=explode('.', $TD->Setting('version-code'))[0];?> -->
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phiên Bản Mã Nguồn: </b> <?=$TD->Setting('version-code')?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
</div>
<?php require_once('partials/foot.php'); ?>