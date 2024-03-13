<?php
class OrderDetails{
   
    public $Id;
    public $OrdersId;
    public $ProductsId;
    public $Price;
    public $Size;
    public $Quantity;

    public function __construct($order_id=0,$product_id=0,$id=0,$quantity=0,$price = 0, $size= '')
    {
        $this-> OrdersId= $order_id;
        $this-> ProductsId= $product_id;   
        $this-> Id= $id;
        $this-> Quantity= $quantity;
        $this->Price = $price;
        $this->Size = $size;
        
    }
    public static function getAll($pdo,$order_id)
    {
        $sql = "SELECT order_id , products.img, products.name, products.price, quantity FROM `order_details`,`orders`,`products` WHERE products.id = order_details.product_id AND orders.id = order_details.order_id AND order_id = :order_id";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':order_id',$order_id,PDO::PARAM_INT);
       
        if($stmt-> execute()){
           $orderdetails= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $orderdetails;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function 
    AddtoOrderDetails($pdo,$user_id)
    {   
            $sql = "INSERT INTO `ordersdetail`(`OrdersId`, `ProductsId`,`Size`,`Price`,`Quantity`) 
            SELECT(SELECT max(Id) FROM orders)AS OrdersId,cart.ProductId,Size,products.Price,Quantity FROM cart,products where cart.CustomerId= :user_id AND products.Id = cart.ProductId;";
            $stmt = $pdo-> prepare($sql);   
            $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
            if($stmt-> execute()){
                
            }
            else{
            $error= $stmt->errorInfo();
            var_dump($error);
            }
    }
    public static function getOrder_Detail_toUpdate($pdo)
    {
        $sql = "SELECT ordersdetail.*,products.Name FROM `ordersdetail`,products WHERE OrdersId = (SELECT MAX(Id) FROM orders) and ordersdetail.ProductsId = products.Id";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $orderdetails= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $orderdetails;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
}