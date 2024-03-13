<?php
class Category{
   
   public $Category_name;
   public $Id;
   

   public function __construct($id=0,$cate_name='')
    {
        $this-> Id= $id;
        $this-> Category_name= $cate_name; 
    }

    public static function getAllCategory($pdo)
    {
        $sql = "SELECT * FROM category";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $category= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $category;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getCategory_ById($pdo,$cate_id)
    {
        $sql = "SELECT * FROM category WHERE Id=:id";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':id',$cate_id,PDO::PARAM_INT);

        if($stmt-> execute()){
            $category= $stmt-> fetch(PDO::FETCH_OBJ);
            return $category;
        }
        else{
            $error= $stmt->errorInfo();
            var_dump($error);
        }
    }
}