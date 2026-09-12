<?php $options_header = ['title' => 'Tạo Fake Vé Lên Máy Bay Loại 2']; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<main>
    <div class="container">
        <div class="flex flex-col md:flex-row gap-4 pb-5">
            <div class="w-full md:w-3/4">
                <form class="hk-fake-velenmaybay3 hk-refresh-form space-y-6">
                    <fieldset class="relative">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-1 gap-3 nui-card nui-card-rounded-lg nui-card-default relative p-5 md:mx-0 shadow-lg border-none">
                            <legend class="mb-6-none">
                                <p class="nui-heading nui-heading-md nui-weight-bold nui-lead-none" tag="h3"><i
                                        class="ri-bank-fill me-1"></i> Fake Vé Lên Máy Bay Loại 2</p>
                                <span
                                    class="nui-text nui-content-xs nui-weight-normal nui-lead-normal text-muted-400">Hãy
                                    nhập đầy đủ thông tin để tạo vé lên máy bay</span>
                            </legend>
                            
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="2" for="cua">CỬA</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="cua"
                                                placeholder="Ví dụ: 01" value="01" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="50" for="ghichu">GHI CHÚ</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="ghichu"
                                                placeholder="Ví dụ: 133/SGN/VAOB679" value="133/SGN/VAOB679" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="8" for="nam">GIỜ</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="nam"
                                                placeholder="Ví dụ: 19:50" value="<?=date('H:i')?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="3" for="tg">GHẾ</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="tg"
                                                placeholder="Ví dụ: 24H" value="24H" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                            <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="4" for="no">NO</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="no"
                                                placeholder="Ví dụ: 133" value="133" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="9" for="chuyenbay">CHUYẾN BAY</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="chuyenbay"
                                                placeholder="Ví dụ: VN123" value="VN123" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="5" for="khu">KHU</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="khu"
                                                placeholder="Ví dụ: 1" value="1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="9" for="date">NGÀY</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="date"
                                                placeholder="Ví dụ: 24APR" value="24APR" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="40" for="ten">HỌ VÀ TÊN</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="ten"
                                                placeholder="Ví dụ: TRAN/HOANG ANH" value="TRAN/HOANG ANH" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="50" for="ditu">NƠI ĐI</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="ditu"
                                                placeholder="Ví dụ: SGN" value="SGN" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="50" for="den">NƠI ĐẾN</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="den"
                                                placeholder="Ví dụ: SINGAPORE" value="SINGAPORE" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="15" for="tkne">TKNE</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="tkne"
                                                placeholder="Ví dụ: <?=WsRandomString::Number(13)?>" value="<?=WsRandomString::Number(13)?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                                    <label class="nui-input-label" data-limit-text="15" for="deptime">DEP TIME</label>
                                    <div class="nui-input-outer">
                                        <div>
                                            <input type="text" class="nui-input" name="deptime"
                                                placeholder="Ví dụ: <?=date('H:i')?>" value="<?=date('H:i')?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/vip.status.php');?>
                            <div class="col-span-1">
                            </div>
                            <button type="submit"
                                        class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-primary w-full sm:w-32">
                                        <i class="ri-check-line me-2"></i>Tạo Ngay
                                    </button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="w-full card-demo-bill hidden md:block">
                <div class="col-span-6 sm:col-span-3">
                    <div class="router-link-active router-link-exact-active group relative flex w-full flex-col overflow-hidden rounded-2xl kq-bill">
                        <?=$Bill->Demo('https://files.catbox.moe/khb5a5.png');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>