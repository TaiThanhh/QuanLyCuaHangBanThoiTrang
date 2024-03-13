<?php
session_start();
  if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];
}

if(isset($_GET["product_id"])){
    $product_id = $_GET["product_id"];
}
if(isset($_GET["size"])){
  $size = $_GET["size"];
}
require 'Class/Database.php';
include("Class/Cart.php");
$pro = new Cart();
$db = new Database();
$pdo = $db->getConnect();
$pro->DeleteCart($pdo,$user_id,$product_id,$size);