<?php $options_header = ['title' => 'Tạo Bill Fake OKX']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-okx hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Tạo Bill OKX </p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo bill</span>
                            </legend>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="sotienchuyen">Số Tiền Rút</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="sotienchuyen"
                                                placeholder="Ví dụ: 100000000"
                                                 value="1000000000" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="35" for="diachi">Địa Chỉ</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="diachi"
                                                placeholder="Ví dụ: <?= WsRandomString::AlphaNumeric(33) ?>"
                                                value="<?= WsRandomString::AlphaNumeric(33) ?>"required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="68" for="idgiaodich">ID Giao Dịch</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="idgiaodich"
                                                placeholder="Ví dụ: <?= WsRandomString::AlphaNumeric(67) ?>"
                                                value="<?= WsRandomString::AlphaNumeric(67) ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="30" for="phimangluoi">Phí</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="phimangluoi"
                                                placeholder="Ví dụ: 1" 
                                                 value="1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="9" for="mathamchieu">Mã Tham Chiếu</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="mathamchieu"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(9)?>" 
                                                 value="<?=WsRandomString::Number(9)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="5" for="thoigiantrendt">Thời Gian
                                        Trên
                                        ĐT </label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigiantrendt"
                                            value="<?=date('H:i')?>" placeholder="Ví dụ: 00:00" required>
                                        <div class="nui-input-icon">
                                            <i class="ri-time-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div
                                    class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                    <label class="nui-input-label" data-limit-text="19" for="thoigianchuyen">Thời Gian Chuyển </label>
                                    <div class="nui-input-outer">
                                        <input type="text" class="nui-input" name="thoigianchuyen"
                                            value="<?=date('H:i:s m-d-Y')?>" placeholder="Ví dụ: H:i:s m-d-Y" required>
                                        <div class="nui-input-icon">
                                            <i class="ri-time-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/vip.status.php');?>
                            <div class="col-span-1">
                                <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/modal/bill-setting.php');?>
                            </div>
                         <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/taobill.php');?>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('https://files.catbox.moe/ebua74.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>