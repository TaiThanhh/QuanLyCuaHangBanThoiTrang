<?php
class Product{
   
    public $Name;
    public $Id;
    public $Description;
    public $Price;
    public $Image;
    public $CategoryId;
    public $cate_name;
    public $SizeId;
    public $size_name;
    public $Quantity;
    public function __construct($quantity=0,$size_id=0,$id=0,$name='',$desc='',$price=0,$img='',$cate_id=0,$cate_name='',$size_name='')
    {
        $this->Id= $id;
        $this->Name= $name;    
        $this->Description= $desc;
        $this->Price=$price;
        $this->Image = $img;
        $this->CategoryId = $cate_id;
        $this->cate_name = $cate_name;
        $this->SizeId = $size_id;
        $this->size_name = $size_name;
        $this->Quantity = $quantity;

    }
    
   public static function getAll($pdo)
    {
        $sql = "SELECT * FROM products";

        $stmt = $pdo-> prepare($sql);   
       
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getQuan($pdo)
    {
        $sql = "SELECT * FROM products WHERE products.CategoryId = 3 ";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getWomen($pdo)
    {
        $sql = "SELECT * FROM products WHERE products.CategoryId = 1 ";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getMen($pdo)
    {
        $sql = "SELECT * FROM products WHERE products.CategoryId = 2 ";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getAo($pdo)
    {
        $sql = "SELECT * FROM products WHERE products.CategoryId = 4 ";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getGiay($pdo)
    {
        $sql = "SELECT * FROM products WHERE products.CategoryId = 5 ";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getPage($pdo,$limit,$offset)
    {
        $sql = "SELECT products.*, category.cate_name FROM `products`, `category` WHERE products.category_id = category.id ORDER By id DESC LIMIT :limit OFFSET :offset";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
       
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }

    public static function getOnesProducts($pdo,$id)
    {
        $sql = "SELECT * FROM products WHERE Id=:id";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);

        if($stmt-> execute()){
            $products= $stmt-> fetch(PDO::FETCH_OBJ);
            return $products;
        }
        else{
            $error= $stmt->errorInfo();
            var_dump($error);
        }
    }
    public static function getlastId($data)
    {
        $last=end($data);

       return $last->id;
    }
    public  function InsertNewProducts($pdo,$name,$desc,$price,$img,$cate_id)
    {
        $sql = "INSERT INTO `products`(`name`, `description`, `price`, `img`, `category_id`) VALUES (:name,:description,:price,:img,:cate_id)";
        $stmt = $pdo-> prepare($sql);   
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':description',$desc,PDO::PARAM_STR);
        $stmt->bindParam(':price',$price,PDO::PARAM_INT);
        $stmt->bindParam(':img',$img,PDO::PARAM_STR);
        $stmt->bindParam(':cate_id',$cate_id,PDO::PARAM_INT);

        if($stmt-> execute()){
        $id= $pdo->lastInsertId();
            return $id;
        }
        else{
        $error= $stmt->errorInfo();
        var_dump($error);
        }

    }
    public  function DeleteProduct($pdo,$id)
    {
        $sql = "DELETE FROM `products` WHERE id = :id";

        $stmt = $pdo-> prepare($sql);

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);

        if($stmt-> execute()){
           header("location: ../Admin/index.php");
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }

    public  function UpdateProduct($pdo,$id,$name,$desc,$price,$img,$cate_id)
    {
        $sql = "UPDATE `products` SET `name`=:name,`description`=:desc,`price`=:price,`img`=:img ,`category_id`=:cate_id WHERE id=:id";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':desc',$desc,PDO::PARAM_STR);
        $stmt->bindParam(':price',$price,PDO::PARAM_INT);
        $stmt->bindParam(':img',$img,PDO::PARAM_STR);
        $stmt->bindParam(':cate_id',$cate_id,PDO::PARAM_INT);
        if($stmt-> execute()){
            header("location: ../Admin/index.php");
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getProduct_Category($pdo,$cate_id)
    {
        $sql = "SELECT * FROM products WHERE CategoryId = :cate_id";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':cate_id',$cate_id,PDO::PARAM_INT);   
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function getProduct_Search($pdo,$search)
    {
        $search1 ="%$search%"; 
        $sql = "SELECT * FROM `products` WHERE name LIKE :search";

        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':search',$search1,PDO::PARAM_STR);
        if($stmt-> execute()){
           $products= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $products;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }

}
