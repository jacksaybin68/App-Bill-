<div class="nk-sidebar" data-content="sidebarMenu">
    <div class="nk-sidebar-inner" data-simplebar>
        <ul class="nk-menu nk-menu-md">
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">
                    <em class="icon ni ni-home"></em> Dashboard
                </h6>
            </li>
            <li class="nk-menu-item home">
                <a href="<?=$admin->Path()?>/dashboard" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-home"></em>
                    </span>
                    <span class="nk-menu-text">Trang Chủ</span>
                </a>
            </li>

            <li class="nk-menu-hr"></li>

            <!-- === Nhóm QUẢN LÝ NGƯỜI DÙNG === -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-info-alt">
                    <em class="icon ni ni-account-setting-alt"></em> Người Dùng
                </h6>
            </li>
            <li class="nk-menu-item has-sub users">
                <a href="<?=$admin->Path()?>/users/list" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-account-setting-alt"></em>
                    </span>
                    <span class="nk-menu-text">Quản Lý Thành Viên</span>
                </a>
                <ul class="nk-menu-sub td-users">
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/users/list" class="nk-menu-link">
                            <span class="nk-menu-text"><em class="icon ni ni-list-thumb"></em> Danh Sách Thành Viên</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/users/banned" class="nk-menu-link">
                            <span class="nk-menu-text"><em class="icon ni ni-lock-circle"></em> Thành Viên Bị Cấm</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nk-menu-hr"></li>

            <!-- === Nhóm QUẢN LÝ TÀI KHOẢN & GÓI === -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-warning-alt">
                    <i class="ri-vip-crown-2-line"></i> Tài Khoản & Gói
                </h6>
            </li>
            <li class="nk-menu-item has-sub bank">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon">
                        <i class="ri-bank-line fs-16px"></i>
                    </span>
                    <span class="nk-menu-text">Quản Lý Nạp Tiền</span>
                </a>
                <ul class="nk-menu-sub td-bank">
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/history/card" class="nk-menu-link">
                            <span class="nk-menu-text"><i class="ri-bank-card-line"></i> Lịch Sử Nạp Thẻ Cào</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/history/bank" class="nk-menu-link">
                            <span class="nk-menu-text"><i class="ri-bank-fill"></i> Lịch Sử Nạp Ngân Hàng</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/manager/payment" class="nk-menu-link">
                            <span class="nk-menu-text"><i class="ri-tools-line"></i> Cài Đặt Nạp Tiền</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon">
                        <i class="ri-vip-crown-2-line fs-16px"></i>
                    </span>
                    <span class="nk-menu-text">Quản Lý Gói VIP</span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/manager/plan" class="nk-menu-link">
                            <span class="nk-menu-text"><i class="ri-add-circle-line"></i> Tạo/Sửa Gói</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/history/plan" class="nk-menu-link">
                            <span class="nk-menu-text"><i class="ri-history-line"></i> Lịch Sử Mua Gói <span data-bs-toggle="tooltip" title="Hiện có tổng <?=$totals->AllPlans()?> lượt mua gói" class="badge badge-dim rounded-pill bg-<?=($totals->AllPlans() > 0?'success':'secondary')?>"><?=$totals->AllPlans()?></span></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nk-menu-hr"></li>

            <!-- === Nhóm BÀN TIN & HOẠT ĐỘNG === -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-success-alt">
                    <em class="icon ni ni-bulletin-board"></em> Nội Dung
                </h6>
            </li>
            <li class="nk-menu-item has-sub newfeeds">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-bulletin-board"></em>
                    </span>
                    <span class="nk-menu-text">Quản Lý Bảng Tin</span>
                </a>
                <ul class="nk-menu-sub td-newfeeds">
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/create/newfeeds" class="nk-menu-link">
                            <span class="nk-menu-text"><em class="icon ni ni-plus-circle"></em> Đăng Bảng Tin Mới</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="<?=$admin->Path()?>/newfeeds/list" class="nk-menu-link">
                            <span class="nk-menu-text"><em class="icon ni ni-list-thumb"></em> Danh Sách Bảng Tin</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nk-menu-item">
                <a href="<?=$admin->Path()?>/activity/log" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-activity-round-fill"></em>
                    </span>
                    <span class="nk-menu-text">Nhật Ký Hoạt Động</span>
                </a>
            </li>

            <li class="nk-menu-item">
                <a href="<?=$admin->Path()?>/history/bill" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <i class="ri-bill-line fs-16px"></i>
                    </span>
                    <span class="nk-menu-text">Lịch Sử Tạo Bill</span>
                </a>
            </li>

            <!-- === Chat Admin - User (MỚI) === -->
            <li class="nk-menu-item">
                <a href="<?=$admin->Path()?>/chat" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-message-2"></em>
                    </span>
                    <span class="nk-menu-text">Chat Admin - User</span>
                </a>
            </li>

            <li class="nk-menu-item">
                <a href="<?=$admin->Path()?>/cron-jobs" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <i class="ri-terminal-box-line fs-16px"></i>
                    </span>
                    <span class="nk-menu-text">Tác Vụ Cron-Job</span>
                </a>
            </li>

            <li class="nk-menu-hr"></li>

            <!-- === Nhóm HỆ THỐNG === -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-danger-alt">
                    <em class="icon ni ni-setting"></em> Hệ Thống
                </h6>
            </li>
            <li class="nk-menu-item">
                <a href="<?=$admin->Path()?>/settings/" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-setting-alt"></em>
                    </span>
                    <span class="nk-menu-text">Cài Đặt</span>
                </a>
            </li>
            <li class="nk-menu-item">
                <a href="<?=$admin->Path()?>/tutorial-of-admin" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <i class="ri-question-line fs-16px"></i>
                    </span>
                    <span class="nk-menu-text">Hướng Dẫn</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- @ThanhDieuSetting -->
