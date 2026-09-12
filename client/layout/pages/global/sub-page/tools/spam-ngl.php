<?php $options_header = ['title' => 'Tool Spam Ngl.Link Online','description'=>'Tool Spam Ngl Link Dành Cho Các Thánh Niên Ghét Mấy Đứa Con Gái Ngựa Ngựa Sài.','keywords'=>'Tool spam ngl link, spam ngl free, spam ngl link Free, tool ngl link thanhdieu.com, spam ngl link, Web spam ngl link'];?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full w-md-10">
                <div class="container flex flex-col md:flex-row items-start md:items-center gap-5">
                    <form class="user-attack-ngl-link hk-refresh-form space-y-3 flex-1">
                        <form class="user-attack-ngl-link hk-refresh-form space-y-3">
                            <fieldset class="relative">
                                <div
                                    class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                                    <legend class="mb-6-none flex flex-col md:flex-row justify-between items-start">
                                        <div class="text-left">
                                            <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none">
                                                <i class="ri-tools-fill me-2"></i> Tool Spam Ngl Link
                                            </p>
                                  <span
                                                class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">
                                                Hãy nhập đầy đủ thông tin để spam
                                            </span>
                                            </legend>
                                    <div id="panel-1">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div class="col-span-1">
                        <div class="card-body">
                            <!-- <div class="alert alert-danger alert-dismissible" role="alert">
                            ➡️ Tất cả thông tin người thực hiện sẽ được bảo mật với cơ chế giả mạo thiết bị, địa chỉ cũng như thông số view trong ứng dụng NGL Premium.<br>
                            ➡️ Server basic - normal sẽ có thời gian chờ, đảm bảo tốc độ kết nối tấn công spam ổn định ngược lại server luxury - premium sẽ không có thời gian chờ spam với tốc độ cao nhất.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> -->
                            <div class="mb-3">
                                <label for="target" data-limit-text="250" class="form-label">Link Mục Tiêu</label>
                                <input type="text" class="form-control" name="target"
                                    placeholder="eg: https://ngl.link/username" required>
                            </div>
                            <div class="mb-3">
                                <label for="server" class="form-label">Tuỳ Chọn Máy Chủ</label>
                                <select class="form-select thanhdieu-select-mod dangerBox" name="server"
                                    aria-label="LOẠI TẤN CÔNG" required>
                                    <optgroup style="color:#f7ff03;" label="━ GÓI FREE ━">
                                        <option value="basic">➣ BASIC - Spam Câu Hỏi - Fake Device - Delay [49]
                                        </option>
                                        <option value="normal">➣ NORMAL - Spam Câu Hỏi - Fake Device - Delay [79]
                                        </option>
                                    </optgroup>
                                    <optgroup style="color:#ff0324;" label="━ GÓI VIP ━">
                                        <option <?=(!$plans->TD('tengoi', $taikhoan)) ? 'disabled' : ''?> value="luxury">
                                            ➣ LUXURY - Spam Thread (Automatic) - Fake Device - No Delay [249]</option>
                                        <option <?=(!$plans->TD('tengoi', $taikhoan)) ? 'disabled' : ''?>
                                            value="premium">➣ PREMIUM - Spam Random (Overload) - Fake Device - No Delay [400~800]</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="question" data-limit-text="500" class="form-label">Nội Dung Thông
                                    Điệp</label>
                                <textarea class="form-control dangerBox" name="question" rows="3"
                                    placeholder="Nếu bỏ trống hệ thống sẽ tự ngẫu nhiên thông điệp"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center text-nowrap">
                                    <input type="hidden" name="action" value="user-attack-ngl-link">
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
            <div class="col-md-10">
                <div class="card thanhdieu-card-bg thanhdieu-border-card">
                    <h5 class="card-header text-red-800"><i class="ri-skull-2-line me-2"></i>Status Attacks
                    </h5>
                    <textarea rows="10" cols="30" disabled placeholder="Trạng thái sẽ hiển thị ở đây..." id="ngl-status"
                        class="form-control alert-danger"></textarea>
                </div>
            </div>
        </div>
    </div>
  </main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>