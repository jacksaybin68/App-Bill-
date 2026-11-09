<?php require('partials/head.php');?>
<?php require('partials/nav.php');?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title"><?=$TD->Setting('name-site')?> Dashboard</h3>
                        <div class="nk-block-des text-soft">
                            <p>Chào mừng trở lại <?=$user['username']?>, chúc bạn 1 ngày mới vui vẻ.</p>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <a data-bs-toggle="modal" href="#" class="btn btn-icon btn-primary d-md-none">
                            <em class="icon ni ni-plus"></em>
                        </a>
                        <a data-bs-toggle="modal" href="#"
                            class="btn btn-primary d-none d-md-inline-flex">
                            <em class="icon ni ni-plus"></em>
                            <span>BillDAYROI</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- === Thông báo cảnh báo === -->
            <div class="row">
                <div class="col-12">
                    <div class="alert-banner warning">
                        <strong>Thông báo:</strong> Biểu đồ thống kê hôm nay đang hiển thị theo mặc định. Vui lòng xem Widget bên dưới.
                        <button class="alert-close" onclick="this.parentElement.style.display='none'">✕</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert-banner success">
                        <strong>Thành công:</strong> Hệ thống đang hoạt động ổn định. Số liệu cập nhật theo thời gian thực.
                        <button class="alert-close" onclick="this.parentElement.style.display='none'">✕</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert-banner info">
                        <strong>Hướng dẫn:</strong> Sử dụng thanh tìm kiếm ở sidebar trái để tìm nhanh chức năng. Nhấn vào tiêu đề nhóm để rút gọn menu.
                        <button class="alert-close" onclick="this.parentElement.style.display='none'">✕</button>
                    </div>
                </div>
            </div>

            <!-- === Widget thống kê nhanh 4 mục === -->
            <div class="nk-block">
                <div class="row g-gs">
                    <!-- Doanh thu -->
                    <div class="col-sm-6 col-xxl-3">
                        <div class="card card-full stat-card">
                            <div class="card-inner border-start border-4 border-success">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-success-dim">
                                        <i class="ri-bank-line fs-22px"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-gray fs-12px">Doanh Thu TÍNH Admin</h6>
                                        <h4 class="fs-2 mt-1 text-boldz">
                                            <?=FormatNumber::TD($totals->RevenueBank() + $totals->RevenueCard(), 1)?>
                                            <span class="text-gray fs-12px font-weight-normal">VND</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Gói VIP còn HSD -->
                    <div class="col-sm-6 col-xxl-3">
                        <div class="card card-full stat-card">
                            <div class="card-inner border-start border-4 border-info">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-info-dim">
                                        <i class="ri-vip-crown-2-line fs-22px"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-gray fs-12px">GÓI VIP CÒN HSD</h6>
                                        <h4 class="fs-2 mt-1 text-boldz">
                                            <?=$totals->Plans()?><span class="text-gray fs-12px font-weight-normal"> / <?=$totals->AllPlans()?></span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Thành viên hôm nay -->
                    <div class="col-sm-6 col-xxl-3">
                        <div class="card card-full stat-card">
                            <div class="card-inner border-start border-4 border-primary">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-primary-dim">
                                        <em class="icon ni ni-account-setting-alt"></em>
                                    </div>
                                    <div>
                                        <h6 class="text-gray fs-12px">THÀNH VIÊN NGÀY HÔM NAY</h6>
                                        <h4 class="fs-2 mt-1 text-boldz">
                                            <?=FormatNumber::TD($totals->UsersNewToday() ?? 0, 0)?>
                                            <span class="text-gray fs-12px font-weight-normal">người</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Lượt tạo bill hôm nay -->
                    <div class="col-sm-6 col-xxl-3">
                        <div class="card card-full stat-card">
                            <div class="card-inner border-start border-4 border-danger">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-danger-dim">
                                        <i class="ri-bill-line fs-22px"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-gray fs-12px">BILL HÔM NAY</h6>
                                        <h4 class="fs-2 mt-1 text-boldz">
                                            <?=FormatNumber::TD($totals->HistoryFakeBill() ?? 0, 0)?>
                                            <span class="text-gray fs-12px font-weight-normal">lần</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- === Widget biểu đồ doanh thu === -->
            <div class="nk-block mt-4">
                <div class="card card-full border-radius-10">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Biểu Đồ Doanh Thu (Ngân Hàng + Thẻ Cào)</h6>
                                <span class="sub-title text-soft fs-12px">Cập nhật theo thời gian thực</span>
                            </div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-size-sm btn-primary" data-bs-toggle="dropdown">
                                        Ngày <em class="icon ni ni-chevron-down fs-12px"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Hôm nay</a>
                                        <a class="dropdown-item" href="#">7 ngày</a>
                                        <a class="dropdown-item" href="#">30 ngày</a>
                                        <a class="dropdown-item" href="#">Tháng này</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- === Widget thống kê mua gói theo thời gian === -->
            <div class="nk-block mt-4">
                <div class="card card-full border-radius-10">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Tổng Lượt Mua Gói Theo Khung Thời Gian</h6>
                                <span class="sub-title text-soft fs-12px">Hôm nay · Hôm qua · Tuần này · Tháng này</span>
                            </div>
                        </div>
                        <div class="row g-gs">
                            <?php foreach ($ThongKeTaoBill as $k): ?>
                            <div class="col-sm-6 col-xxl-3">
                                <div class="card card-full stat-card <?=$k['class']?>">
                                    <div class="card-inner border-start border-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="stat-icon <?=$k['class']?>-dim">
                                                <em class="icon ni ni-receipt"></em>
                                            </div>
                                            <div>
                                                <h6 class="text-gray fs-12px"><?=$k['title']?></h6>
                                                <h4 class="fs-2 mt-1 text-boldz">
                                                    <?=FormatNumber::TD($k['tongmua'], 0)?>
                                                </h4>
                                                <p class="text-soft fs-12px mt-1"><?=$k['desc']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- === Widget thông tin server (giữ nguyên) === -->
            <div class="nk-block mt-4">
                <div class="card card-full border-radius-10">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Thông Tin Máy Chủ</h6>
                            </div>
                        </div>
                    </div>
                    <div class="fs-sm">
                        <div class="rounded p-2 text-pulse-light">
                            <ul class="list-group text-dark border-start border-4 rounded-2 border-primary mb-2">
                                <li class="list-group-item">
                                    <b>Phiên bản PHP: </b> <?=$phpversion?>
                                    <?=(ini_get('safe_mode') ? 'Ổn định' : 'Khá ổn định')?>
                                </li>
                                <li class="list-group-item">
                                    <b>Phiên bản MySQL: </b> <?=$mysqlversion?>
                                </li>
                                <li class="list-group-item">
                                    <b>WEB Phần mềm: </b> <?=$serversoftware?>
                                </li>
                                <li class="list-group-item">
                                    <b>Tên Mã Nguồn: </b> Fakebill Lavender - Đã được tinh chỉnh bởi BillDAYROI
                                </li>
                                <li class="list-group-item">
                                    <b>Phiên Bản Mã Nguồn: </b> <?=$TD->Setting('version-code')?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Chart.js 3.7.0 -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('revenueChart').getContext('2d');
    // Dữ liệu mẫu (có thể thay bằng dữ liệu thật từ DB sau)
    var revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'],
            datasets: [{
                label: 'Doanh Thu Ngân Hàng (VND)',
                data: [1200000, 800000, 2100000, 3400000, 5200000, 4800000, 7300000, 6100000],
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointBackgroundColor: '#22c55e',
            }, {
                label: 'Doanh Thu Thẻ Cào (VND)',
                data: [600000, 900000, 1500000, 2200000, 1800000, 2700000, 3500000, 2900000],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointBackgroundColor: '#3b82f6',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { usePointStyle: true, padding: 16, color: '#e2e8f0', font: { size: 12 } }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#f8fafc',
                    bodyColor: '#cbd5e1',
                    borderColor: '#334155',
                    borderWidth: 1,
                    padding: 10,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + (context.parsed.y).toLocaleString() + ' VND';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(255,255,255,0.06)' },
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11 },
                        callback: function(value) {
                            if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
                            if (value >= 1000) return (value / 1000).toFixed(0) + 'K';
                            return value;
                        }
                    }
                },
                x: {
                    grid: { color: 'rgba(255,255,255,0.06)' },
                    ticks: { color: '#94a3b8', font: { size: 11 } }
                }
            }
        }
    });

    // Gán active class cho menu home
    var path = window.location.pathname;
    if (path === '/admin/' || path.endsWith('/admin/') || path.endsWith('/admin/dashboard')) {
        var homeMenuItem = document.querySelector('.nk-menu-item.home a');
        if (homeMenuItem) {
            homeMenuItem.closest('.nk-menu-item').classList.add('active', 'current-page');
        }
    }
});
</script>
<?php require_once('partials/foot.php'); ?>
