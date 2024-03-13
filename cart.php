<?php 
    session_start();
    $title = 'Giỏ Hàng';
    require 'Class/Database.php';
    require 'Class/Customer.php';
    require 'Class/Product.php';
    require 'Class/Cart.php';
    require 'Class/Size.php';
    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    $db = new Database();
    $pdo = $db->getConnect();

    $quantity_error ='';
    $quantity_kho = Size::getQuantity_per_Product_PerSize($pdo,$_POST['product_id'],$_POST['size']);
    $auth = new Customer();
    $auth->LoginRequired1();
    $data=Cart::getAll($pdo,$user_id);
    include("top.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($quantity_kho->Quantity<$_POST['quantity']){
            $quantity_error = 'số lượng mua không được vượt quá số lượng trong kho!!';
            $data=Cart::getAll($pdo,$user_id);
        }
        else{
            $sql = "UPDATE `cart` SET `Quantity`= :quantity WHERE CustomerId = :user_id AND ProductId = :product_id AND Size = :size";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':quantity',$_POST['quantity'], PDO::PARAM_INT);
            $stmt->bindParam(':user_id',  $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id',$_POST['product_id'], PDO::PARAM_STR);
            $stmt->bindParam(':size',$_POST['size'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                $data=Cart::getAll($pdo,$user_id);
            } else {
                $error = $stmt->errorInfo();
                var_dump($error);
            }
        }
    }

?>
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
  require 'header.php';
?>

<div style="padding-top: 170px;" class="container"> 
    <table class="table my-3">
        <a href="empty_cart.php" class="btn btn-danger mt-2">Empty Cart</a>
        <?php echo"<span class='error'> $quantity_error </span>"?>
        <thead> 
            <tr class="text-center">
                    <th>No</th>
                    <th>Pro name</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Quantity</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php  $i = 1; $total = 0; $price = 0; $quan = 0; $proid = 0?>
                <?php foreach ($data as $product):?>
                        <form action="cart.php" method="post"> 
                            <tr>
                                <td><?= $i ?></td>  
                                <?php foreach (get_object_vars($product) as $key => $value): ?>           
                                    <?php if ($key == 'Name'): $NAME=$value;?>
                                    <input type="hidden" name="product_id" value="<?=$product->ProductId?>" />
                                        <td><a><?= $value ?></a></td>
                                    <?php elseif ($key == 'Price'): ?>
                                        <td><?= number_format($value, 0, ',', '.') ?> VNĐ</td>
                                    <?php elseif ($key == 'Size'): ?>
                                    <input type="hidden" name="size" value="<?=$value?>" />
                                        <td><?= $value ?></td>
                                    <?php elseif ($key == 'Quantity'): ?>
                                        <td>
                                            <input type="number" value="<?= $value ?>" name="quantity" min="1" style="width: 50px;" />
                                        </td>
                                        <td>
                                            <input type="submit" name="update" value="Update" class="btn btn-warning" /> 
                                            <a href="delete_cart.php?user_id=<?= $user_id?>&product_id=<?=$product->ProductId?>&size=<?=$product->Size?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>     
                        </form> 
                    <?php  $i++; $total += $product->Price * $product->Quantity;?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="7" class="text-center">
                        <h4>Total: <?= number_format($total, 0, ',', '.') ?> VNĐ</h4>
                    </td>
                </tr>
                <td colspan="7" class="text-center">
                        <h4><a class="btn btn-primary" href="payment.php?user_id=<?=$user_id?>&total=<?=$total?>">Thanh Toán</a></h4>
                </td>
        </tbody>
    </table>
</div>
<?php
    include 'footer.php';
 ?>