<div class="my-0 pin-light">
    <label class="nui-label pb-4 text-[0.825rem]">Dung Lượng Pin <span class="cursor-pointer" data-nui-tooltip="Chọn dung lượng pin theo nhu cầu"><i class="ri-question-line"></i></span></label>
    <div class="flex flex-wrap items-center gap-4">
      <?php //foreach ($pins = [17,22,23,31,33,37,39,41,44,46,49,52,56,57,59,65,69,71,74,76,79,81,86,87,92,94,100] as $pin): ?>
        <?php  foreach ($pins = [16,24,35,40,80,94] as $pin): ?>
        <div class="nui-radio nui-radio-primary gap-2" data-nui-tooltip="Dung lượng pin <?=$pin?>%">
            <div class="nui-radio-outer">
                <input id="pin-<?=$pin?>" name="pin" type="radio" class="nui-radio-input" value="<?=$pin?>" <?= $pin == 40 ? 'checked' : null?>>
                <div class="nui-radio-inner"></div>
                <div class="nui-radio-dot"></div>
            </div>
            <div class="nui-radio-label-wrapper flex items-center pointer-events-none select-none">
                <img class="icon-pin" src="/<?= __IMG__ ?>/phoi/pin/light/<?=$pin?>.png?v=2" alt="Pin <?=$pin?>%">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
