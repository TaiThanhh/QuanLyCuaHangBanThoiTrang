<?php
session_start();
require 'Class/OrderDetails.php';
require 'Class/Orders.php';
require 'Class/Database.php';
require 'Class/Size.php';
require 'Class/Customer.php';
include("Class/Cart.php");
require 'send_mail.php';
if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];
}
if(isset($_GET["total"])){
    $total = $_GET["total"];
}

$nd = new Customer();

$db = new Database();
$pdo = $db->getConnect();
$user = $nd->getOneUser($pdo,$user_id);
$add_to_orders=Orders::AddtoOrders($pdo,$user_id,$total);
$add_to_order_details=OrderDetails::AddtoOrderDetails($pdo,$user_id);
$order_details = OrderDetails::getOrder_Detail_toUpdate($pdo);
Size::update_Quantity_afterPayment($pdo,$order_details);
$pro = new Cart();
$pro->Empty_Cart($pdo,$user_id);
$mail = new Mailer();
$tieude = 'Order '. date('Y-m-d H:i:s') .'Of '. $user->Name ;
$noidung = "<p>Cám ơn Quý Khách - Đây là danh sách món hàng khách đã mua</p>";
foreach ($order_details as $ord) :
    $noidung.= "<p>tên sản phẩm".$ord->Name."</p>
                <p>Size".$ord->Size."</p>
                <p>Giá:".$ord->Price."</p>
                <p>Số Lượng".$ord->Quantity."</p>";
endforeach;

$mail->dathangmail($tieude,$noidung,$user->Email);


