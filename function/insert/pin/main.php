<div class="my-0 pin-light">
    <div class="flex flex-wrap items-center gap-4">
        <div class="nui-radio nui-radio-primary gap-2">
            <div class="nui-radio-label-wrapper flex items-center select-none">
                <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm">
                    <div
                        class="nui-input-number-wrapper nui-input-number-default nui-input-number-md nui-input-number-rounded-sm grow">
                        <label class="nui-label pb-4 text-[0.825rem]">Dung Lượng Pin / 1 ↠ 100 <span
                                class="cursor-pointer" data-nui-tooltip="Chọn dung lượng pin theo nhu cầu"><i
                                    class="ri-question-line"></i></span></label>
                        <div class="nui-input-number-outer">
                            <input type="number" class="nui-input-number w-full" maxlength="3" name="pin"
                                placeholder="Nhập dung lượng pin..." value="<?=rand(1,100)?>" required>
                            <div class="nui-input-number-buttons" data-type-battery="pin">
                                <button type="button" btn="destroy"><i class="ri-close-line"></i></button>
                                <button type="button" btn="minus"><i class="ri-subtract-line"></i></button>
                                <button type="button" btn="plus"><i class="ri-add-line"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>