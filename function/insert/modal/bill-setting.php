<div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm text-nowrap">
    <div class="nui-input-outer">
        <a class="nui-button nui-button-sm nui-button-rounded-full nui-button-solid nui-button-default w-full sm:w-36 select-none"
            <?=$isLogin->check() ? 'target-modal="#bill-setting"' : 'onclick="FuiToast.error(`Vui lòng đăng nhập để sử dụng.`)"' ?>>
            <i class="ri-settings-4-line"></i>
            <span class="hidden sm:block">Chỉnh thông số</span>
            <span class="block md:hidden">Tinh chỉnh Pin/Wifi/Tai thỏ</span>
        </a>
    </div>
</div>
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center modal z-[200] hidden select-none"
    id="bill-setting">
    <div class="flex min-h-full items-center justify-center p-4 text-center td-croll-modal-bill">
        <div
            class="dark:bg-muted-800 w-full bg-white text-left align-middle shadow-xl transition-all rounded-md max-w-xl z-[9999]">
            <div class="flex w-full items-center justify-between p-4">
                <h3 class="text-gray-900 text-lg font-medium"><i class="ri-settings-3-line"></i> Cài Đặt Phụ Trợ
                    <!-- <span id="title-bill"><?=$Bill->setting() ? 'Dark' : 'Light'?></span> -->
                    <span id="title-bill">🤗</span>
                </h3>
                <button type="button"
                    class="nui-button-close nui-button-sm nui-button-rounded-full nui-button-default close-modal">
                    <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-button-icon">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M18 6 6 18M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4">
           <div class="nui-message nui-message-rounded-sm nui-message-danger nui-has-icon">
                <div class="nui-message-icon-outer">
                <i class="ri-information-line"></i>
                </div>
                <span class="nui-message-inner-text">
                    <div class="text-xs"><strong>Nếu bạn gặp sự cố lỗi khi đang tạo bill hoặc cần góp ý cho website, đừng ngần ngại liên hệ cho admin để khắc phục lỗi.</strong>
                    </div>
                </span>
            </div>
           </div>
            <div class="flex w-full items-center justify-between ml-3 gap-x-2">
                <div class="ml-15">
                    <div class="col-span-12">
                     <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/pin/main.php'); ?>
                    </div>
                    <div
                        class="border-muted-200 dark:border-muted-700 mb-4 space-y-5 border-b-2 border-dashed px-6 pb-6">
                    </div>
                    <div class="col-span-12">
                        <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/wifi/main.php');?>
                    </div>
                    <div
                        class="border-muted-200 dark:border-muted-700 mb-4 space-y-5 border-b-2 border-dashed px-6 pb-6">
                    </div>
                    <div class="col-span-12">
                        <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/dynamics/island.php');?>
                    </div>
                    <div class="col-span-12 mt-4">
                        <?php include($_SERVER['DOCUMENT_ROOT'].'/function/insert/button/vip.status.php');?>
                    </div>
                </div>
                <img src="//i.imgur.com/PDuYl0w.png"
                    class="pointer-events-none select-none <?=isMobile() ? 'hidden' : 'block'?>" width="240">
            </div>
            <div class="flex w-full items-center gap-x-2 justify-end">
                <div class="p-4 md:p-6">
                    <div class="flex gap-x-2">
                        <button type="button" target-modal="close" data-modal-type="setting-bill"
                            class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-default"><i
                                class="ri-check-line me-2"></i>Xác Nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>