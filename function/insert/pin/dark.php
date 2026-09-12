<div class="my-0 pin-dark">
    <label class="nui-label pb-4 text-[0.825rem]">Dung Lượng Pin <span class="cursor-pointer" data-nui-tooltip="Chọn dung lượng pin theo nhu cầu"><i class="ri-question-line"></i></span></label>
    <div class="flex flex-wrap items-center gap-4">
        <?php foreach ($pins = [10,13,16,17,20,21,24,32,34,42,48,52,59,62,68,71,74,75,76,81,83,86,90,93] as $pin): ?>
        <div class="nui-radio nui-radio-primary gap-2" data-nui-tooltip="Dung lượng pin <?=$pin?>%">
            <div class="nui-radio-outer">
                <input id="pin-<?=$pin?>" name="pin" type="radio" class="nui-radio-input" value="<?=$pin?>" <?= $pin == 42 ? 'checked' : null?>>
                <div class="nui-radio-inner"></div>
                <div class="nui-radio-dot"></div>
            </div>
            <div class="nui-radio-label-wrapper flex items-center pointer-events-none select-none">
                <img class="icon-pin" src="/<?= __IMG__ ?>/phoi/pin/dark/<?=$pin?>.png" alt="Pin <?=$pin?>%">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
