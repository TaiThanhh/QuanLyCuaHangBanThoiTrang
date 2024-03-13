<?php
class Cart{
    
    public $Id;
    public $CustomerId;
    public $ProductId;
    public $Quantity;
    public $Price;

    public function __construct($id=0,$user_id=0,$product_id=0,$quantity=0,$price=0)
    {
        $this-> Id= $id;
        $this-> CustomerId= $user_id;
        $this-> ProductId= $product_id;
        $this->Quantity=$quantity;
        $this->Price= $price;
    }
    public static function getAll($pdo,$user_id)
    {
        $sql = "SELECT cart.ProductId, products.Name , products.Price,Size, cart.Quantity FROM `cart`,`products` WHERE CustomerId = :user_id AND products.Id = cart.ProductId";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
        if($stmt-> execute()){
           $users= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $users;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getOneCartByID($pdo, $user_id,$product_id,$size) {
        $sql = "SELECT * FROM cart WHERE `CustomerId` = :user_id AND `ProductId` = :product_id AND Size = :size";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindValue(':size', $size, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $cart= $stmt-> fetch(PDO::FETCH_OBJ);
            return $cart;
        }
    }
    public static function AddtoCart($pdo,$user_id,$product_id,$size,$quantity)
    {   
        $proidCol = Cart::getOneCartByID($pdo,$user_id,$product_id,$size);
        if($proidCol)
        {
            $sql = "UPDATE `cart` SET `Quantity`= :quantity WHERE `CustomerId` = :user_id AND `ProductId` = :product_id AND Size = :size";
            $stmt = $pdo->prepare($sql);
            $quantity=$proidCol->Quantity+1;
            $stmt->bindParam(':quantity',$quantity, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id',$product_id, PDO::PARAM_STR);
            $stmt->bindParam(':size',$size, PDO::PARAM_STR);
             if ($stmt->execute()) {
                header("location: index.php");
             } else {
                     $error = $stmt->errorInfo();
                     var_dump($error);
                    }
        }
        else {
            $sql = "INSERT INTO `cart`(`CustomerId`, `ProductId`, `Size`, `Quantity`) VALUES (:user_id,:product_id,:size,'1')";
            $stmt = $pdo-> prepare($sql);   
            $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_STR);
            $stmt->bindParam(':size',$size,PDO::PARAM_STR);
            if($stmt-> execute()){
                header("location: cart.php");
            }
            else{
            $error= $stmt->errorInfo();
            var_dump($error);
            }
        }
    
    }
    public  function DeleteCart($pdo,$user_id,$product_id,$size)
    {
        $sql = "DELETE FROM `cart` WHERE CustomerId = :user_id AND ProductId = :product_id AND Size = :size";

        $stmt = $pdo-> prepare($sql);

        $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
        $stmt->bindParam(':product_id',$product_id,PDO::PARAM_STR);
        $stmt->bindParam(':size',$size,PDO::PARAM_STR);

        if($stmt-> execute()){
           header("location: cart.php");
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public  function Empty_Cart($pdo,$user_id)
    {
        $sql = "DELETE FROM `cart` WHERE `CustomerId` = :user_id";

        $stmt = $pdo-> prepare($sql);

        $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
       

        if($stmt-> execute()){
           header("location: cart.php");
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
}