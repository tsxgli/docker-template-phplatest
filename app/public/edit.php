<?php
    require_once("config.php");
try {
    $connection= new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
}catch(PDOException $e){
echo $e->getMessage();
}

$errorMessage="";
$successMessage="";

if ($_SERVER['REQUEST_METHOD']=='GET'){

    //if id doesnt exist, go back to management view
        If(!isset($_GET["id"])){
            header("location:management.php");
            exit;
        }
    //else get the information from the database
        $id=$_GET["id"];

    $statement = $connection->prepare("Select * from Posts where id=:id");
    $statement->bindParam(':id',$id);
    $statement->execute();

    foreach($statement as $row){
        $ip=$row["ip_address"];
        $name=$row["name"];
        $message=$row["message"];
        $datePosted=$row["posted_at"];}
}

else  {
    $id=$_POST["id"];
    $ip=$_POST["ip_address"];
    $name=$_POST["name"];
    $message=$_POST["message"];
    $datePosted=$_POST["posted_at"];

    do{
        if(empty($id)||empty($name)|| empty($message)||empty($datePosted)||  empty($ip)){
            $errorMessage="All the fields must be filled";
            break;
        }
    }while(false);

  
$updateSQL= "UPDATE  Posts SET name=:name, message=:message, ip=:ip, posted_at=:posted_at where id=:id";
$updateSQL = $connection->prepare("Delete from Posts where id=:id");
$updateSQL->bindParam(':name',$name);
$updateSQL->bindParam(':id',$id);
$updateSQL->bindParam(':message',$message);
$updateSQL->bindParam(':posted_at',$datePosted);
$updateSQL->bindParam(':ip',$ip);
$updateSQL->execute();

$successMessage="Client updated successfully";
header("location: management.php");   
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Edit Message</title>
</head>

<body>
    <div class="container my-5">
        <h2>Edit Post</h2>
        <?php
        if(!empty($errorMessage)){
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <botton type='button' class='button-close' data-bs-dismiss ='alert' aria-label='close'></botton>
            </div>
            ";
        }
        ?>

        <form method="GET">
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <label for="id">ID</label><br>
                    <input type="text" id="id" name="id" value="<?php echo $name?>"><br>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <label class="col-sm-3 col-form-label">Message</label><br>
                    <input type="text" id="id" name="id" value="<?php echo $message?>"><br>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <label for="birthdate">Date Posted</label><br>
                    <input type="text" id="birthdate" name="birthdate" value="<?php echo $datePosted?>"><br>
                </div>
            </div>
            <?php
        if(!empty($successMessage)){
            echo"
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <div class= 'offset-sm-4 col-sm-6'>
      
            <strong>$successMessage</strong>
            <botton type='button' class='button-close' data-bs-dismiss ='alert' aria-label='close'></botton>
            </div>  
            </div>
            ";
        }
        ?>
 <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" > Submit</button><br>
                </div>
                <div class="col-sm-3 ">
                    <a class="btn btn-outline-primary" href="management.php">Cancel</a>
                </div>
            </div>

        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>