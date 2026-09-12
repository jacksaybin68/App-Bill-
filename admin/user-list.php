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
                            <h3 class="nk-block-title page-title">Danh Sách Thành Viên</h3>
                            <div class="nk-block-des text-soft">
                                <p>Bạn có thể quản lý thành viên của mình tại đây</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a data-bs-toggle="modal" href="#addUser" class="btn btn-icon btn-primary d-md-none">
                                <em class="icon ni ni-plus"></em>
                            </a>
                            <a data-bs-toggle="modal" href="#addUser" class="btn btn-primary d-none d-md-inline-flex">
                                <em class="icon ni ni-plus"></em>
                                <span>Tạo Thành Viên</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-sm-6 col-xxl-3">
                            <div class="card card-full bg-primary">
                                <div class="card-inner">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="fs-6 text-white fw-bold mb-0"><em
                                                class="icon ni ni-users me-1"></em>Tổng Thành Viên</div>
                                    </div>
                                    <h5 class="fs-1 text-white"><?=FormatNumber::TD($totals->Users())?> <small
                                            class="fs-3">Tài Khoản</small>
                                    </h5>
                                    <div class="fs-7 text-white text-opacity-75 mt-1">
                                        bao gồm tất cả tài khoản bị cấm
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xxl-3">
                            <div class="card card-full bg-pink is-dark">
                                <div class="card-inner">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="fs-6 text-white fw-bold mb-0"><i
                                                class="ri-vip-crown-2-line me-1"></i>Tổng Gói Đã Bán</div>
                                    </div>
                                    <h5 class="fs-1 text-white"><?=FormatNumber::TD($totals->AllPlans())?> <small
                                            class="fs-3">Gói</small>
                                    </h5>
                                    <div class="fs-7 text-white text-opacity-75 mt-1">
                                        số lượng gói khách hàng đã mua
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xxl-3">
                            <div class="card card-full bg-info is-dark">
                                <div class="card-inner">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="fs-6 text-white fw-bold mb-0"><i
                                                class="ri-line-chart-line me-1"></i>Tổng Doanh Thu</div>
                                    </div>
                                    <h5 class="fs-1 text-white"><?=FormatNumber::TD($totals->Money())?> <small
                                            class="fs-3">VND</small>
                                    </h5>
                                    <div class="fs-7 text-white text-opacity-75 mt-1">
                                        chỉ tính số dư của thành viên đã nạp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xxl-3">
                            <div class="card card-full bg-danger is-dark">
                                <div class="card-inner">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="fs-6 text-white fw-bold mb-0"><em
                                                class="icon ni ni-na me-1"></em>Thành
                                            Viên Bị Cấm</div>
                                    </div>
                                    <h5 class="fs-1 text-white"><?=FormatNumber::TD($totals->BannedUsers())?> <small
                                            class="fs-3">Đình Chỉ</small>
                                    </h5>
                                    <div class="fs-7 text-white text-opacity-75 mt-1">
                                        có <span class="text-white"><?=$totals->BannedUsers()?></span> tài khoản đã bị
                                        đình
                                        chi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="dt-bootstrap4 no-footer">
                                <div class="datatable-wrap p-4">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist no-footer" id="DataTables_Table_0">
                                <?php
                                /**
                                * @author Vương Thanh Diệu
                                */
                                class DanhSachThanhVien extends DatabaseConnection 
                                 {
                                    public function ShowUsers() {
                                        global $taikhoan;
                                        $oOo = mysqli_query(self::ThanhDieuDB(),"SELECT users.*, ws_plans.tengoi AS plans
                                        FROM users
                                        LEFT JOIN ws_plans ON users.username = ws_plans.taikhoan 
                                        ORDER BY ngaythamgia DESC");
                                        if ($oOo) {?>
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head text-nowrap">
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">User ID</span>
                                                </th>
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">Tài Khoản</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb sorting">
                                                    <span class="sub-text">Số Dư</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Tổng Nạp</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg sorting">
                                                    <span class="sub-text">Gói Đăng Ký</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg sorting">
                                                    <span class="sub-text">Ngày Tham Gia</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg sorting">
                                                    <span class="sub-text">Quyền Hạn</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Trạng Thái</span>
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
                                                        <?=$td['user_id']?></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-dim-primary d-sm-flex">
                                                            <img class="ws-avatar-1" src="<?=Avatar($td['username'], $td['avatar'])?>"
                                                                alt="">
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead"><a
                                                                    href="#"
                                                                    rel="noopener noreferrer"><?=THANHDIEU(($td['username']===$taikhoan ? 'Bạn' : $td['username']))?></a></span>
                                                            <span>@<?=THANHDIEU($td['username'])?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <span class="tb-amount"><?=FormatNumber::TD($td['sodu'])?> <span
                                                            class="currency">VNĐ</span>
                                                    </span>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <span class="tb-amount"><?=FormatNumber::TD($td['tongnap'])?> <span
                                                            class="currency">VNĐ</span>
                                                    </span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <ul class="list-status">
                                                        <!-- <li>
                                                            <?php if(valid_email($td['email'])):?>
                                                            <em class="icon text-success ni ni-check-circle"></em>
                                                            <span>Email</span>
                                                            <?php else: ?>
                                                            <em class="icon text-danger ni ni-cross-circle"></em>
                                                            <span>Email</span>
                                                            <?php endif; ?>
                                                        </li> -->
                                                        <li>
                                                            <?php if($td['plans']):?>
                                                            <em class="icon text-success ni ni-check-circle"></em>
                                                            <span><?=strtoupper($td['plans'])?></span>
                                                            <?php else:?>
                                                            <em class="icon text-danger ni ni-cross-circle"></em>
                                                            <span>Không</span>
                                                            <?php endif; ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span><?=FormatTime::TD($td["ngaythamgia"])?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md text-nowrap">
                                                    <?php if($td['rank']==='admin'):?>
                                                    <span class="badge badge-dim bg-info">Quản Trị Viên</span>
                                                    <?php elseif($td['rank']==='leader'): ?>
                                                    <span class="badge badge-dim bg-primary">Lãnh Đạo</span>
                                                    <?php else: ?>
                                                    <span class="badge badge-dim bg-secondary">Thành Viên</span>
                                                    <?php endif;?>
                                                </td>
                                                <td class="nk-tb-col tb-col-md text-nowrap">
                                                    <?php if($td['banned']==0):?>
                                                    <span class="badge badge-dim bg-success tb-status"
                                                        style="font-size:.675rem!important;">Hoạt
                                                        Động</span>
                                                    <?php else: ?>
                                                    <span class="badge badge-dim bg-danger tb-status"
                                                        style="font-size:.675rem!important;">Đình
                                                        Chỉ</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
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
                                                                            <a href="edit/<?=$td['user_id'];?>">
                                                                                <em class="icon ni ni-edit"></em>
                                                                                <span>Sửa Tài Khoản</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a id="banned-users"
                                                                                data-user-id="<?=$td['user_id'];?>">
                                                                                <em class="icon ni ni-na"></em>
                                                                                <?php if($td['banned']==0):?>
                                                                                <span>Khoá Tài Khoản</span>
                                                                                <?php else: ?>
                                                                                <span>Mở Khoá Tài Khoản</span>
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a id="delete-account"
                                                                                data-username="<?=$td['username'];?>"><em
                                                                                    style="margin-top:-3px;"
                                                                                    class="icon ni ni-trash-alt"></em>
                                                                                Xoá Tài Khoản
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#cong-tien-<?=$td['user_id'];?>"><em
                                                                                    style="margin-top:-3px;"
                                                                                    class="icon ni ni-plus-circle-fill"></em>
                                                                                Cộng
                                                                                Tiền</a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#tru-tien-<?=$td['user_id'];?>"><em
                                                                                    style="margin-top:-3px;"
                                                                                    class="icon ni ni-minus-circle-fill"></em>
                                                                                Trừ
                                                                                Tiền</a>
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
                                                            <h5 class="modal-title">Cộng Tiền Cho TK #<?=$td['username']?>
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
                                                            <span class="sub-text">Made by <b>VietKhanh</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Trừ Tiền -->
                                            <div class="modal fade" id="tru-tien-<?=$td['user_id'];?>">
                                                <div class="modal-dialog modal-dialog-top" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Trừ Tiền #<?=$td['user_id']?>
                                                            </h5>
                                                            <a href="#" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <em class="icon ni ni-cross-sm"></em>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="Tru-Tien" method="post"
                                                                class="form-validate is-alter">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="hidden" name="action"
                                                                            value="tru-tien">
                                                                        <input type="hidden" name="taikhoan"
                                                                            value="<?=$td['username']?>">
                                                                        <input type="text" class="form-control"
                                                                            name="sotien"
                                                                            placeholder="Vui lòng nhập số tiền cần trừ..."
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-primary"><em
                                                                            class="icon ni ni-minus-sm"></em>&nbsp;Trừ
                                                                        Tiền</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <span class="sub-text">Made by <b>VietKhanh</b></span>
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
                                        (new DanhSachThanhVien())->ShowUsers();
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
<div class="modal fade" tabindex="-1" role="dialog" id="addUser">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <div class="alert alert-primary alert-icon"><em class="icon ni ni-alert-circle"></em> <strong>Lưu
                        Ý:</strong> Những dòng có đánh dấu (<b class="fw-bold text-danger">*</b>) là bắt buộc phải nhập,
                    tên tài khoản chỉ là duy nhất, và không thể sửa đổi sau này<br /><br />
                    Phần quyền hạn, đối tác sẽ không có đủ quyền can thiệp vào các phần quan trọng của trang admin, ví
                    dụ cài đặt, sửa thành viên v.v.v</div>
                <h5 class="modal-title"><span class="text-success"><em class="icon ni ni-user-add"></em></span>&ensp;Tạo
                    Thành Viên Mới</h5>
                <form id="TaoThanhVien" method="post" class="mt-4 is-alter form-validate">
                    <input type="hidden" name="TaoThanhVien" value="true">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="username">Tài Khoản (<b
                                        class="fw-bold text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" data-msg="Không được bỏ trống tài khoản"
                                        name="username" placeholder="Tên tài khoản" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password">Mật Khẩu (<b
                                        class="fw-bold text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <input type="password" class="form-control" data-msg="Không được bỏ trống mật khẩu"
                                        name="password" placeholder="Mật khẩu" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="access_key">Access Key (<b
                                        class="fw-bold text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" data-msg="Không được bỏ trống access key"
                                        name="access_key" value="<?=WsRandomString::Key(36)?>" placeholder="Access Key"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Quyền Hạn (<b class="fw-bold text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" name="quyenhan"
                                        data-msg="Không được bỏ trống quyền hạn"
                                        data-placeholder="--- CHỌN QUYỀN HẠN ---" required="">
                                        <option value="">--- CHỌN QUYỀN HẠN ---</option>
                                        <option value="members">Thành Viên</option>
                                        <option value="leader">Lãnh Đạo</option>
                                        <option value="admin">Quản Trị Viên</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button type="submit" class="btn btn-primary"><em
                                            class="icon ni ni-check-circle"></em>&ensp;Tạo Ngay</button>
                                </li>
                                <li>
                                    <a href="#" data-bs-dismiss="modal" class="link link-light"
                                        data-bs-dismiss="modal">Huỷ Bỏ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/foot.php'; ?>