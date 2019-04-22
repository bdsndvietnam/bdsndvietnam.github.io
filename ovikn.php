<?php
/**
 * * Email: dntnledon@gmail.com
 * ĐT: 0973.015.015
 */
// cấu hình kết nối DB
$dbhost="localhost";
$dbuser="root"; 
$dbpass="vertrigo";
$dbname="ovitim";
// cấu hình mạng và thêm mạng
$mang['s']['MobiFone'] = array('090', '093', '0120', '0121', '0122', '0126', '0128');
$mang['s']['VinaPhone'] = array('091', '094', '0123','0124', '0125', '0127', '0129');
$mang['s']['Viettel'] = array('096','097','098','0161','0162','0163', '0164','0165','0166','0167','0168','0169');
$mang['s']['Sfone'] = array('095');
$mang['s']['VietNamobile'] = array('092','0188');
$mang['s']['Gmobile'] = array('0199','099');
// cấu hình thể loại sim
$loai['s']['sim-luc-quy']="Sim Lục Quý";
$loai['s']['sim-ngu-quy']="Sim Ngũ Quý";
$loai['s']['sim-tu-quy']="Sim Tứ Quý";
$loai['s']['sim-tam-hoa']="Sim Tam Hoa";
$loai['s']['sim-tam-hoa-kep']="Sim Tam Hoa Kép";
$loai['s']['sim-tien-sim-sanh']="Sim Sảnh Tiến";
$loai['s']['sim-taxi']="Sim Taxi AB.AB.AB";
$loai['s']['sim-taxi-aba']="Sim Taxi ABA.ABA";
$loai['s']['sim-taxi-aab']="Sim Taxi AAB.AAB";
$loai['s']['sim-taxi-abb']="Sim Taxi ABB.ABB";
$loai['s']['sim-taxi-bon']="Sim Taxi Lặp 4";
$loai['s']['sim-kep-tien']="Sim Kép Tiến";
$loai['s']['sim-kep']="Sim Kép";
$loai['s']['sim-kep-ba']="Sim Kép Ba";
$loai['s']['sim-ngu-quy-giua']="Ngũ Quý Giữa";
$loai['s']['sim-tu-quy-giua']="Tứ Quý Giữa";
$loai['s']['sim-loc-phat']="Sim Lộc Phát";
$loai['s']['sinh-tai-loc-phat']="Sinh Tài Lộc Phát";
$loai['s']['phat-tai-phat-loc']="Phát Tài Phát Lộc";
$loai['s']['sim-than-tai']="Sim Thần Tài";
$loai['s']['sim-ong-dia']="Sim Ông Địa";
$loai['s']['sim-ganh-dao']="Sim Gánh Đảo";
$loai['s']['sim-soi-guong']="Sim Soi Gương";
$loai['s']['sim-lap']="Sim Lặp";
$loai['s']['sim-xab-yab']="Sim Lặp xAB.yAB";
$loai['s']['sim-lap-abba']="Sim Lặp ABBA";
$loai['s']['sim-ganh']="Sim Gánh";
$loai['s']['sim-dep']="Sim Đẹp Tự Nhiên";
$loai['s']['dau-so-co']="Sim Đầu Số Cổ";
$loai['s']['sim-re']="Sim Giá Rẻ";
$loai['s']['sim-san-bang-tat-ca']="Sim San Bằng Tất Cả";
$loai['s']['bon-mua-khong-that-bat']="Bốn Mùa Không Thất";
$loai['s']['sim-doc-nhat-vo-nhi']="Sim Độc Nhất Vô Nhị";
$loai['s']['sim-nam-sinh']="Sim Năm Sinh";
$loai['s']['ngay-thang-nam-sinh']="Ngày/Tháng/Năm Sinh";
$loai['s']['ngay-thang-nam-sinh-full']="Ngày/Tháng/Năm Full";
// thuật toán sử lý chuỗi số để lọc kết quả trong cơ sở dữ liệu
$sub="SUBSTRING(sim2";
$kieu['sim-tu-quy']=array($sub.",-1,1) = ".$sub.",-2,1)", $sub.",-3,1) =".$sub.",-4,1)", $sub.",-2,1) = ".$sub.",-3,1)", $sub.",-4,1) != ".$sub.",-5,1 )");
$kieu['sim-tu-quy-giua']=array($sub.",-2,1) = ".$sub.",-3,1)", $sub.",-4,1) =".$sub.",-5,1)", $sub.",-3,1) = ".$sub.",-4,1)", $sub.",-1,1) != ".$sub.",-2,1)", $sub.",-5,1) != ".$sub.",-6,1)");
$kieu['sim-ngu-quy-giua']=array($sub.",-6,1) = ".$sub.",-5,1)", $sub.",-4,1) =".$sub.",-3,1)", $sub.",-5,1) = ".$sub.",-3,1)", $sub.",-3,1) =".$sub.",-2,1)", $sub.",-1,1) != ".$sub.",-2,1)", $sub.",-7,1) != ".$sub.",-6,1)");
$kieu['sim-ngu-quy']=array($sub.",-1,1) = ".$sub.",-2,1)", $sub.",-3,1) =".$sub.",-4,1)", $sub.",-2,1) = ".$sub.",-3,1)", $sub.",-4,1) = ".$sub.",-5,1)", $sub.",-5,1) != ".$sub.",-6,1)");
$kieu['sim-luc-quy']=array($sub.",-1,1) = ".$sub.",-2,1)", $sub.",-3,1) =".$sub.",-4,1)", $sub.",-2,1) = ".$sub.",-3,1)", $sub.",-4,1) = ".$sub.",-5,1)", $sub.",-5,1) = ".$sub.",-6,1)");
$kieu['sim-taxi']=array($sub.",-2,2) = ".$sub.",-4,2)", $sub.",-4,2) = ".$sub.",-6,2)", $sub.",-1, 1)!= ".$sub.",-2,1) || (".$sub.",-6,3) = ".$sub.",-3,3) AND ".$sub.",-6,2)", $sub.",-1, 1)!= ".$sub.",-2,1))");
$kieu['sim-taxi-bon']=array($sub.",-5,1) = ".$sub.",-1,1)", $sub.",-6,1) = ".$sub.",-2,1)", $sub.",-7, 1)= ".$sub.",-3,1)", $sub.",-8, 1)= ".$sub.",-4,1)", $sub.",-5, 1)!= ".$sub.",-4,1)", $sub.",-5, 1)!= ".$sub.",-4,1)");
$kieu['sim-nam-sinh']=array($sub.",-4,4) > ".(date('Y')-50),$sub.",-4,4) < ".date('Y'));
$kieu['sim-loc-phat']=array($sub.",-2,2) = 68 OR ".$sub.",-2,2 = 86)");
$kieu['sim-than-tai']=array($sub.",-2,2) = 39 OR ".$sub.",-2,2) = 79");
$kieu['sim-ong-dia']=array($sub.",-2,2) = 38 OR ".$sub.",-2,2) = 78");
$kieu['sim-kep']=array($sub.",-1,1) = ".$sub.",-2,1)",$sub.",-3,1) = ".$sub.",-4,1)",$sub.",-2,1) != ".$sub.",-3,1)");
$kieu['sim-kep-ba']=array($sub.",-1,1) = ".$sub.",-2,1)",$sub.",-3,1) = ".$sub.",-4,1)",$sub.",-5,1) = ".$sub.",-6,1)",$sub.",-2,1) != ".$sub.",-3,1)",$sub.",-4,1) != ".$sub.",-5,1)");
$kieu['sim-kep-tien']=array($sub.",-1,1) = ".$sub.",-2,1)",$sub.",-3,1) = ".$sub.",-4,1)",$sub.",-5,1) = ".$sub.",-6,1)",$sub.",-2,1) > ".$sub.",-3,1)",$sub.",-4,1) > ".$sub.",-5,1)");
$kieu['sim-lap']=array($sub.",-1,1) = ".$sub.",-3,1)",$sub.",-2,1) = ".$sub.",-4,1)",$sub.",-1,1)!=".$sub.",-2,1)",$sub.",-4,2) != ".$sub.",-6,2)");
$kieu['sim-ganh-dao']=array($sub.",-1,1) = ".$sub.",-4,1)",$sub.",-2,1) = ".$sub.",-3,1)",$sub.",-2,2) !=".$sub.",-4,2)");
$kieu['sim-tien-sim-sanh']=array($sub.",-2,2) = 11+".$sub.",-4,2)", $sub.",-4,2) = 11+".$sub.",-6,2) || ".$sub.",-2,2) = 10+".$sub.",-4,2)", $sub.",-4,2) = 10+".$sub.",-6,2) || ".$sub.",-1,1) = 1+".$sub.",-2,1)",$sub.",-2,1) = 1+".$sub.",-3,1) || ".$sub.",-1,1) = 2+".$sub.",-2,1)",$sub.",-2,1) = 2+".$sub.",-3,1)");
$kieu['sim-tam-hoa']=array($sub.",-1,1) = ".$sub.",-2,1)",$sub.",-2,1) = ".$sub.",-3,1)",$sub.",-3,1) !=".$sub.",-4,1)");
$kieu['sim-tam-hoa-kep']=array($sub.",-1,1) = ".$sub.",-2,1)",$sub.",-2,1) = ".$sub.",-3,1)",$sub.",-4,1) = ".$sub.",-5,1)",$sub.",-5,1) = ".$sub.",-6,1)",$sub.",-3,1) !=".$sub.",-4,1)",$sub.",-6,1) !=".$sub.",-7,1)");
$kieu['dau-so-co']=array($sub.",1,3) = '091'|| ".$sub.",1,3) ='090'");
$kieu['sim-dep']=array("gianhap >= 0.2", "gianhap <= 10");
$kieu['sim-re']=array("gianhap >= 0.0", "gianhap <= 0.5");
$kieu['sim-doc-nhat-vo-nhi']=array($sub.",-4,4) = 1102");
$kieu['sinh-tai-loc-phat']=array($sub.",-4,4) = 1368");
$kieu['bon-mua-khong-that-bat']=array($sub.",-4,4) = 4078");
$kieu['phat-tai-phat-loc']=array($sub.",-4,4) = 8386");
$kieu['sim-taxi-aab']=array($sub.",-6,1) = ".$sub.",-5,1)",$sub.",-2,1) = ".$sub.",-3,1)",$sub.",-5,1) = ".$sub.",-3,1)",$sub.",-4,1) = ".$sub.",-1,1)",$sub.",-2,1) != ".$sub.",-1,1)");
$kieu['sim-taxi-abb']=array($sub.",-5,1) = ".$sub.",-4,1)",$sub.",-2,1) = ".$sub.",-1,1)",$sub.",-4,1) = ".$sub.",-2,1)",$sub.",-6,1) = ".$sub.",-3,1)",$sub.",-3,1) != ".$sub.",-2,1)");
$kieu['sim-taxi-aba']=array($sub.",-6,1) = ".$sub.",-4,1)",$sub.",-4,1) = ".$sub.",-3,1)",$sub.",-3,1) = ".$sub.",-1,1)",$sub.",-5,1) = ".$sub.",-2,1)",$sub.",-2,1) != ".$sub.",-1,1)");
$kieu['sim-ganh']=array($sub.",-6,1) = ".$sub.",-4,1)",$sub.",-4,1) = ".$sub.",-3,1)",$sub.",-3,1) = ".$sub.",-1,1)",$sub.",-5,1) != ".$sub.",-2,1)",$sub.",-2,1) != ".$sub.",-1,1)");
$kieu['sim-xab-yab']=array($sub.",-5,1) = ".$sub.",-2,1)",$sub.",-4,1) = ".$sub.",-1,1)",$sub.",-6,1) != ".$sub.",-3,1)",$sub.",-4,1) != ".$sub.",-3,1)");
$kieu['sim-soi-guong']=array($sub.",-6,1) = ".$sub.",-1,1)",$sub.",-5,1) = ".$sub.",-2,1)",$sub.",-4,1) = ".$sub.",-3,1)",$sub.",-6,1) != ".$sub.",-4,1)",$sub.",-5,1) != ".$sub.",-4,1)",$sub.",-2,1) != ".$sub.",-1,1)");
$kieu['sim-lap-abba']=array($sub.",-4,1) = ".$sub.",-1,1)",$sub.",-3,1) = ".$sub.",-2,1)",$sub.",-2,1) != ".$sub.",-1,1)",$sub.",-5,1) != ".$sub.",-4,1)",$sub.",-6,1) != ".$sub.",-5,1)");
$kieu['sim-san-bang-tat-ca']=array($sub.",-4,4) = 6789");
$kieu['ngay-thang-nam-sinh']=array($sub.",-4,2) <13", $sub.",-4,2) >00" ,$sub.",-6,2) <32", $sub.",-6,2) >00");
$kieu['ngay-thang-nam-sinh-full']=array($sub.",-6,2) <13", $sub.",-6,2) >00",$sub.",-8,2) <32", $sub.",-8,2) >00",$sub.",-4,2) = 19 OR ".$sub.",-4,3) = 201");
// danh sách tỉnh thành
$city['s']=array(
'Hà Nội', 
'Hồ Chí Minh', 
'Hải Phòng', 
'Đà Nẵng',
'Đồng Nai',
'Cần Thơ',
'Hải Dương', 
'Hưng Yên', 
'Hòa Bình', 
'Vĩnh Phúc', 
'ĐắkLăk', 
'ĐắkNông',  
'Đồng Tháp',  
'Điện Biên', 
'An Giang', 
'Bạc Liêu', 
'Bắc Giang', 
'Bắc Kạn', 
'Bắc Ninh', 
'Bến Tre', 
'Bà Rịa-Vũng Tàu', 
'Bình Định', 
'Bình Dương', 
'Bình Phước', 
'Bình Thuận', 
'Cà Mau', 
'Cao Bằng', 
'Gia Lai', 
'Hậu Giang', 
'Hà Giang', 
'Hà Nam', 
'Hà Tĩnh', 
'Khánh Hòa', 
'Kiên Giang', 
'Kon Tum', 
'Lạng Sơn', 
'Lâm Đồng', 
'Lào Cai', 
'Lai Châu', 
'Long An', 
'Nam Định', 
'Nghệ An', 
'Ninh Bình', 
'Ninh Thuận', 
'Phú Thọ', 
'Phú Yên', 
'Quảng Bình', 
'Quảng Nam', 
'Quảng Ngãi', 
'Quảng Ninh', 
'Quảng Trị', 
'Sơn La', 
'Sóc Trăng', 
'Tây Ninh', 
'Thừa Thiên - Huế', 
'Thái Bình', 
'Thái Nguyên', 
'Thanh Hóa', 
'Tiền Giang', 
'Trà Vinh', 
'Tuyên Quang', 
'Vĩnh Long', 
'Yên Bái'
);
$c_url=$_SERVER['QUERY_STRING'];
$ntime=time();
$adminpass2="eec5cffb2c520af3fe41fcb77eee4700"; // mật khẩu quản lý thêm số menu ,
$myinfo=array(
"my_hl1" => "0966.383.383",
"my_hl2" => "0979399993",
"my_hl3" => "",
"my_tkeab" => "0104.67 8888",// TK Đông Á,
"my_tkvcb" => "0091.000.222.504",// TK Vietcombank,
"my_tkstb" => "0500.1689.8888",// TK Sacombank,
"my_chutk" => "Lê Văn Đon",// Chủ TK,
"my_email" =>"nguyetquekg@yahoo.com",
"my_domain"=>"http://".$_SERVER['HTTP_HOST']."", // đường dẫn website
"my_add"=>"23T2 - Đông Thành - Đông Thái - An Biên - Kiên Giang",
"my_add2"=>"19 - Nguyễn Tri Phương - Tân Xuân - Đồng Xoài - Bình Phước",
"my_yahoo" => "nguyetquekg",
"my_yahoo2" => "",
"my_name" =>"Lê Đon",
"my_title" =>"Sim dep gia tot, sim gia re, sim dep, sim tinh nhan, ban sim gia re", // Tiêu đề trang chủ
"my_add_web" =>str_replace("www.","",$_SERVER['HTTP_HOST']),
"my_sms_by"=> "",  // Chữ ký tin nhắn
"my_sms_number" =>"", //// số điện thoại sử dụng nhắn tin( Số mobifone đã dk tài khoản trên mobi web)
"my_sms_pass" =>"", /// Mật khẩu tại website mobifone
"my_keyword"=>"Mua Ban Sim Dep",// Từ khóa iu tiên
"my_url_query" =>"index.php?".$_SERVER['QUERY_STRING'],
"my_slo"=>"Chọn SIM Đẹp - Tự Tin Kết Nối - Dẫn Lối Thành Công!", //
"my_logo" =>"Rao Bán Sim", ///
"dathang_sms" =>"false", // nhận tin nhắn khi có đặt hàng ( tắt cho giá trị bàng false
"dathang_sms_to"=>"",// số điện thoại nhận tin đặt hàng
"dathang_email"=>"true",
"dathang_email_to"=>"dntnledon@gmail.com",// email nhận thông tin đặt hàng
"smtp"=>"true", // Bật/ tắt chức năng gửi email smtp
"smtp_server"=>"mail.ovi.vn",
"smtp_user"=>"sales@ovi.vn",
"smtp_pass"=>"SalesOvi@Ovi",
"smtp_port"=>25,
"cache"=>1*60*60 // Tăng tốc độ website// Lưa cache 1 tiếng. 
 // nhận email khi có đơn đặt hàng
);
/**
 * *
 * 
 * 
 * Thiết lập chức năng gửi lại tin nhắn khi nhắn lỗi
 * Tạo crom thời gian 1 phút tới link func/resend_sms.php
 * (Chú ý để sử dụng được chức năng nhắn tin trên website máy chủ của bạn phải hỗ trợ curl)
 * 
 * 
 * Thiết lập tính năng nhắn tin tự động
 * tạo crom thời gian 2 phút tới linnk adminpc/cron_open.php
 * 
 */
