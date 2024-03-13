<?php
session_start();
require 'Class/Database.php';
require("Class/Cart.php");
require 'Class/Customer.php';

if(!isset($_SESSION["user_id"])){
  header("location: Login.php");
}

if(isset($_SESSION["user_id"])){
  $user_id = $_SESSION["user_id"];
}
if(isset($_GET["product_id"])){
    $product_id = $_GET["product_id"];
}
if(isset($_GET["quantity"])){
  $quantity = $_GET["quantity"];
}

if(isset($_GET["size"])){
  $size = $_GET["size"];
}




$pro = new Cart();
$db = new Database();
$pdo = $db->getConnect();
$pro->AddtoCart($pdo,$user_id,$product_id,$size,$quantity);