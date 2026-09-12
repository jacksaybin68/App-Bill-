<?php $options_header = ['title' => 'Tạo tên miền & tên miền phụ miễn phí', 'description' => 'Hệ thống chúng tôi cung cấp các tên miền có sẵn miễn phí và ổn định mà không cần phải bỏ ra đồng nào.']; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<style>
.dark-style .swal2-container {
    z-index: 2000 !important;
}
</style>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-red-800 fw-light">Công Cụ Hữu Ích / </span>Tạo Subdomain
        </h4>
        <div class="alert alert-warning" role="alert">
            ⚠️ <b>Lưu ý</b>: Nếu sau 30 phút kể từ lúc tạo subdomain xong mà không trỏ đến ip hosting, hệ thống của chúng tôi sẽ cho rằng subdomin đó là spam và sẽ tự động xoá vĩnh viễn khỏi hệ thống.
        </div>
        <div class="row">
            <div class="col-md-5">
                <form class="user-generator-subdomain hk-refresh-form">
                    <div class="card mb-4 thanhdieu-card-bg thanhdieu-border-card">
                        <h5 class="card-header text-red-800">
                            <i class="ri-baidu-line me-2"></i>Tạo Subdomain
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="subdomain" data-limit-text="15" class="form-label">Nhập Tên Miền</label>
                                <input type="text" class="form-control" name="subdomain" placeholder="eg: domain"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="suffix" class="form-label">Chọn Đuôi Tên Miền</label>
                                <select class="form-select thanhdieu-select-mod dangerBox" name="suffix"
                                    aria-label="Chọn Đuôi Tên Miền" required>
                                    <optgroup style="color:red;" label="━ Chọn Đuôi Tên Miền ━">
                                        <option value="wusteam.xyz">➣ wusteam.xyz</option>
                                        <option value="cloudruler.site">➣ cloudruler.site</option>
                                        <option value="spinextra.online">➣ spinextra.online</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="user-generator-subdomain">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-check-line me-2"></i>Xác Nhận
                                    </button>&ensp;
                                    <button type="button" class="btn ButtonV2 clear-form">
                                        <i class="ri-refresh-line me-2"></i>Làm Mới </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <div class="card thanhdieu-card-bg thanhdieu-border-card">
                    <h5 class="card-header text-red-800"><i class="ri-indent-decrease me-2"></i>Quản Lý Tên Miền<span
                            class="total-sms badge badge-center rounded-pill"></span>
                    </h5>
                    <div class="card-datatable table-responsive">
                        <table class="dt-multilingual table text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Miền</th>
                                    <th>Loại</th>
                                    <th>Giá Trị</th>
                                    <th>Ngày Tạo</th>
                                    <th>Trạng Thái</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody class="rl-history-subdomain">
                                <?php
                                $vtd = $thanhdieudb->prepare("SELECT * FROM ws_subdomain WHERE username = ? ORDER BY ngaytao DESC");
                                $vtd->bind_param("s", $taikhoan);
                                $vtd->execute();
                                $WT = $vtd->get_result();
                                if ($WT->num_rows > 0) {
                                    $stt = $WT->num_rows;
                                    while ($w = $WT->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $stt--; ?></td>
                                    <td><a href="//<?=THANHDIEU($w['ten_mien'] . '.' . $w['hauto']);?>"
                                            target="_blank"><?=THANHDIEU($w['ten_mien'] . '.' . $w['hauto']);?></a></td>
                                    <td><?= THANHDIEU($w['loai']); ?></td>
                                    <td><?= ($w['gia_tri'] === '123.45.67.89' ? '<b class="text-red-800">Chưa trỏ dns</b>' : $w['gia_tri']); ?>
                                    </td>
                                    <td><?= FormatTime::TD($w['ngaytao']) ?></td>
                                    <td>
                                        <?php if ($w['trangthai'] === 'active') { ?>
                                        <b class="badge rounded-pill bg-label-success">Hoạt Động</b>
                                        <?php } elseif ($w['trangthai'] === 'banned') { ?>
                                        <b class="badge rounded-pill bg-label-danger">Bị Khoá</b>
                                        <?php } else { ?>
                                        <b class="badge rounded-pill bg-label-warning">Chờ Xử Lý</b>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal"
                                            data-bs-target="#user-edit-subdomain-<?= $w['domain_id'] ?>" href="#"
                                            data-bs-toggle="tooltip" data-bs-original-title="Chỉnh sửa"><span
                                                class="badge badge-center bg-label-info edit-subdomain"><i
                                                    class="ri-pencil-line"></i></span></a>&nbsp;
                                        <a class="user-delete-subdomain" data-suffix-domain="<?= $w['hauto'] ?>"
                                            data-name-domain="<?= THANHDIEU($w['ten_mien'] . '.' . $w['hauto']); ?>"
                                            data-id-domain="<?= $w['domain_id'] ?>" href="#" data-bs-toggle="tooltip"
                                            data-bs-original-title="Xoá"><span
                                                class="badge badge-center bg-label-warning"><i
                                                    class="ri-delete-bin-6-line"></i></span></a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else { ?>
                                <?php if ($isLogin->TD($taikhoan, $user)): ?>
                                <tr>
                                    <td colspan="7" class="dataTables_empty">Chưa có bản ghi tên miền</td>
                                </tr>
                                <?php else: ?>
                                <td colspan="7" class="fw-bold text-center text-red-800">Vui lòng đăng nhập để sử dụng
                                    dịch vụ</td>
                                <?php endif ?>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <?php foreach ($WT as $w): ?>
    <div class="modal fade" id="user-edit-subdomain-<?= $w['domain_id'] ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-<?= (isMobile() ? 'top' : 'centered') ?>">
            <div class="modal-content thanhdieu-card-bg thanhdieu-border-card modalBg">
                <div class="modal-header">
                    <h5 class="modal-title">Edit - <?= THANHDIEU($w['ten_mien'] . '.' . $w['hauto']); ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="user-edit-subdomain">
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            ⚠️ <b>Lưu ý</b>: Tài khoản của bạn sẽ bị khoá vĩnh viễn nếu bạn sử dụng tên
                            miền phụ nhầm mục đích vi phạm pháp luật.<br>
                            ❗IP DNS chính là địa chỉ ip hosting của bạn cần trỏ đến, máy chủ của chúng tôi chỉ hỗ trợ
                            bản ghi A, thời gian cập nhật bản ghi từ 5-30p.
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="type" class="form-label">Loại</label>
                                <select class="form-select thanhdieu-select-mod" name="type" required>
                                    <option value="A">A</option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="ip" class="form-label">IP DNS</label>
                                <input type="text" name="ip" class="form-control"
                                    value="<?= ($w['gia_tri'] === '123.45.67.89' ? '' : $w['gia_tri']); ?>"
                                    placeholder="Nhập ip server cần trỏ..." required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="subdomain"
                            value="<?= THANHDIEU($w['ten_mien'] . '.' . $w['hauto']); ?>">
                        <input type="hidden" name="domain_id" value="<?= THANHDIEU($w['domain_id']) ?>">
                        <input type="hidden" name="suffix" value="<?= THANHDIEU($w['hauto']) ?>">
                        <input type="hidden" name="action" value="user-edit-subdomain">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button class="btn thanhdieuButton" type="submit">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- / Content -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>