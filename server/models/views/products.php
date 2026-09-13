<?php
/**
 * ProductManager Model
 * Quản lý danh mục và chi tiết sản phẩm / mã nguồn
 */
class ProductManager extends DatabaseConnection 
{
    protected $data = null;

    public function __construct($slug = null) 
    {
        if ($slug === null) {
            $slug = $_GET['slug'] ?? '';
        }
        if (!empty($slug)) {
            $stmt = self::ThanhDieuDB()->prepare("SELECT * FROM ws_products WHERE slug = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $slug);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res && $res->num_rows > 0) {
                    $this->data = $res->fetch_assoc();
                }
            }
        }
    }

    public function exists() 
    {
        return !empty($this->data);
    }

    public function col($column) 
    {
        return $this->data[$column] ?? null;
    }

    public static function Products($limit = 8, $page = 1) 
    {
        $limit = max(1, (int)$limit);
        $page = max(1, (int)$page);
        $offset = ($page - 1) * $limit;
        $stmt = self::ThanhDieuDB()->prepare("SELECT * FROM ws_products WHERE trangthai = 1 ORDER BY id DESC LIMIT ? OFFSET ?");
        if ($stmt) {
            $stmt->bind_param("ii", $limit, $offset);
            $stmt->execute();
            return $stmt->get_result();
        }
        return null;
    }

    public static function TotalSoldAll() 
    {
        $res = self::ThanhDieuDB()->query("SELECT COUNT(*) as total FROM ws_history_products");
        if ($res && $row = $res->fetch_assoc()) {
            return (int)$row['total'];
        }
        return 0;
    }

    public static function TotalPurchases($account) 
    {
        if (empty($account)) return 0;
        $stmt = self::ThanhDieuDB()->prepare("SELECT COUNT(*) as total FROM ws_history_products WHERE taikhoan = ?");
        if ($stmt) {
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $row = $res->fetch_assoc()) {
                return (int)$row['total'];
            }
        }
        return 0;
    }

    public static function CheckPurchase($account, $productId) 
    {
        if (empty($account) || empty($productId)) return false;
        $stmt = self::ThanhDieuDB()->prepare("SELECT id FROM ws_history_products WHERE taikhoan = ? AND product_id = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param("si", $account, $productId);
            $stmt->execute();
            $res = $stmt->get_result();
            return ($res && $res->num_rows > 0);
        }
        return false;
    }

    public static function CleanInvalidHistory() 
    {
        self::ThanhDieuDB()->query("DELETE h FROM ws_history_products h LEFT JOIN ws_products p ON h.product_id = p.id WHERE p.id IS NULL");
    }
}
