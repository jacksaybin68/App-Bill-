<?php require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/server/models/object/admin/handleModel.php');?>
<!DOCTYPE html>
<html lang="vi" class="wusteam js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="<?=$TD->Setting('author')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="description" content="Đây là trang quản trị hệ thống của BillDAYROI.">
    <link rel="shortcut icon" href="/admin/assets/img/favicon.png">
    <title><?=$title->v3()?> | BillDAYROI Admin </title>
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/editors/quill.css?ver=3.2.3">
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/editors/summernote.css?ver=3.2.3">
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/ws.theme.css?ver=3.2.3">
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/td-custom.css?ver=<?=$TD->Setting('cache').rand(110011,2200022)?>">
    <link rel="stylesheet" type="text/css" href="/<?=__LIBRARY__?>/dialog/toast@1.0.1/fuiToast.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/fancybox/fancybox.css">
    <style>
        /* === Sidebar nhóm collapsible === */
        .nk-menu-group-label {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 16px; font-weight: 600; font-size: 11px;
            letter-spacing: 0.5px; text-transform: uppercase;
            color: rgba(255,255,255,0.45); cursor: pointer;
            user-select: none; transition: color 0.2s;
        }
        .nk-menu-group-label:hover { color: rgba(255,255,255,0.75); }
        .nk-menu-group-label .toggle-icon {
            font-size: 10px; transition: transform 0.25s ease;
            display: inline-block;
        }
        .nk-menu-group-label.collapsed .toggle-icon { transform: rotate(-90deg); }
        .nk-menu-group-content {
            overflow: hidden; transition: max-height 0.3s ease, opacity 0.25s ease;
            max-height: 1000px; opacity: 1;
        }
        .nk-menu-group-content.hidden {
            max-height: 0 !important; opacity: 0;
        }
        /* === Thanh tìm kiếm menu === */
        .nk-menu-search {
            position: relative; margin: 8px 12px 12px;
        }
        .nk-menu-search input {
            width: 100%; padding: 7px 12px 7px 32px;
            border-radius: 6px; border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.08); color: #fff;
            font-size: 12px; outline: none; transition: 0.2s;
        }
        .nk-menu-search input::placeholder { color: rgba(255,255,255,0.35); }
        .nk-menu-search input:focus {
            border-color: #7c3aed; background: rgba(124,58,237,0.15);
        }
        .nk-menu-search .search-icon {
            position: absolute; left: 10px; top: 50%;
            transform: translateY(-50%); color: rgba(255,255,255,0.4);
            font-size: 13px; pointer-events: none;
        }
        .nk-menu-search .clear-btn {
            position: absolute; right: 8px; top: 50%;
            transform: translateY(-50%); background: none; border: none;
            color: rgba(255,255,255,0.4); cursor: pointer; font-size: 14px;
            display: none; padding: 2px;
        }
        .nk-menu-search .clear-btn:hover { color: #fff; }
        .nk-menu-search .clear-btn.visible { display: block; }
        .nk-menu-item.filtered-out { display: none; }
        .nk-menu-group-label.filtered-out { display: none; }
        /* === Apps Sidebar rút gọn === */
        .nk-apps-sidebar .nk-sidebar-menu .nk-menu-item {
            padding: 6px 12px !important;
        }
        .nk-apps-sidebar .nk-sidebar-menu .nk-menu-item a {
            justify-content: flex-start; gap: 10px;
        }
        /* === Toggle Apps Sidebar === */
        .toggle-apps-sidebar-btn {
            position: fixed; bottom: 16px; right: 16px; z-index: 999;
            width: 40px; height: 40px; border-radius: 50%;
            background: #7c3aed; color: #fff; border: none;
            box-shadow: 0 4px 12px rgba(124,58,237,0.4);
            cursor: pointer; display: flex; align-items: center;
            justify-content: center; transition: 0.2s;
            font-size: 18px;
        }
        .toggle-apps-sidebar-btn:hover {
            transform: scale(1.1); background: #6d28d9;
        }
        /* === Widget thống kê dashboard === */
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
        }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .chart-container {
            position: relative; height: 220px; width: 100%;
        }
        /* === Thông báo cảnh báo === */
        .alert-banner {
            border-radius: 8px; padding: 10px 14px;
            font-size: 13px; display: flex; align-items: center; gap: 10px;
            margin-bottom: 12px; border-left: 4px solid;
        }
        .alert-banner.warning { background: rgba(245,158,11,0.12); border-color: #f59e0b; color: #fbbf24; }
        .alert-banner.success { background: rgba(34,197,94,0.12); border-color: #22c55e; color: #4ade80; }
        .alert-banner.danger  { background: rgba(239,68,68,0.12); border-color: #ef4444; color: #f87171; }
        .alert-banner.info    { background: rgba(59,130,246,0.12); border-color: #3b82f6; color: #60a5fa; }
        .alert-banner .alert-close {
            margin-left: auto; background: none; border: none; cursor: pointer;
            color: inherit; opacity: 0.6; font-size: 16px; padding: 0 4px;
        }
        .alert-banner .alert-close:hover { opacity: 1; }
    </style>
</head>
<body class="nk-body npc-default has-apps-sidebar has-sidebar ui-shady dark-mode">
    <div id="fui-toast"></div>
    <div class="nk-app-root">
        <div class="nk-apps-sidebar" id="appsSidebar">
            <div class="nk-sidebar-element">
                <div class="nk-sidebar-body">
                    <div class="nk-apps-sidebar is-light">
                        <div class="nk-apps-brand">
                            <a href="/admin/" class="logo-link">
                                <img class="logo-img-lg" src="<?=$admin->Path()?>/assets/img/favicon.png"
                                    srcset="<?=$admin->Path()?>/assets/img/favicon.png 2x" alt="logo">
                            </a>
                        </div>
                        <div class="nk-sidebar-element">
                            <div class="nk-sidebar-body">
                                <div class="nk-sidebar-content" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                    aria-label="scrollable content">
                                                    <div class="simplebar-content">
                                                        <div class="nk-sidebar-menu">
                                                            <ul class="nk-menu apps-menu">
                                                                <li class="nk-menu-item home">
                                                                    <a href="<?=$admin->Path()?>/dashboard"
                                                                        class="nk-menu-link"
                                                                        data-bs-original-title="Trang Chủ">
                                                                        <span class="nk-menu-icon">
                                                                            <em class="icon ni ni-home"></em>
                                                                        </span>
                                                                        <span class="nk-menu-text">Trang chủ</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-hr"></li>

                                                                <!-- Nhóm QUẢN LÝ NGƯỜI DÙNG -->
                                                                <div class="nk-menu-group">
                                                                    <div class="nk-menu-group-label" data-target="grp-users">
                                                                        <span>Quản lý người dùng</span>
                                                                        <span class="toggle-icon">▼</span>
                                                                    </div>
                                                                    <div class="nk-menu-group-content" id="grp-users">
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/users/list"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Danh sách thành viên">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-account-setting-alt"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Danh sách thành viên</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/users/banned"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Thành viên bị khóa">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-lock-circle"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Thành viên bị khóa</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/users/edit"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Chỉnh sửa thành viên">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-pencil"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Chỉnh sửa thành viên</span>
                                                                            </a>
                                                                        </li>
                                                                    </div>
                                                                </div>

                                                                <!-- Nhóm QUẢN LÝ SẢN PHẨM & GÓI -->
                                                                <div class="nk-menu-group">
                                                                    <div class="nk-menu-group-label" data-target="grp-products">
                                                                        <span>Quản lý sản phẩm & gói</span>
                                                                        <span class="toggle-icon">▼</span>
                                                                    </div>
                                                                    <div class="nk-menu-group-content" id="grp-products">
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/create/product"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Đăng sản phẩm mới">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-property-add"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Đăng sản phẩm mới</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/product/list"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Danh sách sản phẩm">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-box-2"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Danh sách sản phẩm</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/manager/plan"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Quản lý gói thành viên">
                                                                                <span class="nk-menu-icon">
                                                                                    <i class="ri-vip-crown-2-line fs-21px"></i>
                                                                                </span>
                                                                                <span class="nk-menu-text">Quản lý gói VIP</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/history/plan"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Lịch sử mua gói">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-receipt"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Lịch sử mua gói</span>
                                                                            </a>
                                                                        </li>
                                                                    </div>
                                                                </div>

                                                                <!-- Nhóm GIAO DỊCH & TÀI KHOẢN -->
                                                                <div class="nk-menu-group">
                                                                    <div class="nk-menu-group-label" data-target="grp-transaction">
                                                                        <span>Giao dịch & tài khoản</span>
                                                                        <span class="toggle-icon">▼</span>
                                                                    </div>
                                                                    <div class="nk-menu-group-content" id="grp-transaction">
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/manager/payment"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Cài đặt nạp tiền">
                                                                                <span class="nk-menu-icon">
                                                                                    <i class="ri-bank-line fs-21px"></i>
                                                                                </span>
                                                                                <span class="nk-menu-text">Cài đặt nạp tiền</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/history/bank"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Lịch sử nạp ngân hàng">
                                                                                <span class="nk-menu-icon">
                                                                                    <i class="ri-bank-line fs-21px"></i>
                                                                                </span>
                                                                                <span class="nk-menu-text">Lịch sử nạp ngân hàng</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/history/card"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Lịch sử nạp thẻ cào">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-cards"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Lịch sử nạp thẻ cào</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/history/bill"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Lịch sử tạo bill">
                                                                                <span class="nk-menu-icon">
                                                                                    <i class="ri-bill-line fs-21px"></i>
                                                                                </span>
                                                                                <span class="nk-menu-text">Lịch sử tạo bill</span>
                                                                            </a>
                                                                        </li>
                                                                    </div>
                                                                </div>

                                                                <!-- Nhóm BÀN TIN & HOẠT ĐỘNG -->
                                                                <div class="nk-menu-group">
                                                                    <div class="nk-menu-group-label" data-target="grp-feeds">
                                                                        <span>Bàn tin & hoạt động</span>
                                                                        <span class="toggle-icon">▼</span>
                                                                    </div>
                                                                    <div class="nk-menu-group-content" id="grp-feeds">
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/create/newfeeds"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Đăng bản tin mới">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-bulletin-board"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Đăng bản tin mới</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/newfeeds/list"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Danh sách bản tin">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-list"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Danh sách bản tin</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nk-menu-item">
                                                                            <a href="<?=$admin->Path()?>/activity/log"
                                                                                class="nk-menu-link"
                                                                                data-bs-original-title="Nhật ký hoạt động">
                                                                                <span class="nk-menu-icon">
                                                                                    <em class="icon ni ni-activity-round-fill"></em>
                                                                                </span>
                                                                                <span class="nk-menu-text">Nhật ký hoạt động</span>
                                                                            </a>
                                                                        </li>
                                                                    </div>
                                                                </div>

                                                                <li class="nk-menu-hr"></li>
                                                                <li class="nk-menu-item">
                                                                    <a href="<?=$admin->Path()?>/settings"
                                                                        class="nk-menu-link" aria-label="Settings"
                                                                        data-bs-original-title="Cài đặt hệ thống">
                                                                        <span class="nk-menu-icon">
                                                                            <em class="icon ni ni-setting"></em>
                                                                        </span>
                                                                        <span class="nk-menu-text">Cài đặt</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-item">
                                                                    <a href="<?=$admin->Path()?>/tutorial-of-admin"
                                                                        class="nk-menu-link"
                                                                        data-bs-original-title="Hướng dẫn sử dụng">
                                                                        <span class="nk-menu-icon">
                                                                            <em class="icon ni ni-book-open"></em>
                                                                        </span>
                                                                        <span class="nk-menu-text">Hướng dẫn</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-item">
                                                                    <a href="<?=$admin->Path()?>/cron-jobs"
                                                                        class="nk-menu-link"
                                                                        data-bs-original-title="Tác vụ Cron Jobs">
                                                                        <span class="nk-menu-icon">
                                                                            <em class="icon ni ni-clock"></em>
                                                                        </span>
                                                                        <span class="nk-menu-text">Cron Jobs</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <ul class="nk-menu">
                                                            <li class="nk-menu-item">
                                                                <a href="<?=$admin->Path()?>/settings"
                                                                    class="nk-menu-link" aria-label="Settings"
                                                                    data-bs-original-title="Settings">
                                                                    <span class="nk-menu-icon">
                                                                        <em class="icon ni ni-setting"></em>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: auto; height: 853px;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                            <div class="simplebar-scrollbar"
                                                style="height: 737px; transform: translate3d(0px, 16px, 0px); display: block;">
                                            </div>
                                        </div>
                                    </div>
                                    <?php require($_SERVER['DOCUMENT_ROOT'].'/client/layout/pages/admin/sidebar.php');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Thanh tìm kiếm menu -->
            <div class="nk-menu-search" id="menuSearch">
                <span class="search-icon"><em class="icon ni ni-search"></em></span>
                <input type="text" id="menuSearchInput" placeholder="Tìm kiếm menu..." autocomplete="off">
                <button class="clear-btn" id="menuSearchClear" title="Xóa">✕</button>
            </div>
            <!-- Toggle Apps Sidebar -->
            <button class="toggle-apps-sidebar-btn" id="toggleAppsSidebar" title="Ẩn/Hiện sidebar phụ">
                <em class="icon ni ni-layout-nav-side"></em>
            </button>
        </div>
    </div>
    <div class="nk-main">
        <div class="nk-wrap">
            <div class="nk-header nk-header-fixed">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ms-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                                <em class="icon ni ni-menu"></em>
                            </a>
                        </div>
                        <div class="nk-header-app-name">
                            <div class="nk-header-app-logo">
                                <em class="icon ni ni-sign-steller bg-purple-dim"></em>
                            </div>
                            <div class="nk-header-app-info">
                                <span class="sub-text"><?=$TD->Setting('name-site')?></span>
                                <span class="lead-text">Dashboard</span>
                            </div>
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <img class="ws-avatar-1"
                                                    src="<?=Avatar($user['username'], $user['avatar'])?>"
                                                    alt="<?=THANHDIEU($user['username']);?>">
                                            </div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="user-status">Administrator</div>
                                                <div class="user-name dropdown-indicator"><?=THANHDIEU($user['username']);?></div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <img class="ws-avatar-1"
                                                        src="<?=$admin->Path()?>/assets/img/admin.png"
                                                        alt="<?=THANHDIEU($user['username']);?>">
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?=THANHDIEU($user['username']);?></span>
                                                    <span class="sub-text text-soft"><?=THANHDIEU($user['email'] ?? 'Chưa xác minh');?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a class="user-logout" href="javascript:;">
                                                        <em class="icon ni ni-signout"></em>
                                                        <span>Đăng Xuất</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown notification-dropdown">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                        <div class="icon-status icon-status-info">
                                            <em class="icon ni ni-bell"></em>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Thông Báo Từ Hệ Thống</span>
                                        </div>
                                        <div class="dropdown-body">
                                            <div class="nk-notification">
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-success-dim ni ni-spark"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Hệ thống đang hoạt động ổn định.
                                                            <br><span class="text-soft">Cập nhật lần cuối: <?=date('d/m/Y H:i')?></span>
                                                        </div>
                                                        <div class="nk-notification-time">vừa xong</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-foot center">
                                            <a href="<?=$admin->Path()?>/activity/log">Xem tất cả</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // === Collapsible menu groups ===
    document.querySelectorAll('.nk-menu-group-label').forEach(function(label) {
        label.addEventListener('click', function() {
            var group = label.getAttribute('data-target');
            var content = document.getElementById(group);
            if (content) {
                label.classList.toggle('collapsed');
                content.classList.toggle('hidden');
            }
        });
    });

    // === Thanh tìm kiếm menu ===
    (function() {
        var input = document.getElementById('menuSearchInput');
        var clearBtn = document.getElementById('menuSearchClear');
        var items = document.querySelectorAll('.nk-menu-item:not(.nk-menu-hr)');
        var groupLabels = document.querySelectorAll('.nk-menu-group-label');

        function performSearch(query) {
            var q = query.toLowerCase().trim();
            var anyVisible = false;
            items.forEach(function(item) {
                var text = item.textContent.toLowerCase();
                var match = !q || text.indexOf(q) !== -1;
                item.classList.toggle('filtered-out', !match);
                if (match) anyVisible = true;
            });
            // Ẩn nhóm nếu toàn bộ nội dung bị ẩn
            groupLabels.forEach(function(lbl) {
                var grpId = lbl.getAttribute('data-target');
                var grpContent = document.getElementById(grpId);
                if (grpContent) {
                    var visibleItems = grpContent.querySelectorAll('.nk-menu-item:not(.filtered-out)');
                    lbl.classList.toggle('filtered-out', q && visibleItems.length === 0);
                }
            });
            clearBtn.classList.toggle('visible', q.length > 0);
        }

        input.addEventListener('input', function() { performSearch(input.value); });
        clearBtn.addEventListener('click', function() {
            input.value = '';
            performSearch('');
            input.focus();
        });
    })();

    // === Toggle Apps Sidebar ẨN/HIỆN ===
    (function() {
        var btn = document.getElementById('toggleAppsSidebar');
        var appsSidebar = document.getElementById('appsSidebar');
        var hidden = false;
        btn.addEventListener('click', function() {
            hidden = !hidden;
            appsSidebar.style.display = hidden ? 'none' : 'block';
            btn.innerHTML = hidden
                ? '<em class="icon ni ni-layout-nav-side"></em>'
                : '<em class="icon ni ni-menu-2"></em>';
            btn.title = hidden ? 'Hiện sidebar phụ' : 'Ẩn sidebar phụ';
        });
    })();
    </script>
