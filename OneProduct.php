<?php
session_start();
if(! isset($_GET["id"]))
{
   die("Cần Cung cấp id cho Sản Phẩm");
}
    $id =$_GET["id"];

	if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];
    }
 ?>
 <?php
    require 'Class/Database.php';
    require 'Class/Product.php';
    require 'Class/Cart.php';
	require 'Class/Size.php';

    $db = new Database();
    $pdo = $db->getConnect(); 

    $product=Product::getOnesProducts($pdo,$id);
    $data= Product::getAll($pdo);
	$size = Size::getSize_per_Product($pdo,$id);
    $title = 'Chi Tiết Sản Phẩm '.$product->Name;
    if(!$product)
    {
      die("Id Không Hợp Lệ");
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles/bootstrap4/bootstrap.min.css">
	<link href="css/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/themify-icons/themify-icons.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/styles/single_styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles/single_responsive.css">
  	<link rel="stylesheet" type="text/css" href="css/styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="css/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles/responsive.css">
</head>

<?php
  require 'header.php';
?>
    <div class="fs_menu_overlay"></div>
<div class="container single_product_container">
	<div class="row">
		<div class="col">

			<!-- Breadcrumbs -->

			<div class="breadcrumbs d-flex flex-row align-items-center">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i><?=$product->Name?></a></li>
				</ul>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="col-lg-7">
			<div class="single_product_pics">
				<div class="row">
					<div class="col-lg-9 image_col order-lg-2 order-6">
						<div class="single_product_image">
							<img width="500px;" height="600px" src="../image/<?= $product->Image ?>" alt="" data-image="../image/<?= $product->Image ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="product_details">
				<div class="product_details_title">
					<h2><?= $product->Name ?></h2>
					<p><?= $product->Description ?></p>
				</div>
				
				<div class="product_price"><?= number_format($product->Price, 0, ',', '.') ?> VNĐ</div>
				<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
				<?php foreach ($size as $pro_size) : ?>
					<div class="free_delivery d-flex flex-row align-items-center justify-content-center">
						<span>Size: <?=$pro_size->Size_Name?>  Số Lượng: <?=$pro_size->Quantity?></span>
						<button><a href="add_to_cart.php?product_id=<?=$product->Id?>&size=<?=$pro_size->Size_Name?>&quantity=<?=$pro_size->Quantity?>">add to cart</a></button>
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
 <?php
    require 'footer.php';
 ?>

