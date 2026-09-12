<?php include 'partials/head.php'; ?>
<?php include 'partials/nav.php'; ?>
<?php
/**
 * @author Vương Thanh Diệu
 */
class WsSuaThanhVien extends DatabaseConnection 
{
    private $current_url;

    public function __construct($current_url) 
    {
        $this->current_url = $current_url;
    }
    
    /**
     * Method UserID
     */
    public function UserID() 
    {
        return preg_replace('/[^0-9\-]/','',strtok(basename($this->current_url),'?'));
    }    
    /**
     * Method TDGetUsers
     *
     * @param $userID $userID 
     *
     */
    public function TDGetUsers($userID) 
    {
        $wusTeam = self::ThanhDieuDB()->query("
        SELECT users.*, ws_plans.tengoi AS plans
        FROM users
        LEFT JOIN ws_plans ON users.username = ws_plans.taikhoan AND ws_plans.trangthai = 1
        WHERE users.user_id = $userID
        ");    
        if ($wusTeam && $wusTeam->num_rows > 0) 
        {
            $userData = $wusTeam->fetch_assoc();
            return $userData;
        } else {
            exit('<meta http-equiv="refresh" content="0; url=/admin/users/list">'); 
        }
    }
}
$User = new WsSuaThanhVien($current_url);
$userID = $User->UserID();
$userData = $User->TDGetUsers($userID);
?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Chỉnh Sửa Thành Viên</h3>
                            <div class="nk-block-des text-soft">
                                <p>Bạn có toàn quyền quản lý và chỉnh sửa tài khoản của <b
                                        class="text-primary fw-bold"><?=$userData['username']?></b>.</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered">
                        <div class="card-content">
                            <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">
                                        <em class="icon ni ni-user-circle"></em>
                                        <span>Thông Tin Chung</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="card-inner thanhdieu-refresh">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Thông Tin Tài Khoản</h4>
                                                <div class="nk-block-des">
                                                    <p>Thông tin đầy đủ của người dùng này.</p>
                                                </div>
                                            </div>
                                            <div class="nk-tab-actions me-n1">
                                                <a class="btn btn-icon btn-trigger" data-bs-toggle="modal"
                                                    href="#profile-edit">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">E-mail</span>
                                                <span
                                                    class="profile-ud-value"><?=(filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) ? $userData['email'] : '<span class="text-danger">Chưa xác minh</span>'?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Tài Khoản</span>
                                                <span class="profile-ud-value"><?=$userData['username']?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Trạng Thái</span>
                                                <span
                                                    class="profile-ud-value"><?= ($userData['banned'] == 0) ? '<span class="text-success">Hoạt Động</span>' : '<span class="text-danger">Bị Khoá</span>' ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Mật Khẩu</span>
                                                <span
                                                    class="profile-ud-value"><?=substr($userData['password'], 0,15) . '**********' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-line">
                                        <h6 class="title overline-title text-base">Thông Tin Ví</h6>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Số Dư</span>
                                                <span
                                                    class="profile-ud-value"><?=FormatNumber::TD($userData['sodu'])?>đ</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Tổng Tiêu</span>
                                                <span
                                                    class="profile-ud-value"><?=FormatNumber::TD($userData['tongtieu'])?>đ</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Tổng Nạp</span>
                                                <span
                                                    class="profile-ud-value"><?=FormatNumber::TD($userData['tongnap'])?>đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-line">
                                        <h6 class="title overline-title text-base">Thông Tin Thêm</h6>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Gói Đăng Ký</span>
                                                <span class="profile-ud-value badg">
                                                      <span class="badge rounded-pill badge-dim bg-info">Gói <?=strtoupper($userData['plans'] ?? 'Free')?></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Ngày Đăng Ký</span>
                                                <span
                                                    class="profile-ud-value"><?=FormatTime::TD($userData['ngaythamgia'])?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <div class="align-center flex-wrap flex-sm-nowrap ms-2 p-2">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="dropdown">
                                            Cộng Trừ Tiền&nbsp;
                                            <em class="icon ni ni-chevron-down"></em>
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-end dropdown-menu-auto mt-1 text-nowrap">
                                            <ul class="link-list-plain">
                                                <li>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#cong-tien"><em
                                                            class="icon ni ni-plus-circle-fill"></em> Cộng
                                                        Tiền</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#tru-tien"><em
                                                            class="icon ni ni-minus-circle-fill"></em> Trừ
                                                        Tiền</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>&ensp;
                                    <a onclick="window.history.back();" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Trở về trang trước" class="btn-sm btn btn-light"><em
                                            class="icon ni ni-curve-down-left"></em>&ensp;Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="profile-edit">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">Chỉnh Sửa Thông Tin</h5>
                <form id="editUsers" class="mt-4">
                    <input type="hidden" value="true" name="editUsers">
                    <input type="hidden" value="<?=$userData['user_id']?>" name="user_id">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="editEmail">Email</label>
                                <input type="text" class="form-control" name="editEmail"
                                    placeholder="Nhập email@example.com"
                                    value="<?=(valid_email($userData['email'])) ? $userData['email'] : 'Chưa xác minh'?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="editIP">IP Address</label>
                                <input type="text" class="form-control" name="editIP" disabled
                                    value="<?=$userData['ip'] ?? 'NaN'?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="editSoDu">Số Dư</label>
                                <input type="text" class="form-control ws-sotien" name="editSoDu"
                                    value="<?=FormatNumber::TD($userData['sodu'])?>đ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="editTongNap">Tổng Nạp</label>
                                <input type="text" class="form-control ws-sotien" name="editTongNap"
                                    value="<?=FormatNumber::TD($userData['tongnap'])?>đ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="editTongTieu">Tổng Tiêu</label>
                                <input type="text" class="form-control ws-sotien" name="editTongTieu"
                                    value="<?=FormatNumber::TD($userData['tongtieu'])?>đ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Quyền Hạn</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" data-placeholder="Quyền hạn"
                                        name="editQuyenHan">
                                        <option value="members"
                                            <?php if ($userData['rank'] === 'members') echo 'selected'; ?>>Thành Viên
                                        </option>
                                        <option value="leader"
                                            <?php if ($userData['rank'] === 'leader') echo 'selected'; ?>>Lãnh Đạo
                                        </option>
                                        <option value="admin"
                                            <?php if ($userData['rank'] === 'admin') echo 'selected'; ?>>Quản Trị Viên
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button type="submit" class="btn btn-primary"><em
                                            class="icon ni ni-check-circle"></em>&nbsp;Cập Nhật</button>
                                </li>
                                <li>
                                    <a href="#" class="link link-light" data-bs-dismiss="modal">Đóng</a>
                                </li>
                            </ul>
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- Cộng Tiền -->
<div class="modal fade" id="cong-tien">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cộng Tiền #<?=$userData['user_id']?></h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
            </div>
            <div class="modal-body">
                <form id="Cong-Tien" method="post" class="form-validate is-alter">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="hidden" name="action" value="cong-tien">
                            <input type="hidden" name="taikhoan" value="<?=$userData['username']?>">
                            <input type="text" class="form-control" name="sotien"
                                placeholder="Vui lòng nhập số tiền cần cộng..." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary"><em
                                class="icon ni ni-plus-sm"></em>&nbsp;Cộng Tiền</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Made by <b>ThanhDieuTV</b></span>
            </div>
        </div>
    </div>
</div>
<!-- Trừ Tiền -->
<div class="modal fade" id="tru-tien">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trừ Tiền #<?=$userData['user_id']?></h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
            </div>
            <div class="modal-body">
                <form id="Tru-Tien" method="post" class="form-validate is-alter">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="hidden" name="action" value="tru-tien">
                            <input type="hidden" name="taikhoan" value="<?=$userData['username']?>">
                            <input type="text" class="form-control" name="sotien"
                                placeholder="Vui lòng nhập số tiền cần trừ..." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary"><em
                                class="icon ni ni-minus-sm"></em>&nbsp;Trừ Tiền</button>
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