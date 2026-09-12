<?php require_once('partials/head.php');?>
<?php require_once('partials/nav.php');?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Danh Sách Bảng Tin</h3>
                            <div class="nk-block-des text-soft">
                                <p>
                                    + Bạn có thể quản lý tất cả các bảng tin đã đăng ở đây.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="dt-bootstrap4 no-footer">
                                <div class="datatable-wrap p-4">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist no-footer">
                                        <?php
                                class ListNewfeeds extends DatabaseConnection 
                                 {
                                    public function ListNewfeeds() {
                                        global $cut;
                                        // if ($user['rank'] === 'partner') {
                                        //     $partner = "WHERE wp.taikhoan = '{$user['username']}' ";
                                        // } else {
                                        //     $partner ='';
                                        // }
                                        $oOo = mysqli_query(self::ThanhDieuDB(),"SELECT * FROM ws_newfeeds ORDER BY ngaydang DESC");
                                        if ($oOo) {?>
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head text-nowrap">
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">STT</span>
                                                </th>
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">Tiêu Đề</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg sorting">
                                                    <span class="sub-text">Nội Dung</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Ngày Đăng</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Trạng Thái</span>
                                                </th>
                                                <th class="nk-tb-col text-end sorting ">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $stt = mysqli_num_rows($oOo);
                                            while ($newfeed = mysqli_fetch_assoc($oOo)) { ?>
                                            <tr class="nk-tb-item odd">
                                                <td class="nk-tb-col nk-tb-col-check sorting_1">
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox notext">
                                                        <?=$stt?></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-check sorting_1">
                                                    <span class="text-primary text-nowrap"><?=$newfeed['tieude']?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md icon-newfeed">
                                                    <span><?=$cut->characters($newfeed['noidung'],400)?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg text-nowrap">
                                                    <span class="fs-12px time-ago"
                                                        data-timeago="<?=$newfeed['ngaydang'];?>"><?=FormatTime::TD($newfeed["ngaydang"])?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md text-nowrap">
                                                <span class="badge badge-dim rounded-pill <?= $newfeed['trangthai'] == 1 ? 'bg-outline-success' : 'bg-outline-danger'; ?>">
                                                    <?=$newfeed['trangthai'] == 1 ? 'Hoạt Động' : 'Đang Ẩn'; ?>
                                                </span>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a data-bs-toggle="modal"
                                                                                href="#editNewfeeds-<?=$newfeed['newfeeds_id']?>"
                                                                                href="javascript:;">
                                                                                <em class="icon ni ni-pen"></em>
                                                                                <span>Sửa Bảng Tin</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a class="delete-newfeeds"
                                                                                data-newfeeds-id="<?=$newfeed['newfeeds_id']?>"
                                                                                href="javascript:;">
                                                                                <em class="icon ni ni-trash"></em>
                                                                                <span>Xoá Bảng Tin</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a class="hide-newfeeds"
                                                                                data-newfeeds-id="<?=$newfeed['newfeeds_id']?>"
                                                                                href="javascript:;"><i class="ri-forbid-2-line me-2 fs-17px"></i>
                                                                                <span><?= $newfeed['trangthai']==0 ? 'Hiện Bảng Tin' : 'Ẩn Bảng Tin' ?></span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                id="editNewfeeds-<?=$newfeed['newfeeds_id']?>">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <a href="#" class="close" data-bs-dismiss="modal">
                                                            <em class="icon ni ni-cross-sm"></em>
                                                        </a>
                                                        <div class="modal-body modal-body-md">
                                                            <h5 class="modal-title">Sửa Lại Sản Phẩm
                                                                #<?=$newfeed['newfeeds_id']?></h5>
                                                            <form class="re-edit-newfeeds form-validate is-alter mt-2">
                                                                <div class="row g-gs">
                                                                <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="hk-label">Tiêu Đề</label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" class="form-control"
                                                                                    name="title"
                                                                                    value="<?=THANHDIEU($newfeed['tieude'])?>"
                                                                                    placeholder="Tiêu đề bảng tin"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Loại Bảng Tin</label>
                                                                            <div class="form-control-wrap">
                                                                                <select
                                                                                    class="form-select js-select2 "
                                                                                    required name="loai">
                                                                                    <option value="primary"
                                                                                        <?= $newfeed['loai'] == 'primary' ? 'selected' : '' ?>>🔵 Thông Thường</option>
                                                                                    <option value="warning"
                                                                                        <?= $newfeed['loai'] == 'warning' ? 'selected' : '' ?>>⚠️ Khẩn Cấp</option>
                                                                                    <option value="info"
                                                                                        <?= $newfeed['loai'] == 'info' ? 'selected' : '' ?>>📌 Đáng Chú Ý</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Nội Dung Bài
                                                                                Viết</label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea name="content"
                                                                                    class="summernote-basic"><?=$newfeed['noidung']?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="action"
                                                                        value="re-edit-product">
                                                                    <input type="hidden" name="newfeeds-id"
                                                                        value="<?=$newfeed['newfeeds_id']?>">
                                                                    <div class="col-12">
                                                                        <ul
                                                                            class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                                            <li>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary"><em
                                                                                        class="icon ni ni-check-circle-cut"></em>&ensp;Cập
                                                                                    Nhật</button>
                                                                            </li>
                                                                            <li>
                                                                                <button type="button"
                                                                                    data-bs-dismiss="modal"
                                                                                    class="link link-light">Huỷ
                                                                                    bỏ</button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $stt--;}?>
                                        </tbody>
                                        <?php } else { ?>
                                        <tr>
                                            <td colspan="8">Chưa có dữ liệu.</td>
                                        </tr>
                                        <?php }
                                         }
                                        }
                                        (new ListNewfeeds())->ListNewfeeds();
                                     ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('partials/foot.php'); ?>