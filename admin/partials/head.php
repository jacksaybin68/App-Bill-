<?php require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/server/models/object/admin/handleModel.php');?>
<!DOCTYPE html>
<html lang="vi" class="wusteam js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="<?=$TD->Setting('author')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="description" content="Đây là trang quản trị hệ thống của BILLVIET.">
    <link rel="shortcut icon" href="/admin/assets/img/favicon.png">
    <title><?=$title->v3()?> | BILLVIET Admin </title>
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/editors/quill.css?ver=3.2.3">
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/editors/summernote.css?ver=3.2.3">
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/ws.theme.css?ver=3.2.3">
    <link rel="stylesheet" href="<?=$admin->Path()?>/assets/css/td-custom.css?ver=<?=$TD->Setting('cache').rand(110011,2200022)?>">
    <link rel="stylesheet" type="text/css" href="/<?=__LIBRARY__?>/dialog/toast@1.0.1/fuiToast.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/fancybox/fancybox.css">
</head>
<body class="nk-body npc-default has-apps-sidebar has-sidebar ui-shady dark-mode">
    <div id="fui-toast"></div>
    <div class="nk-app-root">
        <div class="nk-apps-sidebar">
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
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-hr"></li>
                                                                <li class="nk-menu-item">
                                                                    <a href="#show-newfeeds" class="nk-menu-link"
                                                                        data-bs-original-title="Quản Lý Sản Phẩm">
                                                                        <span class="nk-menu-icon">
                                                                            <em class="icon ni ni-property-add"></em>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-hr"></li>
                                                                <li class="nk-menu-item">
                                                                    <a href="<?=$admin->Path()?>/activity/log"
                                                                        class="nk-menu-link"
                                                                        data-bs-original-title="Nhật Ký Hoạt Động">
                                                                        <span class="nk-menu-icon">
                                                                            <em
                                                                                class="icon ni ni-activity-round-fill"></em>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-item">
                                                                    <a href="#show-users" class="nk-menu-link"
                                                                        data-bs-original-title="Quản Lý Thành Viên">
                                                                        <span class="nk-menu-icon">
                                                                            <em
                                                                                class="icon ni ni-account-setting-alt"></em>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-item">
                                                                    <a href="#show-bank" class="nk-menu-link"
                                                                        data-bs-original-title="Quản Lý Nạp Tiền">
                                                                        <span class="nk-menu-icon">
                                                                            <i class="ri-bank-line fs-21px"></i>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-item">
                                                                    <a href="<?=$admin->Path()?>/manager/plan"
                                                                        class="nk-menu-link"
                                                                        data-bs-original-title="Quản Lý Gói Thành Viên">
                                                                        <span class="nk-menu-icon">
                                                                            <i class="ri-vip-crown-2-line fs-21px"></i>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-item">
                                                                    <a href="<?=$admin->Path()?>/history/bill"
                                                                        class="nk-menu-link"
                                                                        data-bs-original-title="Lịch Sử Tạo Bill">
                                                                        <span class="nk-menu-icon">
                                                                        <i class="ri-bill-line fs-21px"></i>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-menu-hr"></li>
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
                    <?php require($_SERVER['DOCUMENT_ROOT'].'/client/layout/pages/admin/sidebar.php');?>
                </div>
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
                                                        <span
                                                            class="lead-text"><?=THANHDIEU($user['username']);?></span>
                                                        <span
                                                            class="sub-text text-soft"><?=THANHDIEU($user['email'] ?? 'Chưa xác minh');?></span>
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
                                                            <em
                                                                class="icon icon-circle bg-success-dim ni ni-spark"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Bạn đã deploys
                                                                <span><?=$TD->Setting('name-site')?></span> thành công.
                                                            </div>
                                                            <div class="nk-notification-time">bây giờ</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-foot center">
                                                <a href="#">Xem Tất Cả</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>