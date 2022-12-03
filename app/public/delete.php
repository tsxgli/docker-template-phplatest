<?php
if(isset($_GET["id"])){
    $id= $_GET["id"];

    require_once("config.php");
try {
    $connection= new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
}catch(PDOException $e){
echo $e->getMessage();
}
}

$statement= "Delete from Posts where id=:id";
$statement = $connection->prepare("Delete from Posts where id=:id");
$statement->bindParam(':id',$id);

$statement->execute();

header("location:management.php");
exit;
?> 