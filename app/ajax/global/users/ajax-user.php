<?php
/**
* Kết Nối CSDL
*/
require($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
/**
* @author Vương Thanh Diệu
*/
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/Watermark.php');
/**
* Xử Lý User Auth
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/authModel.php');
/**
* Fakebill Bill ACB New
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/acb-new.php');
/**
* Fakebill Bill VCB New
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vietcombank-new.php');
/**
* Fakebill Bill SHB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/shb.php');
/**
* Fakebill Bill BIDV Premier
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/bidv-premier.php');
/**
* Fakebill Bill Kiên Long Bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/kienlongbank.php');
/**
* Fakebill Bill LP Bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/lpbank.php');
/**
* Fakebill Bill NCB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/ncb.php');
/**
* Fakebill Bill ABbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/abbank.php');
/**
* Fakebill Bill Sài gòn bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/saigonbank.php');
/**
* Fakebill Bill Eximbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/eximbank.php');
/**
* Fakebill Bill Chính sách xã hội
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/chinhsachxahoi.php');
/**
* Fakebill Bill OCB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/ocb.php');
/**
* Fakebill Bill PVBank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/pvbank.php');
/**
* Fakebill Bill Namabank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/namabank.php');
/**
* Fakebill Số Dư Mb Priority
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/mb-priority.php');
/**
* Fakebill TP Bank New
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/tpbank-new.php');
/**
* Fakebill Worri
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/worribank.php');
/**
* Fakebill Sacombank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/sacombank.php');
/**
* Fakebill Shinhanbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/shinhanbank.php');
/**
* Fakebill Liobank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/liobank.php');
/**
* Fakebill Bidv
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/bidv.php');
/**
* Fake Số Dư Pg Bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/pgbank.php');
/**
* Fake Số Dư VCB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/vietcombank.php');
/**
* Fakebill ACB Privilege
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/acb-privilege.php');
/**
* Fakebill VIB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vibbank.php');
/**
* Fakebill VietBank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vietbank.php');
/**
* Fakebill VietinBankred
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vietinbankred.php');
/**
* Fakebill Seabank Premium
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/seabank-premium.php');
/**
* Fakebill HD Bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/hdbank.php');
/**
* Fakebill Viettel Money
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/viettel-money.php');
/**
* Fakebill BacABank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/bacabank.php');
/**
* Fakebill MBBank Priority
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/mbbank-priority.php');
/**
* Fakebill SeaBank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/seabank.php');
/**
* Fakebill MB Bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/mbbank.php');
/**
* Fakebill MB Bank Đơn Lưu
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/mbbank-donluu.php');
/**
* Fakebill MB Bank Tet
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/mbbank-tet.php');
/**
* Fakebill Vietcombank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vietcombank.php');
/**
* Fakebill Vietcombank Priority
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vietcombank-priority.php');
/**
* Fakebill Vietcombank Galaxy
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vietcombank-galaxy.php');
/**
* Fakebill Techcombank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/techcombank.php');
/**
* Fakebill Cake
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/cake.php');
/**
* Fakebill Vietinbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vietinbank.php');
/**
* Fakebill ACB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/acb.php');
/**
* Fakebill Momo
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/momo.php');
/**
* Fakebill Bvbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/bvbank.php');
/**
* Fakebill ZaloPay
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/zalopay.php');
/**
* Fakebill TPBank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/tpbank.php');
/**
* Fakebill MSB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/msb.php');
/**
* Fakebill Agribank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/agribank.php');
/**
* Fakebill Vpbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/vpbank.php');
/**
* Fakebill Sell Binance
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/sell-binance.php');
/**
* Fakebill Buy Binance
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/buy-binance.php');
/**
* Fakebill OKX
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bill/okx.php');
/**
* Fake Số Dư Vietinbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/vietinbank.php');
/**
* Fake Số Dư Momo
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/momo.php');
/**
* Fake Số Dư ACB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/acb.php');
/**
* Fake Số Dư CAKE
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/cake.php');
/**
* Fake Số Dư Zalopay
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/zalopay.php');
/**
* HandleMainModel
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/handleMainModel.php');
/**
* Fake Số Dư Mbbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/mbbank.php');
/**
* Fake Số Dư Techcombank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/techcombank.php');
/**
* Fake Số Dư Agribank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/agribank.php');
/**
* Fake Số Dư Tpbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/tpbank.php');
/**
* Fake Số Dư Vpbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/sodu/vpbank.php');
/**
* Fake BDSD Mbbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bdsd/mbbank.php');
/**
* Fake BDSD Techcombank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/bdsd/techcombank.php');
/**
* Fake Màn Hình Khoá MB Bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/mbbank.php');
/**
* Fake Màn Hình Khoá ACB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/acb.php');
/**
* Fake Màn Hình Khoá Momo
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/momo.php');
/**
* Fake Màn Hình Khoá Binance
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/binance.php');
/**
* Fake Màn Hình Khoá Vietcombank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/vietcombank.php');
/**
* Fake Màn Hình Khoá Zalopay
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/zalopay.php');
/**
* Fake Màn Hình Khoá Zalopay 1
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/zlpay.php');
/**
* Fake Màn Hình Khoá BIDV
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/bidv.php');
/**
* Fake Màn Hình Khoá Sacombankpay
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/sacombankpay.php');
/**
* Fake Màn Hình Khoá Vietinbank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/vietinbank.php');
/**
* Fake Màn Hình Khoá Techcombank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/techcombank.php');
/**
* Fake Màn Hình Khoá VIB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/vib.php');
/**
* Fake Màn Hình Khoá MSB
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/msb.php');
/**
* Fake Màn Hình Khoá TP Bank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/tpbank.php');
/**
* Fake Màn Hình Khoá Agribank
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/man-hinh-khoa/agribank.php');
/**
* Spam Sms
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/smsModel.php');
/**
* Spam Ngl.Link
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/nglModel.php');
/**
* Obfuscate Php
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/encodePhpModel.php');
/**
* Auth Email
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/authEmail.php');
/**
* Charging Card
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/users/chargingCard.php');
/**
* Fake CCCD
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/giay-to/cccd/handle.php');
/**
* Fake Vé Lên Máy Bay Loại 1
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/giay-to/velenmaybay/handle.php');
/**
* Fake Vé Điện Tử
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/giay-to/vedientu/handle.php');
/**
* Fake Vé Lên Máy Bay Loại 2
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/giay-to/velenmaybay/handle2.php');
/**
* Fake Vé Lên Máy Bay Loại 3
*/
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/render/giay-to/velenmaybay/handle3.php');