<?php
require 'Class/Database.php';
require 'Class/Customer.php';
require 'Class/Cart.php';
$db = new Database();
$pdo = $db->getConnect();
session_start();

$failLogin = '';


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $failLogin = Customer::Login($pdo,$username, $password);
}

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles/bootstrap4/bootstrap.min.css">
	<link href="css/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="css/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles/responsive.css">
</head>

<?php
  require 'header.php';
?>

<div class="container-fluid" style="padding-bottom: 30px;padding-top: 270px">
    <div class="row">
        <div class="m-auto w-50">
            <form action="Login.php" method="post">
                <h2 style="text-align: center;">ĐĂNG NHẬP</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">UserName</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <?php if ($failLogin) : ?>
                    <span class='text-danger fw-bold'><?= $failLogin ?></span>
                <?php endif; ?>
                <a href="forget.php"><u>Forget Password</u></a>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>  
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php' ?>