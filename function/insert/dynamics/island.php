<div class="my-0">
    <label class="nui-label pb-4 text-[0.825rem]">Chọn Kiểu Tai Thỏ / Dynamics <span class="cursor-pointer"
            data-nui-tooltip="Viên thuốc iPhone 16 Pro Max"><i class="ri-question-line"></i></span></label>
    <div class="flex flex-wrap items-center gap-4 mt-0">
        <?php foreach (['1', '2', '3', '4'] as $dymamics) : ?>
        <div class="nui-radio nui-radio-primary gap-2" data-nui-tooltip="Dynamic Island <?=$dymamics?>">
            <div class="nui-radio-outer">
                <input name="dynamics" type="radio" class="nui-radio-input" value="<?=strtolower($dymamics)?>"
                    <?=$dymamics=== '2' ? 'checked' : '' ?>>
                <div class="nui-radio-inner"></div>
                <div class="nui-radio-dot"></div>
            </div>
            <div class="nui-radio-label-wrapper flex items-center pointer-events-none select-none">
                <img style="margin-top: -3px;" width="100" src="/<?= __IMG__ ?>/phoi/dynamics/<?=$dymamics?>.png?v=1"
                    alt="Dynamic Island / <?=$dymamics?>">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="my-0 mt-2 text-nowrap">
    <label class="nui-label pb-4 text-[0.825rem]">Ẩn/Hiện Chức Năng <span class="cursor-pointer"
            data-nui-tooltip="Tắt / Bật Dynamic Island - Phần Trăm Pin"><i class="ri-question-line"></i></span></label>
    <div class="flex flex-row gap-2">
        <label class="nui-switch-ball nui-switch-ball-primary flex items-center" for="dynamicsIsland">
            <span class="nui-switch-ball-outer">
                <input type="checkbox" class="nui-switch-ball-input peer" name="control-dynamic" id="dynamicsIsland">
                <span class="nui-switch-ball-handle"></span>
                <span class="nui-switch-ball-track"></span>
                <svg aria-hidden="true" viewBox="0 0 17 12" class="nui-switch-ball-icon">
                    <path fill="currentColor"
                        d="M16.576.414a1.386 1.386 0 0 1 0 1.996l-9.404 9.176A1.461 1.461 0 0 1 6.149 12c-.37 0-.74-.139-1.023-.414L.424 6.998a1.386 1.386 0 0 1 0-1.996 1.47 1.47 0 0 1 2.046 0l3.68 3.59L14.53.414a1.47 1.47 0 0 1 2.046 0z">
                    </path>
                </svg>
            </span>
            <span class="nui-switch-ball-dual-label">
                <span class="nui-label fs-14px text-gray-500">Dynamics Island</span>
            </span>
        </label>
        <div class="func-addon">
        <span class="text-[0.825rem] text-gray-500">|</span>
        </div>
        <label class="nui-switch-ball nui-switch-ball-success flex items-center" for="percent-pin">
            <span class="nui-switch-ball-outer">
                <input type="checkbox" class="nui-switch-ball-input peer" name="percent-pin" id="percent-pin">
                <span class="nui-switch-ball-handle"></span>
                <span class="nui-switch-ball-track"></span>
                <svg aria-hidden="true" viewBox="0 0 17 12" class="nui-switch-ball-icon">
                    <path fill="currentColor"
                        d="M16.576.414a1.386 1.386 0 0 1 0 1.996l-9.404 9.176A1.461 1.461 0 0 1 6.149 12c-.37 0-.74-.139-1.023-.414L.424 6.998a1.386 1.386 0 0 1 0-1.996 1.47 1.47 0 0 1 2.046 0l3.68 3.59L14.53.414a1.47 1.47 0 0 1 2.046 0z">
                    </path>
                </svg>
            </span>
            <span class="nui-switch-ball-dual-label">
                <span class="nui-label fs-14px text-gray-500">% Pin</span>
            </span>
        </label>
        <!---->
    </div>
</div>