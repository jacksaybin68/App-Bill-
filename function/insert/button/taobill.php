<div class="mt-auto flex flex-col-reverse text-end md:block md:space-x-3 gap-2 text-nowrap">
    <button type="submit" class="xem-truoc nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-muted w-full sm:w-32">
        <i class="ri-eye-line me-2"></i>Xem Trước
    </button>
    <button type="submit" class="nui-button nui-button-md nui-button-rounded-md nui-button-solid nui-button-lavender nui-button-primary w-full sm:w-32">
        <i class="ri-check-line me-1"></i> 
        <?php if (!$isLogin->check()) { ?>
            Tạo Bill Free
        <?php } elseif (is_array($user) && array_key_exists('rank', $user) && in_array($user['rank'], ['admin', 'leader']) || $plans->TD('tengoi', $taikhoan)) { ?>
            Tạo Bill Ngay
        <?php } else { 
            if (isset($user) && isset($user['sodu']) && $user['sodu'] >= $TD->Setting('giataobill')) { ?>
                Tạo Bill <?= FormatNumber::TD($TD->Setting('giataobill'), 2) ?>đ
            <?php } else { 
                if (!$freebill->checked($taikhoan, 2) && $TD->Setting('limit-bill') > 0) { ?>
                    Tạo Bill Free
                <?php } else { ?>
                    Tạo Bill <?= FormatNumber::TD($TD->Setting('giataobill'), 2) ?>đ
                <?php } 
            } 
        } ?>
    </button>
</div>