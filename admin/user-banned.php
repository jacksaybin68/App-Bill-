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
                            <h3 class="nk-block-title page-title">Danh Sách Thành Viên Bị Cấm</h3>
                            <div class="nk-block-des text-soft">
                                <p>Tài khoản bị cấm / banned tại đây</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a class="btn btn-icon btn-primary d-md-none" href="/admin/users/list">
                                <em class="icon ni ni-users"></em>
                            </a>
                            <a class="btn btn-primary d-none d-md-inline-flex" href="/admin/users/list">
                                <em class="icon ni ni-users"></em>
                                <span>Dã Sách To Vì</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">Tất Cả Tài Khoản Bị Cấm</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner datatable-wrap table-responsive">
                            <table class="table table-tranx datatable-init thanhdieu-refresh">
                                <?php
                                class WsBannedUsers extends DatabaseConnection
                                {
                                    public function Banned()
                                    {
                                        $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT * FROM users WHERE lev < 0 ORDER BY id DESC");
                                        if ($oOo) { ?>
                                <thead>
                                    <tr class="text-nowrap">
                                        <th scope="col">STT</th>
                                        <th scope="col">Tài Khoản</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Số Dư</th>
                                        <th scope="col">Vai Trò</th>
                                        <th scope="col">Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($user = mysqli_fetch_assoc($oOo)) { ?>
                                    <tr>
                                        <th scope="row"><?=$user['id']?></th>
                                        <td class="fw-bold text-nowrap"><?=THANHDIEU($user['username'])?></td>
                                        <td><?=THANHDIEU($user['email'] ?? '')?></td>
                                        <td class="text-nowrap"><?=FormatNumber::TD($user['sodu'])?>đ</td>
                                        <td><span class="badge rounded-pill bg-light"><?=$user['role']?></span></td>
                                        <td><span class="badge rounded-pill bg-danger">Bị Cấm</span></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="8">Không có tài khoản bị cấm.</td>
                                </tr>
                                <?php }
                                    }
                                }
                                (new WsBannedUsers())->Banned();
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('partials/foot.php'); ?>