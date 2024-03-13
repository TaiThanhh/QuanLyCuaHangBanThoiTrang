<?php
require 'Class/Database.php';
require 'Class/Customer.php';
$db = new Database();
$pdo = $db->getConnect();
session_start();
if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
}
$failRegister = '';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $failRegister = Customer::InsertNewUser($pdo,$name,$phone,$username, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Register page</title>
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
?>

<?php
  require 'header.php';
?>

<div class="container-fluid" style="padding-bottom: 30px;padding-top: 170px">
    <div class="row">
        <div class="w-50 m-auto">
            <form action="Register.php" method="post">
                <h2 style="text-align: center;">ĐĂNG KÝ TÀI KHOẢN</h2>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" id="phone" name="phone"  placeholder="Enter your phone"  required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="user" name="user" placeholder="Enter your email Address" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass"  placeholder="Enter your password"  required>
                </div>
                <?php if ($failRegister) : ?>
                    <span class='text-success fw-bold'><?= $failRegister ?></span>
                    <? else:?>
                      <span class='text-danger fw-bold'><?= $failRegister ?></span>
                <?php endif; ?>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer.php' ?>