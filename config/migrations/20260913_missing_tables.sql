-- Migration: Bo sung cac bang con thieu vao CSDL
CREATE TABLE IF NOT EXISTS `ws_subdomain` (
  `domain_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `ten_mien` varchar(255) NOT NULL,
  `hauto` varchar(255) NOT NULL,
  `loai` varchar(50) NOT NULL,
  `gia_tri` varchar(255) NOT NULL,
  `ngaytao` datetime NOT NULL DEFAULT current_timestamp(),
  `ngaycapnhat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trangthai` enum('active','banned','pending') DEFAULT 'active',
  PRIMARY KEY (`domain_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `ws_spamsms` (
  `spamsms_id` int(11) NOT NULL AUTO_INCREMENT,
  `taikhoan` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `giatien` int(11) NOT NULL DEFAULT 0,
  `maychu` varchar(255) NOT NULL,
  `thoigian` datetime NOT NULL DEFAULT current_timestamp(),
  `thoigiancho` datetime DEFAULT current_timestamp(),
  `trangthai` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`spamsms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `ws_history_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `giamua` int(11) NOT NULL DEFAULT 0,
  `magiaodich` varchar(50) NOT NULL,
  `ngaymua` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `taikhoan` (`taikhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `ws_scaninfo` (
  `scaninfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `loai` varchar(100) NOT NULL,
  `giatien` int(11) NOT NULL DEFAULT 0,
  `ngaytao` datetime DEFAULT current_timestamp(),
  `ngaycapnhat` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ghichu` text DEFAULT NULL,
  `trangthai` enum('success','pending','failed') NOT NULL DEFAULT 'pending',
  `giatri` varchar(255) NOT NULL,
  PRIMARY KEY (`scaninfo_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
