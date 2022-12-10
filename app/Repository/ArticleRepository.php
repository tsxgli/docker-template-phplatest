<?php
class ArticleRepository{
private $connection;
    public function __construct(){
        require_once("../config.php");
        try {
           $this->connection= new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
        }catch(PDOException $e){
        echo $e->getMessage();
        }
    }

    public function getAll(){
        require("../Model/Article.php");
    $stmt=$this->connection->prepare("SELECT * FROM Article");
    $stmt-> execute();
    $stmt ->setFetchMode(PDO::FETCH_CLASS,'Article');
    $result=$stmt->fetchAll();
    return $result;
    }
}
?>