<?php require_once('partials/head.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/server/models/views/products.php');?>
<?php require_once('partials/nav.php');?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Quản Lý Đơn Hàng</h3>
                            <div class="nk-block-des text-soft">
                                <p>
                                    + Bạn có thể quản lý tất cả các đơn hàng đã bán ở đây.<br>
                                    + Ngừng bán là khi đơn hàng sẽ giữ lại trên hệ thống (phía admin), chỉ có khách hàng sẽ không thấy được sự tồn tại của đơn hàng kể cả lịch sử mua.</p>
                            </div>
                        </div>

                        <div class="nk-block-head-content">
                            <div class="drodown">
                                <a href="javascript:;" class="dropdown-toggle btn btn-white btn-dim btn-outline-warning" data-bs-toggle="dropdown" aria-expanded="false">
                                    <em class="d-none d-sm-inline ri-menu-2-line me-1"></em>
                                    <span>
                                        <span class="d-none d-md-inline"></span>Hành Động Thêm </span>
                                    <em class="dd-indc icon ni ni-chevron-right"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li>
                                            <a href="javascript:;" class="truncate-all-product">
                                                <span><i class="ri-close-large-line me-1 text-danger"></i>Xoá All Đơn Hàng</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="truncate-all-history-product">
                                                <span><i class="ri-close-large-line me-1 text-warning"></i>Xoá All Lịch Sử Mua</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
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
                                class ListProducts extends DatabaseConnection 
                                 {
                                    public function ListProducts() {
                                        global $user;
                                        if ($user['rank'] === 'partner') {
                                            $partner = "WHERE wp.taikhoan = '{$user['username']}' ";
                                        } else {
                                            $partner ='';
                                        }
                                        $oOo = mysqli_query(self::ThanhDieuDB(),"SELECT wp.*, u.username,u.avatar
                                        FROM ws_products wp 
                                        JOIN users u ON wp.taikhoan = u.username 
                                        $partner
                                        ORDER BY wp.ngaydang DESC;
                                        ");
                                        if ($oOo) {?>
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head text-nowrap">
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">STT</span>
                                                </th>
                                                <th class="nk-tb-col sorting">
                                                    <span class="sub-text">Người Bán</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Tiêu Đề</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg sorting">
                                                    <span class="sub-text">Giá Bán</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-lg sorting">
                                                    <span class="sub-text">Lượt Mua</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting" style="width:160px;">
                                                    <span class="sub-text">Hình Thu Nhỏ</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md sorting">
                                                    <span class="sub-text">Thời Gian</span>
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
                                            while ($product = mysqli_fetch_assoc($oOo)) { ?>
                                            <tr class="nk-tb-item odd">
                                                <td class="nk-tb-col nk-tb-col-check sorting_1">
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox notext">
                                                        <?=$stt?></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-dim-primary d-sm-flex">
                                                            <img class="ws-avatar-1"
                                                                src="<?=Avatar($product['username'], $product['avatar'])?>"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span class="tb-amount"><a href="/details/<?=$product['slug']?>"
                                                            target="_blank"
                                                            rel="noopener noreferrer"><?=$product['tieude']?></a></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span><?=FormatNumber::TD($product['giatien'])?>đ</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span><?=ProductManager::CurrentProductHistory($product['id'])?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <div class="user-card" style="width:45px;">
                                                        <img data-fancybox=""
                                                            style="border-radius:5px!important;cursor:pointer;"
                                                            src="/<?= __IMG__ ?>/uploads/t/<?=$product['hinhthunho']?>"
                                                            alt="Bằng chứng vi phạm">&ensp;
                                                    </div>
                                                </td>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg text-nowrap">
                                                    <span class="fs-12px time-ago"
                                                        data-timeago="<?=$product['ngaydang'];?>"><?=FormatTime::TD($product["ngaydang"])?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md text-nowrap product-status" data-product-id="<?= $product['id'] ?>">
                                                    <?php if($product['trangthai']=='1'):?>
                                                    <span class="badge badge-dim rounded-pill bg-outline-success">Hoạt Động</span>
                                                    <?php elseif($product['trangthai']=='0'): ?>
                                                    <span class="badge badge-dim rounded-pill bg-outline-warning">Tạm Ngừng Bán</span>
                                                    <?php endif; ?>
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
                                                                                href="#editProducts-<?=$product['id']?>"
                                                                                href="javascript:;">
                                                                                <em class="icon ni ni-pen"></em>
                                                                                <span>Sửa Đơn Hàng</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a class="delete-products"
                                                                                data-product-id="<?=$product['id']?>"
                                                                                href="javascript:;">
                                                                                <em class="icon ni ni-trash"></em>
                                                                                <span>Xoá Đơn Hàng</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <a class="discontinued-product"
                                                                                data-product-id="<?=$product['id']?>"
                                                                                href="javascript:;">
                                                                                <i class="ri-stop-circle-line me-2"></i>
                                                                                <span><?= $product['trangthai']==1 ? 'Ngừng Bán' : 'Mở Bán Lại' ?></span>
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
                                                id="editProducts-<?=$product['id']?>">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <a href="#" class="close" data-bs-dismiss="modal">
                                                            <em class="icon ni ni-cross-sm"></em>
                                                        </a>
                                                        <div class="modal-body modal-body-md">
                                                            <h5 class="modal-title">Sửa Lại Đơn Hàng
                                                                #<?=$product['id']?></h5>
                                                            <form class="re-edit-product form-validate is-alter mt-2">
                                                                <div class="row g-gs">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="hk-label">Tiêu Đề</label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" class="form-control"
                                                                                    name="tieu-de"
                                                                                    value="<?=THANHDIEU($product['tieude'])?>"
                                                                                    placeholder="Tiêu đề bài viết"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="hk-label">Giá
                                                                                Bán</label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="text"
                                                                                    class="form-control ws-sotien"
                                                                                    name="gia-ban"
                                                                                    value="<?=FormatNumber::TD($product['giatien'])?>"
                                                                                    placeholder="Giá sản phẩm" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Mô Tả</label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea name="content"
                                                                                    class="summernote-basic"><?=$product['noidung']?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="download-url">Liên Kết Tải
                                                                                Xuống</label>
                                                                            <div class="form-control-wrap">
                                                                                <div class="form-icon form-icon-right">
                                                                                    <em
                                                                                        class="icon ni ni-link-alt"></em>
                                                                                </div>
                                                                                <input type="url" class="form-control"
                                                                                    name="download-url"
                                                                                    value="<?=$product['download_url']?>"
                                                                                    placeholder="https://mediafire.com/xxxx"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="action"
                                                                        value="re-edit-product">
                                                                    <input type="hidden" name="product-id"
                                                                        value="<?=$product['id']?>">
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
                                        (new ListProducts())->ListProducts();
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