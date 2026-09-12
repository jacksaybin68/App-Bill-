<?php include 'partials/head.php'; ?>
<?php include 'partials/nav.php'; ?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Tạo Đơn Hàng Mới</h3>
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
                                <form class="ws-create-products form-validate" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="ws-create-products">
                                    <div class="row g-gs">
                                        <div class="col-12 text-info">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Tiêu Đề (<b
                                                        class="text-danger">*</b>)</label>
                                                <input type="text" class="form-control" name="title"
                                                    placeholder="Tiêu đề ngắn của đơn hàng này" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Mô Tả (<i
                                                        class="text-warning fw-bold">Có thể bỏ trống</i>)</label>
                                                <div class="form-control-wrap">
                                                    <textarea name="content" class="summernote-basic"></textarea>
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
                                                <label class="form-label" for="slug">Slug
                                                </label>
                                                <span class="form-note p-1">- Nếu để trống nó sẽ tự lấy tiêu đề bài viết làm slug.</span>
                                                <input type="text" class="form-control" name="slug" id="slug"
                                                    placeholder="Ví dụ: ma-nguon-ngon">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="giatien">Giá Bán</label>
                                                <input type="text" class="form-control ws-sotien" name="giatien"
                                                    placeholder="Nếu để trống hoặc nhập 0 sẽ là miễn phí">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Ảnh Sản Phẩm - tối đa 4MB (<b
                                                        class="text-danger">*</b>)</label>
                                                <div id="custom-dropzone" class="dropzone">
                                                    <div class="td-message"><small class="text-warning fw-bold">Ảnh đầu
                                                            tiên sẽ là ảnh hình thu
                                                            nhỏ</small><br/><br/>Kéo và thả ảnh hoặc click để tải ảnh lên
                                                    </div>
                                                    <div id="image-preview"></div>
                                                    <input type="file" id="td-uploads" name="anhsanpham[]" accept="image/gif,image/jpeg,image/jpg,image/png,image/webp" multiple>
                                                    <button type="button" id="select-image"
                                                        class="btn btn-primary mt-2"><em
                                                            class="icon ni ni-upload-cloud"></em>&nbsp;Chọn Ảnh</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="download-url">Liên Kết Tải Xuống (<b
                                                        class="text-danger">*</b>)</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-link-alt"></em>
                                                    </div>
                                                    <input type="url" class="form-control" name="download-url" required
                                                        placeholder="https://mediafire.com/xxxx">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="g-3 align-center flex-wrap">
                                                    <div class="g">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" checked disabled
                                                                class="custom-control-input" name="turn-on-login">
                                                            <label class="custom-control-label fw-bold"
                                                                for="turn-on-login">Yêu Cầu Đăng Nhập</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 mt-1">
                                                    <li>
                                                        <button type="submit" class="btn btn-primary"><em
                                                                class="icon ni ni-check-circle"></em>&ensp;Đăng Bán</button>
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