function xds($str)
{
$coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
"ằ","ắ","ặ","ẳ","ẵ",
"è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
"ì","í","ị","ỉ","ĩ",
"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
,"ờ","ớ","ợ","ở","ỡ",
"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
"ỳ","ý","ỵ","ỷ","ỹ",
"đ",
"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
"Ì","Í","Ị","Ỉ","Ĩ",
"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
,"Ờ","Ớ","Ợ","Ở","Ỡ",
"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
"Đ","ê","ù","à");
$khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
,"a","a","a","a","a","a",
"e","e","e","e","e","e","e","e","e","e","e",
"i","i","i","i","i",
"o","o","o","o","o","o","o","o","o","o","o","o"
,"o","o","o","o","o",
"u","u","u","u","u","u","u","u","u","u","u",
"y","y","y","y","y",
"d",
"A","A","A","A","A","A","A","A","A","A","A","A"
,"A","A","A","A","A",
"E","E","E","E","E","E","E","E","E","E","E",
"I","I","I","I","I",
"O","O","O","O","O","O","O","O","O","O","O","O"
,"O","O","O","O","O",
"U","U","U","U","U","U","U","U","U","U","U",
"Y","Y","Y","Y","Y",
"D","e","u","a");
return str_replace($coDau,$khongDau,$str);}
?>