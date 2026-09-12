<?php
class ProductViewer extends DatabaseConnection 
{
    public static function Products($limit = 12, $page = 1) 
    {
        $offset = ($page - 1) * $limit;
        
        $wt = self::ThanhDieuDB()->prepare("SELECT * FROM ws_products ORDER BY id DESC LIMIT ? OFFSET ?");
        
        if ($wt) 
        {
            $wt->bind_param("ii", $limit, $offset);
            $wt->execute();
            $oOo = $wt->get_result();
            return $oOo;
        }
        return null;
    }
    public static function TotalBuy() 
    {
        $oOo = self::ThanhDieuDB()->query("SELECT COUNT(*) as total FROM ws_history_products");
        if ($oOo) {
            $data = $oOo->fetch_assoc();
            return $data['total']; 
        }
        return 0;
    }
    public static function TotalPurchases($account) 
    {
        $wt = self::ThanhDieuDB()->prepare("SELECT COUNT(*) as total FROM ws_history_products WHERE taikhoan = ?");
        if ($wt) 
        {
            $wt->bind_param("s", $account); 
            $wt->execute();
            $oOo = $wt->get_result();
            if ($oOo) 
            {
                $data = $oOo->fetch_assoc();
                return $data['total'];
            }
        }
        return 0;
    }
}

$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalProducts = ProductViewer::ThanhDieuDB()->query("SELECT COUNT(*) as total FROM ws_products")->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $limit);