<?php
    session_start();
    $title = 'Trang Chủ';
    require 'Class/Database.php';
    require 'Class/Product.php';
    require 'Class/Cart.php';
    require 'Class/Category.php';
    
    $db = new Database();
    $pdo = $db->getConnect();
    $product_per_page = 4;
    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];
    }
    $page = $_GET['page'] ?? 1;
    $max = ceil(count(Product::getAll($pdo))/$product_per_page);
    if($page <=0)
    {
        $page = 1;
    }
    else if($page >= $max)
    {
        $page = $max;
    }
    $limit  = $product_per_page;
    $offset = ($page - 1) * $product_per_page;
    
    
    $data= Product::getAll($pdo);
    $data_quan = Product::getQuan($pdo);
    $data_ao = Product::getAo($pdo);
    $data_giay = Product::getGiay($pdo);

    $data_cate=Category::getAllCategory($pdo);
    
 ?>
<?php
  require 'top.php';
?>
<?php
  require 'header.php';
?>
        <div class="main_slider" style="background-image:url(../image/banner.png)">
            <div class="container fill_height">
                <div class="row align-items-center fill_height">
                    <div class="col">
                        <div class="main_slider_content">
                            <h6 style="color: white;">Spring / Summer Collection 2023</h6>
                            <h1 style="color: white;">Get up to 30% Off New Arrivals</h1>
                            <div class="red_button shop_now_button"><a href="#">shop now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="banner">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="banner_item align-items-center" style="background-image:url(../image/banner_2.jpg)">
							<div class="banner_category">
								<a href="women.php">women's</a>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="banner_item align-items-center" style="background-image:url(../image/banner_1.jpg)">
								<div class="banner_category">
								<a href="men.php">men's</a>
							</div>
						</div>
					</div>
				</div>
			</div>
</div>

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Quần</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
					<?php foreach ($data_quan as $pro) : ?>
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

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Áo</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
					<?php foreach ($data_ao as $pro) : ?>
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
							<div class="red_button add_to_cart_button"><a href="OneProduct.php?id=<?= $pro->Id ?>">Xen </a></div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Giày</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
					<?php foreach ($data_giay as $pro) : ?>
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
<?php
    require 'footer.php';
 ?>