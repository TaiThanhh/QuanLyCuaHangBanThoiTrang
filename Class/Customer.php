<?php
class Customer
{
    public $Name;
    public $Phone;
    public $id;
    public $Email;
    public $Password;
    public function __construct($Name='',$Email='',$Password='',$Phone='',$id=0)
    {
        $this-> Name= $Name;
        $this-> Phone= $Phone;
        $this-> id= $id;
        $this->Email=$Email;
        $this->Password=$Password;
    }

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM user";

        $stmt = $pdo-> prepare($sql);
       
        if($stmt-> execute()){
           $users= $stmt-> fetchAll(PDO::FETCH_OBJ);
            return $users;
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }

    public static function getPage($pdo,$limit,$offset)
    {
        $sql = "SELECT * FROM user ORDER By id DESC LIMIT :limit OFFSET :offset";

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
    public  function DeleteUser($pdo,$id)
    {
        $sql = "DELETE FROM `user` WHERE id = :id";

        $stmt = $pdo-> prepare($sql);

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);

        if($stmt-> execute()){
           header("location: ../Admin/index_user.php");
        }
        else{
           $error= $stmt->errorInfo();
           var_dump($error);
        }
    }
    public static function Login($pdo,$email,$password)
    {
        $sql = "SELECT * FROM `customer` WHERE Email = :email";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        if($stmt-> execute()){
            $author= $stmt-> fetch(PDO::FETCH_OBJ);
            if(password_verify($password,$author->Password)==false||$author->Email=="")
            {
                return 'Login Fail!!';
            }
            else
            {
                $_SESSION['user_id']= $author->Id;
                $_SESSION['log_detail']=$author->Name;
                header("location: index.php");
                exit();
            }          
        }
        else{
            $error= $stmt->errorInfo();
            var_dump($error);
        }
    }
    public static function Logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['log_detail']);
        unset($_SESSION['admin_detail']);
        header("location: index.php");
        exit();
        
    }
    public function LoginRequired()
    {
        if(!isset($_SESSION['admin_detail']))
        {
            die("Cần Đăng Nhập Tài Khoản Admin Để Vào Trang Này");
        }
    }
    public function LoginRequired1()
    {
        if(!isset($_SESSION['log_detail']))
        {
            die("Cần Đăng Nhập Tài Khoản Để Vào Trang Này");
        }
    }


    public static function InsertNewUser($pdo,$name,$phone,$email,$password)
    {
        $hash_pass=password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `customer`(`Name`, `Phome`, `Email`, `Password`) VALUES (:name,:phone,:email,:password)";
        $stmt = $pdo-> prepare($sql);   
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':password',$hash_pass,PDO::PARAM_STR);
        if($stmt-> execute()){
            return 'Register Successfull!!';
        }
        else{
        $error= $stmt->errorInfo();
        var_dump($error);
        }

    }
    public function getOneUser($pdo,$user_id){
        $sql = "SELECT * FROM customer WHERE Id=:id";
        $stmt = $pdo-> prepare($sql);
        $stmt->bindParam(':id',$user_id,PDO::PARAM_INT);

        if($stmt-> execute()){
            $user= $stmt-> fetch(PDO::FETCH_OBJ);
            return $user;
        }
        else{
            $error= $stmt->errorInfo();
            var_dump($error);
        }
    }
}