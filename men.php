<!DOCTYPE html>
<html lang="en">

<head>
    <title>Colo Shop</title>
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
  require 'Class/Database.php';
  require 'Class/Product.php';
  require 'Class/Cart.php';
session_start();
if(isset($_SESSION['user_id'])){

	$user_id = $_SESSION['user_id'];
}
$db = new Database();
$pdo = $db->getConnect();

$data_women = Product::getMen($pdo);
$data = Product::getAll($pdo);
?>
<?php
  require 'header.php';
?>
        </br></br></br></br></br></br>
<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Men</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
					<?php foreach ($data_women as $pro) : ?>
						<div class="product-item men">
							<div class="product discount product_filter">
										<div class="product_image">
											<img src="../image/<?= $pro->Image ?>" alt="" width="50px" height="250px">
										</div>
									<div class="product_info">
											<h6 class="product_name"><a href="OneProduct.php?id=<?= $pro->Id ?>"><?= $pro->Name ?></a></h6>
											<div class="product_price"><?= number_format($pro->Price, 0, ',', '.') ?> VNĐ</div>
									</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="OneProduct.php?id=<?= $pro->Id ?>">Xem Chi Tiết</a></div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="best_sellers">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Best Sellers</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product_slider_container">
					<div class="owl-carousel owl-theme product_slider">

						<!-- Slide 1 -->

						<?php foreach ($data as $pro) : ?>
							<div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount">
										<div class="product_image">
												<img src="../image/<?= $pro->Image ?>" alt="" width="50px" height="250px">
											</div>
										<div class="product_info">
												<h6 class="product_name"><a href="OneProduct.php?id=<?= $pro->Id ?>"><?= $pro->Name ?></a></h6>
												<div class="product_price"><?= number_format($pro->Price, 0, ',', '.') ?> VNĐ</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					</div>

					<!-- Slider Navigation -->

					<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
						<i class="fa fa-chevron-left" aria-hidden="true"></i>
					</div>
					<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php'; ?>