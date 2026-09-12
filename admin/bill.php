<?php include 'partials/head.php';?>
<?php include 'partials/nav.php';?>
<div class="check-rotate-support"></div>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Lịch Sử Tạo Bill</h3>
                            <div class="nk-block-des text-soft">
                                <p>Bạn có thể quản lý và xem lịch sử tạo bill tại đây.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="drodown">
                                <a href="javascript:;" class="dropdown-toggle btn btn-white btn-dim btn-outline-warning"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <em class="d-none d-sm-inline ri-menu-2-line me-1"></em>
                                    <span>
                                        <span class="d-none d-md-inline"></span>Tinh Chỉnh Bill </span>
                                    <em class="dd-indc icon ni ni-chevron-right"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li>
                                            <a data-bs-toggle="modal" href="#setLimitBill">
                                                <span><i class="ri-add-line me-1 fs-17px text-success"></i>Chỉnh Limit &
                                                    Giá Bill</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="truncate-all-bill">
                                                <span><i class="ri-close-large-line me-1 text-danger"></i>Xoá All Lịch
                                                    Sử</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" href="#setTimeMakeBill">
                                                <span><i class="ri-timer-line text-primary me-1 fs-16px"></i>Chỉnh Thời
                                                    Gian</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="modal" href="#setAutoDeleteBill">
                                                <span><i class="ri-delete-bin-line text-warning me-1 fs-14px"></i>Tự
                                                    Động Xoá Lịch Sử</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">
                        <?php
                    foreach ($ThongKeTaoBill as $bill) {?>
                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="project">
                                        <div class="project-head">
                                            <a class="project-title">
                                                <div class="user-avatar sq">
                                                    <img src="../assets/img/calendar.png" alt="">
                                                </div>
                                                <div class="project-info">
                                                    <h6 class="title">Tổng Mua <?=$bill['title']?></h6>
                                                    <span class="sub-text"><?=$bill['title']?></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="project-details">
                                            <p><?=$bill['desc']?></p>
                                        </div>
                                        <div class="project-meta">
                                            <span class="badge badge-dim <?=$bill['class']?> badge-sm">
                                                <i class="ri-line-chart-line me-1"></i>
                                                <span><b><?=$bill['tongmua']?></b> lượt mua</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="dt-bootstrap4 no-footer">
                                <div class="datatable-wrap p-4">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist no-footer">
                                        <?php
                                /**
                                * @author Vương Thanh Diệu
                                */
                                class DanhSachTaoBill extends DatabaseConnection 
                                 {
                                    public function Show() {
                                        global $cut,$domain,$TD,$taikhoan;
                                        $oOo = mysqli_query(self::ThanhDieuDB(), "
                                        SELECT ws_history_fakebill.*, users.username, users.avatar, users.user_id
                                        FROM ws_history_fakebill
                                        LEFT JOIN users ON ws_history_fakebill.username = users.username
                                        ORDER BY ws_history_fakebill.time DESC
                                    ");
                                     if ($oOo) {?>
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head text-nowrap">
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">STT</span>
                                                </th>
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">Khách Hàng</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb sorting">
                                                    <span class="sub-text">Link Ảnh Bill</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb sorting">
                                                    <span class="sub-text">Ngày Tạo</span>
                                                </th>
                                                <th class="nk-tb-col text-end sorting">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($td = mysqli_fetch_assoc($oOo)) { ?>
                                            <tr class="nk-tb-item odd">
                                                <td class="nk-tb-col nk-tb-col-check sorting_1">
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox notext">
                                                        <?=$td['fakebill_id']?></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-dim-primary d-sm-flex">
                                                            <img class="ws-avatar-1" src="<?=Avatar($td['username'], $td['avatar'])?>"
                                                                alt="">
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead"><a href="#"
                                                                    rel="noopener noreferrer"><?=THANHDIEU(($td['username']===$taikhoan ? 'Bạn' : $td['username']))?></a></span>
                                                            <span>@<?=THANHDIEU($td['username'])?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <a href="/public/cache/bill/<?=$td["image"]?>" target="_blank"
                                                        rel="noopener noreferrer"><span>https://<?=$domain.'/public/cache/bill/'.$cut->characters($td["image"],22)?></span></a>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span><?=FormatTime::TD($td["time"],1)?></span>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <a class="dl-img"
                                                            data-download="/public/cache/bill/<?=$td["image"]?>"
                                                            data-name-site="<?=$TD->Setting('name-site');?>"
                                                            data-bill-id="<?=$td['fakebill_id'];?>"
                                                            href="javascript:;"><span
                                                                class="badge badge-dim bg-warning tb-status"
                                                                style="font-size:.675rem!important;">
                                                                <i class="ri-download-line me-1"></i>
                                                                Download Bill
                                                            </span></a>
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a href="javascipt:;" class="delete-bill"
                                                                                data-bill-id="<?=$td['fakebill_id'];?>"><em
                                                                                    style="margin-top:-3px;"
                                                                                    class="icon ni ni-trash-alt"></em>
                                                                                Xoá Bill Này
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <!-- Cộng Tiền -->
                                            <div class="modal fade" id="cong-tien-<?=$td['user_id'];?>">
                                                <div class="modal-dialog modal-dialog-top" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Cộng Tiền Cho TK
                                                                #<?=$td['username']?>
                                                            </h5>
                                                            <a href="#" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <em class="icon ni ni-cross-sm"></em>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="Cong-Tien" method="post"
                                                                class="form-validate is-alter">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="hidden" name="action"
                                                                            value="cong-tien">
                                                                        <input type="hidden" name="taikhoan"
                                                                            value="<?=$td['username']?>">
                                                                        <input type="text" class="form-control"
                                                                            name="sotien"
                                                                            placeholder="Vui lòng nhập số tiền cần cộng..."
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-primary"><em
                                                                            class="icon ni ni-plus-sm"></em>&nbsp;Cộng
                                                                        Tiền</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <span class="sub-text">Made by <b>ThanhDieuTV</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </tbody>
                                        <?php } else { ?>
                                        <tr>
                                            <td colspan="8">Chưa có dữ liệu.</td>
                                        </tr>
                                        <?php }
                                         }
                                        }
                                        (new DanhSachTaoBill())->Show();
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
<div class="modal fade" id="setLimitBill">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh Giới Hạn & Số Tiền Tạo Bill</h5>
                <a href="#close" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter set-limit-bill">
                    <input type="hidden" name="action" value="set-limit-bill">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" data-search="off" name="limit-bill" data-ui="clean">
                                <option value="0" <?= $TD->Setting('limit-bill') == 0 ? 'selected' : '' ?>>Không cho
                                    khách hàng tạo bill free</option>
                                <?php for ($i = 1; $i <= 50; $i++) { ?>
                                <option value='<?=$i?>' <?= $i == $TD->Setting('limit-bill') ? 'selected' : '' ?>>
                                    <?=$i?> lần tạo bill free/ngày
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <div class="form-text-hint">
                                <span class="overline-title">VND</span>
                            </div>
                            <input type="text" class="form-control ws-sotien" name="giataobill"
                                placeholder="Nhập số tiền cho mõi bill tạo..."
                                value="<?=FormatNumber::TD($TD->Setting('giataobill'))?>đ" autofocus="">
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
<div class="modal fade" id="setTimeMakeBill">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh Thời Gian Tạo Bill</h5>
                <a href="#close" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    <em class="icon ni ni-alert-circle"></em>
                    <strong>Lưu Ý:</strong> thời gian tạo bill là thời gian mà khách hàng vừa mới tạo tài khoản và cần
                    chờ bao lâu để tạo được bill free, được tính theo tiếng (giờ/hour), nếu bạn nhập 0 thì khách hàng
                    vừa tạo acc là có thể tạo được bill, 0h-23h.
                </div>
                <form class="form-validate is-alter set-time-bill">
                    <input type="hidden" name="action" value="set-time-bill">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="time-bill"
                                placeholder="Nhập thời gian mà bạn muốn giới hạn..."
                                value="<?=$TD->Setting('time-bill')?>" autofocus="">
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
<div class="modal fade" id="setAutoDeleteBill">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tự Động Xoá Lịch Sử&ensp;<span
                        data-slider-count="<?=$TD->Setting('auto-delete')?> ngày"
                        class="badge rounded-pill bg-outline-light"></span> </h5>
                <a href="#close" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter set-time-delete-bill">
                    <input type="hidden" name="action" value="set-time-delete-bill">
                    <div class="form-group">
                        <p>Chỉ định thời gian tự động xoá all lịch sử tạo bill theo định kỳ, để tối ưu và giải phóng bộ
                            nhớ trang web,<b class="text-danger"> nếu set là 0 ngày</b> thì lịch sử tạo bill sẽ <b
                                class="text-warning"> xoá ngay lặp tức</b>.</p>
                        <div class="form-control-wrap my-4">
                            <div class="form-control-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr"
                                data-tooltip="true" data-min="0" data-max="7"
                                data-start="<?=$TD->Setting('auto-delete')?>" id="auto-delete">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Made by <b>ThanhDieuTV</b></span>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/foot.php'; ?>