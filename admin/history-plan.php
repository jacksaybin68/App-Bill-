<?php require_once('partials/head.php');?>
<?php require_once('partials/nav.php');?>
<div class="check-rotate-support"></div>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Lịch Sử Mua Gói</h3>
                            <div class="nk-block-des text-soft">
                                <p>+ Hiện có <?=$totals->Plans()?>/<?=$totals->AllPlans()?> gói chưa hết hạn sử dụng.
                                </p>
                            </div>
                        </div>
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                <em class="icon ni ni-more-v"></em>
                            </a>
                            <div class="toggle-expand-content hided" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                        <a data-bs-toggle="modal" href="#add-all-expirad"
                                            class="btn btn-primary add-all-expirad">
                                            <em class="icon ni ni-plus"></em>
                                            <span>Cộng All HSD</span>
                                        </a>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#truncate-all-history-plan"
                                            class="btn btn-danger truncate-history-plans">
                                            <em class="icon ni ni-trash"></em>
                                            <span>Xoá All Gói</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="dt-bootstrap4 no-footer">
                                <div class="datatable-wrap p-4">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist no-footer">
                                        <?php
                                class HistoryPlan extends DatabaseConnection 
                                {
                                    public function Plans() {
                                        global $taikhoan;
                                        $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT 
                                            wp.*, 
                                            u.avatar, 
                                            u.username
                                        FROM 
                                            ws_plans wp
                                       JOIN 
                                            users u ON wp.taikhoan = u.username
                                        ORDER BY 
                                            wp.ngaymua DESC
                                    ");                                                                                     
                                        if ($oOo) {?>
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head text-nowrap">
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">ID</span>
                                                </th>
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">Tài Khoản</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Tên Gói</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg sorting">
                                                    <span class="sub-text">Giá Tiền </span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Ngày Mua</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Ngày Hết Hạn</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Trạng Thái</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Thao Tác</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($pl = mysqli_fetch_assoc($oOo)) { ?>
                                            <tr class="nk-tb-item odd">
                                                <td class="nk-tb-col nk-tb-col-check sorting_1">
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox notext">
                                                        <?=$pl['plans_id']?></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-dim-primary d-sm-flex">
                                                            <img class="ws-avatar-1"
                                                                src="/<?= __IMG__.'/'.$pl['avatar'];?>" alt="">
                                                        </div>
                                                        <div class="user-info">
                                                            <a href="/profile/@<?=$pl['username']?>" target="_blank"
                                                                class="tb-lead"><?=THANHDIEU(($pl['username']===$taikhoan ? 'Bạn' : $pl['username']))?></a>
                                                            <span class="tb-col-md">@<?=THANHDIEU($pl['username'])?></span>
                                                            <span
                                                                class="mt-2 d-md-none badge badge-dim"><?=strtoupper($pl['tengoi'])?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <span
                                                        class="badge badge-dim bg-primary"><?=strtoupper($pl['tengoi'])?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg text-nowrap">
                                                    <span
                                                        class="fs-12px badge badge-dim bg-info"><?=FormatNumber::TD($pl["giatien"],2)?>đ</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg text-nowrap">
                                                    <span
                                                        class="fs-12px badge bg-secondary"><?=FormatTime::TD($pl["ngaymua"],1)?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg text-nowrap">
                                                    <span
                                                        class="fs-12px badge bg-secondary"><?=FormatTime::TD($pl["ngayhethan"],1)?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md text-nowrap">
                                                    <span
                                                        class="badge badge-dim rounded-pill tb-status 
                                                        <?=($pl['trangthai'] == 1) ? 'bg-outline-success' : (($pl['trangthai'] == 2) ? 'bg-outline-warning' : 'bg-outline-danger') ?>">
                                                        <?= ($pl['trangthai'] == 1) ? 'Hoạt Động' : (($pl['trangthai'] == 2) ? 'Tạm Khoá' : 'Đã Hết Hạn') ?>
                                                    </span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg text-nowrap">
                                                    <?php if($pl['trangthai']!==0) {?>
                                                       <a href="#" data-plan-id="<?=$pl['plans_id']?>" class="fs-12px badge banned-plan 
                                                      <?= $pl['trangthai'] == 1 ? 'bg-warning' : ($pl['trangthai'] == 2 ? 'bg-secondary' : 'bg-danger') ?>">
                                                        <i class="ri-<?= $pl['trangthai'] == 1 ? 'lock-2-line' : 'lock-unlock-line' ?> me-1"></i>
                                                        <?= $pl['trangthai'] == 1 ? 'Khoá' : 'Mở Khoá' ?>
                                                    </a>&ensp;
                                                  <?php }?>
                                                    <a href="#" data-plan-id="<?=$pl['plans_id']?>" class="fs-12px badge bg-danger delete-plan"><i
                                                            class="ri-close-line me-1"></i>Xoá</a>
                                                </td>


                                                <?php }?>
                                        </tbody>
                                        <?php }  else { ?>
                                        <tr>
                                            <td colspan="8">Chưa có dữ liệu.</td>
                                        </tr>
                                        <?php }
                                         }
                                        }
                                        (new HistoryPlan())->Plans();
                                     ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-all-expirad">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cộng Thêm Hạn Sử Dụng</h5>
                <a href="#close" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter set-expiration-all-plan">
                    <input type="hidden" name="action" value="set-expiration-all-plan">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" data-search="off" name="hansudung" data-ui="clean">
                                <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <option value='<?=$i?>'>
                                    Cộng thêm <?=$i?> ngày cho tất cả user vip
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary"><em
                                class="icon ni ni-check-circle-cut"></em>&nbsp;Cập Nhật</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Made by <b>ThanhDieuTV</b></span>
            </div>
        </div>
    </div>
</div>
<?php require_once('partials/foot.php'); ?>