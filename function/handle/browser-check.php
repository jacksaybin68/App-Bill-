<?php if (!$browsers->check('chrome', 'safari', 'coccoc')):?>
<div id="modal-browser-checked" role="dialog" class="relative z-[9999]">
    <div class="bg-muted-800/70 dark:bg-muted-900/80 fixed inset-0"></div>
    <div class="fixed inset-0 select-none">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div class="dark:bg-muted-800 w-full bg-white text-left align-middle shadow-xl transition-all rounded-md max-w-sm">
                <div class="flex w-full items-center justify-between p-4 md:p-6">
                    <h3 class="font-heading text-muted-900 text-lg font-medium leading-6 dark:text-white"> Browser Unsupported
                    </h3>              
                </div>
                <div class="md:p-4">
                    <div class="mx-auto w-full max-w-xs text-center pointer-events-none">
                        <div class="flex justify-center mb-4">
                            <img src="//i.imgur.com/ps2tOW4.png"
                                class="max-w-full h-16 rounded-full object-cover shadow-sm dark:border-transparent me-5"
                                alt="<?=$TD->Setting('name-site')?>">
                            <img src="//i.imgur.com/XmyaQN0.png"
                                class="max-w-full h-16 rounded-full object-cover shadow-sm dark:border-transparent me-5"
                                alt="<?=$TD->Setting('name-site')?>">
                            <img src="//i.imgur.com/itf1Rpj.png"
                                class="max-w-full h-16 rounded-full object-cover shadow-sm dark:border-transparent me-5"
                                alt="<?=$TD->Setting('name-site')?>">
                        </div>
                        <p class="font-alt text-muted-500 dark:text-muted-300 text-sm leading-5 <?=isMobile() ? 'mb-4' : 'mb-2'?>">Rất tiếc trình duyệt của bạn không được nền tảng chúng tôi hỗ trợ, để trải nghiệm website 1 cách tốt nhất vui lòng sử dụng trình duyệt phổ biến như <b>Chrome/Safari/Cốc Cốc</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif?>