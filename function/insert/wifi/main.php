<div class="my-0">
    <label class="nui-label pb-4 text-[0.825rem]">Tuỳ Chọn Tín Hiệu <span class="cursor-pointer"
            data-nui-tooltip="Tuỳ chọn mạng / wifi / sóng"><i class="ri-question-line"></i></span></label>
            <div class="grid grid-cols-4 md:grid-cols-6 gap-4">
    <?php 
    foreach (['LTE', '3G', '4G', '5G', 'wifi-0','wifi-1', 'wifi-2', 'wifi-3'] as $nw) : 
        $is_wifi = in_array($nw, ['wifi-0','wifi-1', 'wifi-2', 'wifi-3']);
        $label = $is_wifi ? "WiFi ".preg_replace('/^wifi-/', '', $nw)." Vạch" : "Mạng $nw";
    ?>
    <div class="nui-radio nui-radio-primary gap-2" data-nui-tooltip="<?= $label ?>">
        <div class="nui-radio-outer">
            <input name="tin-hieu" type="radio" class="nui-radio-input" value="<?= strtolower($nw) ?>" <?=$nw=== 'wifi-3' ? 'checked' : '' ?>>
            <div class="nui-radio-inner"></div>
            <div class="nui-radio-dot"></div>
        </div>
        <?php if (!$is_wifi):?>
        <div class="nui-radio-label-wrapper flex items-center pointer-events-none select-none">
            <label for="<?= strtolower($nw) ?>" class="relative top-0.5 text-xs nui-radio-label-text"><?=$nw?></label>
        </div>
        <?php endif; ?>
        <?php if ($is_wifi):?>
        <div class="nui-radio-label-wrapper flex items-center pointer-events-none select-none">
            <img class="icon-pin w-6 h-6" src="/<?= __IMG__ ?>/phoi/networks/light/<?=$nw?>.png" alt="WiFi <?=preg_replace('/^wifi-/', '', $nw)?>">
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
    <div class="flex flex-wrap items-center gap-4 mt-4">
        <?php foreach (['1', '2', '3', '4'] as $vs) : ?>
        <div class="nui-radio nui-radio-primary gap-2" data-nui-tooltip="Vạch Sóng (Cột Sóng) / <?=$vs?>">
            <div class="nui-radio-outer">
                <input name="vachsong" type="radio" class="nui-radio-input" value="<?=strtolower($vs)?>"
                    <?= $vs === '3' ? 'checked' : '' ?>>
                <div class="nui-radio-inner"></div>
                <div class="nui-radio-dot"></div>
            </div>
            <div class="nui-radio-label-wrapper flex items-center pointer-events-none select-none">
                <img class="icon-pin" src="/<?= __IMG__ ?>/phoi/networks/light/nw-<?=$vs?>.png" alt="Vạch Sóng (Cột Sóng) / <?=$vs?>">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>