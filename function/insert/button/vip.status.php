<?php if($TD->Setting('limit-bill') > 0 || ($plans->TD('tengoi', $taikhoan) || isset($user) && in_array($user['rank'],['admin','leader','partner']))) {?>
<div class="col-span-1 select-none">
    <span
        class="text-yellow-500 bill-info dark:text-yellow-400 bg-muted-200 dark:bg-primary-700 inline-flex h-6 items-center justify-center rounded-full px-3 font-sans text-xs font-medium">Đang
        lấy dữ liệu...</span>
</div>
<?php }?>