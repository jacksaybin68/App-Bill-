<?php require_once('partials/head.php');?>
<?php require_once('partials/nav.php');?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Tạo / Sửa Gói VIP</h3>
                            <div class="nk-block-des text-soft">
                                <p>Bạn có thể tạo/sửa/xoá gói theo ý muốn của mình tại đây.<br>
                            </div>
                        </div>
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                <em class="icon ni ni-more-v"></em>
                            </a>
                            <div class="toggle-expand-content hided" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <a data-bs-toggle="modal" href="#addPlan" class="btn btn-primary">
                                            <em class="icon ni ni-plus"></em>
                                            <span>Tạo Gói Mới</span>
                                        </a>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#truncate-all-plans" class="btn btn-danger truncate-plans">
                                            <em class="icon ni ni-trash"></em>
                                            <span>Xoá All Gói</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block thanhdieu-refresh">
                    <div class="row g-gs">
                        <?php
                 class PlansList extends DatabaseConnection 
                {
            public function Plans() 
            {
                global $cut;
                $pl = mysqli_query(self::ThanhDieuDB(), "SELECT ws_dsgoi.*, COUNT(ws_plans.plans_id) AS luotmua
                FROM ws_dsgoi
                LEFT JOIN ws_plans 
                ON ws_plans.tengoi = CONCAT('vip', ws_dsgoi.dsgoi_id)
                GROUP BY ws_dsgoi.dsgoi_id;
                ");
                if ($pl && mysqli_num_rows($pl) > 0) {
                    while ($goi = mysqli_fetch_assoc($pl)) { ?>
                        <div class="col-md-6 col-xxl-3">
                            <div class="card card-bordered pricing text-center">
                                <div class="pricing-body">
                                    <div class="pricing-media">
                                        <img style="filter: hue-rotate(216deg)"
                                            src="/<?= __IMG__ ?>/main/vip/<?=$goi['dsgoi_id']?>.png"
                                            alt="Gói VIP <?=$goi['dsgoi_id']?>">
                                    </div>
                                    <div class="pricing-title w-220px mx-auto">
                                        <h5 class="title">
                                            <?=(isMobile() ? THANHDIEU($goi['tengoi']) : $cut->characters(THANHDIEU($goi['tengoi']),15))?>
                                        </h5>
                                        <span class="sub-text mt-1">Đã có: <?=$goi['luotmua']?> lượt mua</span>
                                    </div>
                                    <div class="pricing-amount">
                                        <div class="amount"><?=FormatNumber::TD($goi['giagoi'])?>đ/<i
                                                class="fs-17px"><?=FormatHsdGoi($goi['hansudung'])?></i></div>
                                        <span class="bill"><b><?=($goi['gioihanbill'] > 1999) ? '<font color="yellow">Vô hạn</font>' : $goi['gioihanbill']?></b> lần tạo
                                            bill/ngày</span>
                                    </div>
                                    <div class="pricing-action">
                                        <a data-bs-toggle="modal" href="#editPlan-<?=$goi['dsgoi_id']?>"
                                            class="btn btn-primary me-1"><i class="ri-edit-line me-1"></i>Sửa
                                            Gói</a>
                                        <?php if ($goi['trangthai'] == 1) { ?>
                                        <a href="#" data-plan-id="<?=$goi['dsgoi_id']?>"
                                            class="btn btn-danger lock-plan"><i class="ri-lock-2-line me-1"></i>Khoá
                                            Gói</a>
                                        <?php } else { ?>
                                        <a href="#" data-plan-id="<?=$goi['dsgoi_id']?>"
                                            class="btn btn-warning lock-plan"><i class="ri-lock-unlock-line me-1"></i>Mở
                                            Khoá</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" tabindex="-1" id="editPlan-<?=$goi['dsgoi_id']?>">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <a href="#" class="close" data-bs-dismiss="modal">
                                        <em class="icon ni ni-cross-sm"></em>
                                    </a>
                                    <div class="modal-body modal-body-md">
                                        <h5 class="modal-title"><em class="icon ni ni-edit me-1"></em>Sửa Gói <b
                                                class="text-success"><?=$goi['tengoi']?> - VIP <?=$goi['dsgoi_id']?></b>
                                        </h5>
                                        <form class="mt-4 re-edit-plan form-validate is-alter">
                                            <input type="hidden" name="action" value="re-edit-plan">
                                            <input type="hidden" name="goi_id" value="<?=$goi['dsgoi_id']?>">
                                            <div class="row g-gs">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="tengoi">Tên Gói <b
                                                                class="text-danger">(*)</b></label>
                                                        <input type="text" class="form-control" name="tengoi"
                                                            value="<?=$goi['tengoi']?>" placeholder="Nhập tên gói..."
                                                            maxlength="20" autofocus="on" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="giagoi">Giá Gói <b
                                                                class="text-danger">(*)</b></label>
                                                        <input type="text" class="form-control ws-sotien" name="giagoi"
                                                            value="<?=FormatNumber::TD($goi['giagoi'])?>đ"
                                                            placeholder="Nhập giá gói..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="hsd">Hạn Sử Dụng <b
                                                                class="text-danger">(*)</b></label>
                                                        <input type="number" class="form-control" name="hsd"
                                                            value="<?=$goi['hansudung']?>"
                                                            placeholder="Nhập hạn sử dụng..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="limit-bill">Số Lần Tạo Bill <b
                                                                class="text-danger">(*)</b></label>
                                                        <input type="number" class="form-control" name="limit-bill" value="<?=$goi['gioihanbill']?>"
                                    placeholder="Nhập số lần giới hạn bill..." required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                        <li>
                                                            <button type="submit" class="btn btn-primary"><em
                                                                    class="icon ni ni-check-circle-cut me-1"></em>Cập
                                                                Nhật</button>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="link link-light"
                                                                data-bs-dismiss="modal">Đóng</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        } else { ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-inner border-start border-4 border-warning">
                                    <div class="align-center flex-wrap flex-md-nowrap g-4">
                                        <div class="nk-block-image w-120px flex-shrink-0">
                                            <img src="../assets/img/svg/vip.svg" alt="">
                                        </div>
                                        <div class="nk-block-content">
                                            <div class="nk-block-content-head px-lg-4">
                                                <h5>Gói hiện đang trống!</h5>
                                                <p class="text-soft">Để bắt đầu kinh doanh, bạn cần có tối thiểu 1 gói
                                                    VIP, hãy nhấn vào <b class="text-primary">Tạo Gói</b> để bắt đầu tạo
                                                    gói đầu tiên của bạn.</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-content flex-shrink-0">
                                            <a data-bs-toggle="modal" href="#addPlan"
                                                class="btn btn-lg btn-outline-primary"><em
                                                    class="icon ni ni-plus me-1"></em>Tạo Gói Ngay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        }
                     }
                     (new PlansList())->Plans();
                      ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="addPlan" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title"><em class="icon ni ni-plus-c me-1"></em>Tạo Gói VIP</h5>
                <div class="alert alert-warning mt-2" role="alert"> <em class="icon ni ni-alert-circle"></em>
                    <strong>Gợi ý:</strong> Hạn sử dụng chỉ được tính theo ngày, ví dụ nếu bạn nhập 30 nó sẽ tính là 1
                    tháng, 365 là 1 năm cứ thế tính theo số ngày muốn tạo (nếu bạn nhập quá 3650 ngày tức là 10 năm nó sẽ được tính là vĩnh viễn).
                </div>
                <form class="mt-4 create-new-plan form-validate is-alter">
                    <input type="hidden" name="action" value="create-new-plan">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tengoi">Tên Gói <b class="text-danger">(*)</b></label>
                                <input type="text" class="form-control" name="tengoi" placeholder="Nhập tên gói..."
                                    maxlength="20" autofocus="on" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="giagoi">Giá Gói <b class="text-danger">(*)</b></label>
                                <input type="text" class="form-control ws-sotien" name="giagoi"
                                    placeholder="Nhập giá gói..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="hsd">Hạn Sử Dụng <b class="text-danger">(*)</b></label>
                                <input type="number" class="form-control" name="hsd" placeholder="Nhập hạn sử dụng..."
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="limit-bill">Số Lần Tạo Bill <b
                                        class="text-danger">(*)</b></label>
                                <input type="number" class="form-control" name="limit-bill"
                                    placeholder="Nhập số lần giới hạn bill..." required>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button type="submit" class="btn btn-primary"><em
                                            class="icon ni ni-check-circle-cut me-1"></em>Tạo Gói</button>
                                </li>
                                <li>
                                    <a href="#" class="link link-light" data-bs-dismiss="modal">Đóng</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('partials/foot.php'); ?>