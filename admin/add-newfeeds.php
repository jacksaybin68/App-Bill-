<?php include 'partials/head.php'; ?>
<?php include 'partials/nav.php'; ?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Đăng Bảng Tin Mới</h3>
                            <div class="nk-block-des text-soft">
                                <p><b>Mẹo:</b> Bật chế độ theme Màu Sáng để có thể nhìn được văn bản note
                                    summer.<br /><b>Lưu Ý:</b> Các phần có đánh dấu (<b class="text-danger">*</b>) là
                                    bắt buộc phải điền, nếu không có, thì không cần thiết.</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-8">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                <form class="ws-create-newfeeds form-validate">
                                <input type="hidden" name="action" value="ws-create-newfeeds">
                                    <div class="row g-gs">
                                        <div class="col-12 text-info">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Tiêu Đề Bảng Tin (<b
                                                        class="text-danger">*</b>)</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Tiêu đề ngắn của bảng tin này" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nội Dung Bảng Tin (<b
                                                        class="text-danger">*</b>)</label>
                                                <div class="form-control-wrap">
                                                    <textarea name="content" class="summernote-basic" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row g-gs">
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Loại Bản Tin (<b
                                                        class="text-danger">*</b>)</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select js-select2" required name="loai">
                                                        <option value="primary">🔵 Thông Thường</option>
                                                        <option value="warning">⚠️ Khẩn Cấp</option>
                                                        <option value="info">📌 Đáng Chú Ý</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 mt-1">
                                                    <li>
                                                        <button type="submit" class="btn btn-primary"><em
                                                                class="icon ni ni-check-circle"></em>&ensp;Đăng Ngay</button>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="window.history.back();"
                                                            class="link link-light">Quay lại</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/foot.php'; ?>