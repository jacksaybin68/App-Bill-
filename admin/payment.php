<?php require_once('partials/head.php');?>
<?php require_once('partials/nav.php');?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Cài Đặt Nạp Tiền</h3>
                            <div class="nk-block-des text-soft">
                                <p>Bạn có thể sửa đổi cài đặt nạp tiền ở đây.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a data-bs-toggle="modal" href="#addTransfer" class="btn btn-icon btn-primary d-md-none">
                                <em class="icon ni ni-plus"></em>
                            </a>
                            <a data-bs-toggle="modal" href="#addTransfer"
                                class="btn btn-primary d-none d-md-inline-flex">
                                <i class="ri-add-line fs-15px"></i>&nbsp;
                                <span>Thêm Mới</span>
                            </a>&nbsp;
                            <a class="btn btn-icon btn-danger d-md-none truncate-transfer">
                                <em class="icon ni ni-trash-alt"></em>
                            </a>
                            <a class="btn btn-danger d-none d-md-inline-flex truncate-transfer">
                                <i class="ri-delete-bin-2-line"></i>&ensp;
                                <span>Xoá All</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner table-responsive dt-bootstrap4">
                            <table class="table table-tranx datatable-init text-nowrap">
                                <?php
                                class Payments extends DatabaseConnection 
                                {
                                 public function Payments() 
                                {
                                global $cut,$banks;
                                $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT * FROM ws_transfer ORDER BY transfer_id ASC");
                                if ($oOo) {?>
                                <thead>
                                    <tr class="text-nowrap">
                                        <th scope="col">STT</th>
                                        <th scope="col">Số Tài Khoản</th>
                                        <th scope="col">Chủ Tài Khoản</th>
                                        <th scope="col">Ngân Hàng</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Callback</th>
                                        <th scope="col">Kiểu Bank</th>
                                        <th scope="col">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($transfer = mysqli_fetch_assoc($oOo)) { ?>
                                    <tr class="fw-bold">
                                        <th scope="row">#<?=$transfer['transfer_id']?></th>
                                        <td><?=$transfer['stk']?></td>
                                        <td><?=$transfer['chutaikhoan']?></td>
                                        <td><?=$transfer['nganhang']?></td>
                                        <td>
                                            <div class="user-avatar sq"
                                                style="<?=$transfer['nganhang']==='Momo' ? 'width:30px;' : 'width:100px;margin-left:-20px;margin-top:-10px'?>">
                                                <img src="<?=$transfer['logo']?>" alt="">
                                            </div>
                                        </td>
                                        <td><a href="<?=$transfer['callback']?? '#null'?>" target="_blank">
                                                <?=$cut->characters($transfer['callback'] ?? '',40)?>
                                            </a></td>
                                        <td><span
                                                class="badge bg-<?=$transfer['kieubank']==='tudong' ? 'primary' : 'gray'?>"><?=$transfer['kieubank']==='tudong' ? 'Tự Động' : 'Thủ Công'?></span>
                                        </td>
                                        <td><a class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                                href="#editTransfer-<?=$transfer['transfer_id']?>"><em
                                                    class="icon ni ni-edit"></em>&ensp;Sửa</a>&ensp;
                                        <a data-transfer-id="<?=$transfer['transfer_id']?>" class="btn btn-outline-danger btn-sm delete-transfer" href="#"><em class="icon ni ni-trash"></em>&ensp;Xoá</a>
                                     </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" role="dialog"
                                        id="editTransfer-<?=$transfer['transfer_id']?>">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <a href="#" class="close" data-bs-dismiss="modal">
                                                    <em class="icon ni ni-cross-sm"></em>
                                                </a>
                                                <div class="modal-body modal-body-md">
                                                    <h5 class="modal-title"><span class="text-success"><em
                                                                class="icon ni ni-edit"></em></span>&ensp;Chỉnh Sửa Ngân
                                                        Hàng</h5>
                                                    <form class="mt-4 edit-transfer-bank">
                                                        <div class="row g-gs">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ten-ngan-hang">Tên
                                                                        Ngân Hàng (<b class="text-danger">*</b>)</label>
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select js-select2"
                                                                            data-search="on" name="ten-ngan-hang"
                                                                            data-ui="clean">
                                                                            <option value="Momo">M_Service - Momo</option>
                                                                            <?php foreach ($banks as $pt2) { 
                                                                            $pt = THANHDIEU($pt2['shortName'] ?? 'N/A');
                                                                            $is_bank = ($pt === THANHDIEU($transfer['nganhang'])) ? 'selected' : '';
                                                                            ?>
                                                                            <option value="<?= $pt ?>" <?=$is_bank?>>
                                                                                <?= THANHDIEU($pt2['bin'].' - '.$pt2['shortName'] ?? 'Lỗi callback list bank') ?>
                                                                            </option>
                                                                            <?php } ?>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="chu-tai-khoan">Chủ
                                                                        Tài Khoản (<b class="text-danger">*</b>)</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="chu-tai-khoan"
                                                                            value="<?=$transfer['chutaikhoan']?>"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="stk">Số Tài Khoản (<b
                                                                            class="text-danger">*</b>)</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="number" class="form-control"
                                                                            name="stk" value="<?=$transfer['stk']?>"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ten-ngan-hang">Kiểu
                                                                        Bank (<b class="text-danger">*</b>)</label>
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select js-select2"
                                                                            name="kieubank" data-ui="clean">
                                                                            <option
                                                                                <?=THANHDIEU($transfer['kieubank']==='thucong') ? 'selected' : ''?>
                                                                                value="thucong">Thủ Công - Cộng Tay
                                                                            </option>
                                                                            <option
                                                                                <?=THANHDIEU($transfer['kieubank']==='tudong') ? 'selected' : ''?>
                                                                                value="tudong">Tự Động - Auto Bank
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 <?=THANHDIEU($transfer['kieubank']!=='tudong') ? 'api-bank' : ''?>">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="stk">API Bank (<b
                                                                            class="text-danger">*</b>)</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="url" class="form-control"
                                                                            name="callback" value="<?=$transfer['callback'] ?? ''?>" required
                                                                            placeholder="Vui lòng nhập link api bank">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <ul
                                                                    class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                                    <li>
                                                                        <input type="hidden" name="action"
                                                                            value="edit-transfer-bank">
                                                                        <input type="hidden" name="transfer-id"
                                                                            value="<?=$transfer['transfer_id']?>">
                                                                        <button type="submit" class="btn btn-primary"><i
                                                                                class="ri-checkbox-circle-line fs-15px"></i>&nbsp;Cập
                                                                            Nhật</button>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" data-bs-dismiss="modal"
                                                                            class="link link-light"
                                                                            data-bs-dismiss="modal">Huỷ Bỏ</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </tbody>
                                <?php }
                                      }
                                }
                             (new Payments())->Payments();?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="addTransfer">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <div class="alert alert-primary"><em class="fs-17px icon ni ni-alert-c"></em>&nbsp;
                    <strong>Mẹo:</strong> Chỉ chọn kiểu bank tự động khi ngân hàng bạn chọn đã có
                    api bank, thủ công là cộng tay khi không có api bank.
                </div>
                <h5 class="modal-title"><span class="text-success"><i class="ri-bank-line"></i></span>&ensp;Thêm
                    Ngân Hàng</h5>
                <form class="mt-4 is-alter form-validate add-transfer-bank">
                    <div class="row g-gs">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="chu-tai-khoan">Chủ Tài Khoản (<b
                                        class="text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="chu-tai-khoan"
                                        placeholder="Vui lòng tên chủ tài khoản" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="stk">Số Tài Khoản (<b class="text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="stk"
                                        placeholder="Vui lòng nhập số tài khoản" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="ten-ngan-hang">Tên Ngân Hàng (<b
                                        class="text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" data-search="on" name="ten-ngan-hang"
                                        data-ui="clean">
                                        <option value="Momo">M_Service - Momo</option>
                                        <?php foreach ($banks as $bank) {?>
                                        <option value="<?=THANHDIEU($bank['shortName'] ?? 'N/A')?>">
                                            <?=THANHDIEU($bank['bin'].' - '.$bank['shortName'] ?? 'Lỗi callback list bank')?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="ten-ngan-hang">Kiểu Bank (<b
                                        class="text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" name="kieubank" data-ui="clean">
                                        <option value="thucong">Thủ Công - Cộng Tay</option>
                                        <option value="tudong">Tự Động - Auto Bank
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 api-bank">
                            <div class="form-group">
                                <label class="form-label" for="stk">API Bank (<b class="text-danger">*</b>)</label>
                                <div class="form-control-wrap">
                                    <input type="url" class="form-control" name="callback" required
                                        placeholder="Vui lòng nhập link api bank">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <input type="hidden" name="action" value="add-transfer-bank">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="ri-add-circle-line fs-15px"></i>&nbsp;Thêm Mới</button>
                                </li>
                                <li>
                                    <a href="#" data-bs-dismiss="modal" class="link link-light"
                                        data-bs-dismiss="modal">Huỷ Bỏ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('partials/foot.php'); ?>


