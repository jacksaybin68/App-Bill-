<?php $options_header = ['title' => 'Nạp Tiền Vào Tài Khoản']; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/include/head.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/include/nav.php'); ?>
<div class="content-wrapper wt-show-log">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-red-800 fw-light">Dịch Vụ /</span> <span class="text-red-800 fw-light">Nạp Tiền /</span>
            Thẻ Cào
        </h4>
        <?php if (!$isLogin->TD($taikhoan, $user)): ?>
        <meta http-equiv="refresh" content="0; url=/oauth/dang-nhap?redirect=<?=urlencode($actual_link)?>">
        <?php endif ?>
        <section class="section-py bg-body first-section-pt">
            <div class="card px-3 thanhdieu-card-bg thanhdieu-border-card">
                <div class="row">
                    <div class="card-body border-end">
                        <h4 class="mb-2">NẠP QUA THẺ CÀO</h4>
                        <p class="mb-0">Để nạp tiền vào tài khoản, quý khách vui lòng nhập đúng mã thẻ và serial cho hệ
                            thống chúng tôi xử lý cộng tiền.</p>
                        <div class="row my-2">
                            <div class="alert alert-info alert-dismissible" role="alert">
                                💵&ensp;Liên hệ cho quản trị viên nếu bạn muốn cần hỗ trợ:&nbsp;<a
                                    href="<?= $TD->Setting('telegram') ?>" target="_blank">Tại đây.</a>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                        <form class="user-charging-card">
                            <div id="naptien">
                                <div class="row g-3 py-2">
                                    <div class="col-md-6">
                                        <label for="loaithe" class="form-label">Chọn Loại Thẻ</label>
                                        <select class="form-select thanhdieu-select-mod dangerBox" name="loaithe"
                                            required>
                                            <optgroup style="color:#f8ff1f;" label="━ NHÀ MẠNG ━">
                                                <option value="" selected>--- Chọn Loại Thẻ ---</option>
                                                <?php foreach ($loaithe as $value => $tenthe): ?>
                                                    <option value="<?= $value ?>">➣ <?= strtoupper($tenthe) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="menhgia" class="form-label">Chọn Mệnh Giá</label>
                                        <select class="form-select thanhdieu-select-mod dangerBox" name="menhgia"
                                            required>
                                            <optgroup style="color:#03ff46;" label="━ MỆNH GIÁ ━">
                                                <option value="" selected>--- Chọn Mệnh Giá ---</option>
                                                <?php foreach ($menhgia as $label => $gia):
                                                    $new_value = $gia - ($gia * 0.10); ?>
                                                    <option value="<?= $label ?>"><?= strtoupper($label) ?> - Nhận
                                                        <?= FormatNumber::TD($new_value) ?>đ
                                                    </option>
                                                    </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="seriel">Số Serial</label>
                                        <div class="input-group input-group-merge form-send-message">
                                            <input type="number" class="form-control" name="serial"
                                                placeholder="Nhập số seri">
                                            <span class="input-group-text">
                                                <i class="ri-clipboard-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="mathe">Mã Thẻ</label>
                                        <div class="input-group input-group-merge form-send-message">
                                            <input type="number" class="form-control" name="mathe"
                                                placeholder="Nhập mã thẻ">
                                            <span class="input-group-text">
                                                <i class="ri-clipboard-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <?php if ($isLogin->TD($taikhoan, $user)): ?>
                                    <input type="hidden" name="action" value="user-charging-card">
                                    <button type="submit" class="btn btn-primary" style="font-family:FzRubikRegular;"><i
                                            class="ri-check-line me-2"></i>Gửi Thẻ Cào</button>
                                <?php endif; ?>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="card thanhdieu-card-bg thanhdieu-border-card mt-4">
            <h5 class="card-header text-red-800">Lịch Sử Nạp Tiền</h5>
            <div class="card-datatable text-nowrap">
                <div id="ThanhDieu_DataTables_Table" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="table-responsive">
                        <table class="datatables-ajax table table-bordered dataTable no-footer text-center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Loại Thẻ</th>
                                    <th>Số Seri</th>
                                    <th>Mã Thẻ</th>
                                    <th>Mệnh Giá</th>
                                    <th>Thời Gian</th>
                                    <th>Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                class LichSuNapThe extends DatabaseConnection
                                {
                                    public function Show()
                                    {
                                        global $taikhoan;
                                        $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT * FROM ws_history_card WHERE taikhoan = '$taikhoan' ORDER BY `thoigian` DESC");
                                        if ($oOo && mysqli_num_rows($oOo) > 0) {
                                            $stt = 1;
                                            while ($td = mysqli_fetch_assoc($oOo)) { ?>
                                                <tr>
                                                    <td><?=$stt++?></td>
                                                    <td><?= strtoupper($td['loaithe'])?></td>
                                                    <td><?= $td['seriel'] ?></td>
                                                    <td><?= $td['mathe'] ?></td>
                                                    <td><?=FormatNumber::TD($td['menhgia'] )?>đ</td>
                                                    <td><?= FormatTime::TD($td['thoigian']) ?></td>
                                                    <td><?php if ($td['trangthai']==='choxuly'){?>
                                                        <b class="badge rounded-pill bg-label-warning">Chờ Xử Lý</b>
                                                    <?php } elseif($td['trangthai']==='thatbai') {?>
                                                        <b class="badge rounded-pill bg-label-danger">Thất Bại</b>
                                                    <?php } else {?>
                                                        <b class="badge rounded-pill bg-label-success">Thành Công</b>
                                                    <?php }?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="7" class="dataTables_empty">Chưa có lịch sử nạp thẻ cào</td>
                                            </tr>
                                        <?php }
                                    }
                                }
                                (new LichSuNapThe())->Show();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>