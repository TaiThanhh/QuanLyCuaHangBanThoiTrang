<?php
class Database{
    public function getConnect()
    {
            
        $host='localhost';
        $name='db_shop';
        $user='root';
        $pass='mysql';


        $dsn="mysql:host=$host;dbname=$name;charset=UTF8";
        try{
            $pdo= new PDO($dsn,$user,$pass);
            if($pdo)
            {
                return $pdo;
            }
        
        }catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

}