<?php
session_start();
if(isset($_SESSION['user_id'])){

  $user_id = $_SESSION['user_id'];
}

require 'Class/Database.php';
require 'Class/Cart.php';
$pro = new Cart();
$db = new Database();
$pdo = $db->getConnect();
$pro->Empty_Cart($pdo,$user_id);