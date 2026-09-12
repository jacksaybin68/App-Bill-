<?php $options_header = ['title' => 'Tool Spam Gọi Tin Nhắn (OTP) Đến Nạn Nhân Online','description'=>'Tool Spam Gọi Tin Nhắn Đến Nạn Nhân Online','keywords'=>'Tool spam sms, spam call free, Spam SMS Free, tool spam sms thanhdieu.com, spam call sms, Web spam sms','og:image'=>'https://i.imgur.com/VFvYjxK.jpeg'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-red-800 fw-light">Công Cụ Hữu Ích /</span> Spam Sms
        </h4>
        <div class="alert alert-warning alert-dismissible fw-bold" role="alert">
        <i class="ri-spam-2-line me-2"></i>Với số lượng thành viên sử dụng khá lớn, nên đừng ngạc nhiên tại sao server free lại đôi lúc spam không hiệu quả. Một số điện thoại mà spam nhiều lần bên tổng đài sẽ block số đó từ phút hoặc thậm chí là 1 ngày.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>
        <div class="row">
            <div class="col-md-5">
                <form class="user-attack-sms hk-refresh-form">
                    <div class="card mb-4 thanhdieu-card-bg thanhdieu-border-card">
                        <h5 class="card-header text-red-800">
                            <i class="ri-tools-fill me-2"></i>Tool Spam Sms
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="sdt" data-limit-text="10" class="form-label">Số Điện Thoại</label>
                                <input type="number" class="form-control" name="sdt" id="sdt"
                                    placeholder="eg: 0<?=rand(7,9).rand(10,99).'xxx'.rand(111,999)?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="server" class="form-label">Máy Chủ</label>
                                <select class="form-select thanhdieu-select-mod dangerBox" name="server"
                                    aria-label="Chọn Máy Chủ" required>
                                    <optgroup style="color:#00ff37;" label="━ Miễn Phí ━">
                                        <option value="basic">➣ BASIC - Attack With 15s - CURL One Time - Only OTP
                                        </option>
                                        <option disabled value="normal">➣ NORMAL - Attack With 30s - CURL One Time - Only OTP</option>
                                    </optgroup>
                                    <optgroup style="color:#ff0324;" label="━ Gói VIP ━">
                                        <option disabled value="luxury">➣ LUXURY - Attack With 60s - Accept Loop - OTP + CAll</option>
                                        <option disabled value="premium">➣ PREMIUM - Attack With 180s - Accept Loop - OTP + CAll</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center text-nowrap">
                                    <input type="hidden" name="action" value="user-attack-sms">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="icon-rocket ri-rocket-line me-2"></i>Send Attack
                                    </button>&ensp;
                                    <button type="button" class="btn ButtonV2 clear-form">
                                        <i class="ri-refresh-line me-2"></i>Làm Mới </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <div class="card thanhdieu-card-bg thanhdieu-border-card">
                    <h5 class="card-header text-red-800"><i class="ri-skull-2-line me-2"></i>Running Attacks <span
                            class="total-sms badge badge-center rounded-pill"></span>
                        <!-- <div class="position-relative">
                            <a id="list-attack" class="badge bg-glow position-absolute bottom-0 end-0"><i class="ri-add-line me-2"></i>Add Blacklist</a>
                        </div> -->
                    </h5>
                    <div class="card-datatable table-responsive">
                        <table class="dt-multilingual table text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Máy Chủ</th>
                                    <th>Thời Gian Chờ</th>
                                    <th>Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody class="rl-history-spamsms">
                                <tr class="odd">
                                    <td colspan="8" class="dataTables_empty">Đang tải...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>