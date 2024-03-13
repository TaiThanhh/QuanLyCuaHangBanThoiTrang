<?php
class Orders{
   
    public $Total;
    public $Id;
    public $CustomerId;
    public $Date;

    

    public function __construct($id=0,$total=0,$user_id=0,$time_create='',$email='')
    {
        $this-> Id= $id;
        $this-> Total= $total;   
        $this-> CustomerId= $user_id;
        $this-> Date= $time_create;
        
        
    }
    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM orders";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $orders= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $orders;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getPage($pdo,$limit,$offset)
    {
        $sql = "SELECT orders.* , user.Email FROM `orders`,`user` WHERE orders.user_id = user.id; ORDER By id DESC LIMIT :limit OFFSET :offset";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
       
        if($stmt-> execute()){
           $orders= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $orders;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function AddtoOrders($pdo,$user_id,$total)
    {   
            $sql = "INSERT INTO `orders`(`CustomerId`, `Date`, `Total`) VALUES (:user_id,now(),:total)";
            $stmt = $pdo-> prepare($sql);   
            $stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
            $stmt->bindParam(':total',$total,PDO::PARAM_INT);
            if($stmt-> execute()){
                
            }
            else{
            $error= $stmt->errorInfo();
            var_dump($error);
            }
    }
}