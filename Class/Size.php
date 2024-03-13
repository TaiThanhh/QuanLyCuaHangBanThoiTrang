<?php
class Size{
   
   public $Product_Id;
   public $Size_Name;
   public $Quantity;
   

   public function __construct($id=0,$Size_Name='',$Quantity=0)
    {
        $this-> Product_Id= $id;
        $this-> Size_Name= $Size_Name; 
        $this-> Quantity= $Quantity; 
    }

    public static function getSize_per_Product($pdo,$id)
    {
        $sql = "SELECT products.* , Size_Name ,Quantity FROM `size`,`products` WHERE products.Id = size.Product_Id AND products.Id = :id AND Quantity > 0";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
       
        if($stmt-> execute()){
           $size= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $size;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }

    public static function getQuantity_per_Product_PerSize($pdo,$product_id,$size)
    {
        $sql = "SELECT * from size Where Product_Id = :product_id AND Size_Name = :size";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':product_id',$product_id,PDO::PARAM_STR);
        $stmt->bindParam(':size',$size,PDO::PARAM_STR);
       
        if($stmt-> execute()){
           $quantity= $stmt-> fetch(PDO::FETCH_OBJ);
            return $quantity;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function update_Quantity_afterPayment($pdo,$orderdetails)
    {
        foreach ($orderdetails as $ord) :
            $sql = "UPDATE `size` SET `Quantity`= Quantity - $ord->Quantity WHERE Product_Id = $ord->ProductsId AND Size_Name = '$ord->Size' ";
            $stmt = $pdo-> prepare($sql);
            if($stmt-> execute()){
              
            }
            else{
               $error= $stmt->errorInfo();
               var_dump($error);
            }   
        endforeach;
        
    }
}