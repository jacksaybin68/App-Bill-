<?php $options_header = ['title' => 'Công cụ tìm thông tin facebook', 'description' => 'Công cụ tìm thông tin facebook.']; ?>
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
            <span class="text-red-800 fw-light">Công Cụ Hữu Ích / </span>Tìm Thông Tin Facebook
        </h4>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form class="user-scan-info-fb hk-refresh-form">
                    <div class="card mb-4 thanhdieu-card-bg thanhdieu-border-card">
                        <h5 class="card-header text-red-800">
                            <i class="ri-baidu-line me-2"></i>Tìm Thông Tin Facebook
                        </h5>
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                                ⚠️ <b>Thông báo</b>: Nếu tìm không thành công, hệ thống chúng tôi sẽ tự hoàn tiền vào
                                tài khoản của bạn.
                            </div>
                            <div class="mb-3">
                                <label for="tt" data-limit-text="100" class="form-label">Nhập UID - SDT -
                                    GMAIL</label>
                                <input type="text" class="form-control" name="tt"
                                    placeholder="Ví dụ: 1000<?=rand(100000000,999999999)?>" required>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="user-scan-info-fb">
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
        </div>
    </div>
    <!-- / Content -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>