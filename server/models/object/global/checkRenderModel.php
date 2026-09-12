<?php
if ($SSC->check()) 
{
    exit(JSON_FORMATTER(["status" => -1, 'msg' => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
} 
if (!isset($_POST["xem-truoc"])||$_POST['xem-truoc']!=='yes'):
if (!in_array($user['rank'],['admin','leader','partner'])) 
{
    if ($plans->TD('tengoi', $taikhoan)) 
    {
        if ($limitbill->checked($taikhoan, $plans->TD('gioihanbill', $taikhoan))) 
        {
            exit(JSON_FORMATTER(["status" => -1, 'msg' => "Bạn đã tạo đủ số lượng ".$plans->TD('gioihanbill', $taikhoan)." bill của gói ".strtoupper($plans->TD('tengoi', $taikhoan))." ngày hôm nay, hãy quay lại vào ngày mai, hoặc có thể nâng cấp gói cao cấp hơn."]));
        } 
        TaoBillTheoGoi($taikhoan, $into, $plans->TD('tengoi', $taikhoan),$plans->TD('ngayhethan', $taikhoan));
    } 
    else 
    {
        if ($user['sodu'] >= $TD->Setting('giataobill')) 
        {
            TaoBillTheoSoDu($taikhoan, $TD->Setting('giataobill'), $user, $thanhdieudb, $into);
        } 
        else 
        {
            if ($TD->Setting('time-bill') > 0 && time() - strtotime($user['ngaythamgia']) < $TD->Setting('time-bill') * 60 * 60) 
            {
                exit(JSON_FORMATTER(["status" => -1, 'msg' => 'Để tránh lạm dụng & spam thì những tài khoản mới đăng ký hơn '.$TD->Setting('time-bill').' tiếng mới có thể sử dụng! Hoặc bạn có thể tới trang mua gói VIP để sử dụng mà không cần phải chờ đợi.']));
            }
            
            if (!$freebill->checked($taikhoan, $TD->Setting('limit-bill'))) 
            {
                TaoBillFree($taikhoan, $into);
            } 
            else 
            {
                $ll = $TD->Setting('limit-bill') > 0 ? 'Bạn đã tạo đủ '.$TD->Setting('limit-bill').' bill của gói miễn phí hôm nay rồi. Số dư của bạn cũng không đủ để tạo' : 'Số dư của bạn không đủ để tạo bill';
                exit(JSON_FORMATTER(["status" => -1, 'msg' => "".$ll.", vui lòng nạp thêm tiền vào tài khoản hoặc mua gói VIP để tiếp tục sử dụng dịch vụ."]));
            }
        }
    }
}
endif;
try 
{
    if (!preg_match('/^data:image\/(\w+);base64,/', $base64)) 
    {
        if (!in_array($user['rank'], ['admin', 'leader', 'partner']) && (!isset($_POST["xem-truoc"]) || $_POST['xem-truoc'] !== 'yes')) :
            HistoryFakebill($into, $taikhoan, $Bill, $base64, $namebill[0], $namebill[1]);
        endif;        
    }
    die(JSON_FORMATTER(["status" => 200, "msg" => "Tạo bill ".(isset($_POST["xem-truoc"])&&$_POST['xem-truoc']==='yes' ? 'xem trước ' :null)."thành công!", "blob" => $base64]));
} 
catch (Exception $e) 
{
    die(JSON_FORMATTER(["status" => -1, 'msg' => $e->getMessage()]));
}
