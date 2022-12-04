<?php
require_once("config.php");
try {
    $connection= new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
}catch(PDOException $e){
echo $e->getMessage();
}

if (isset($_POST['username'])&& isset($_POST['password']))
{
    $username=$_POST["username"];
    $password=$_POST["password"];

    $statement = $connection->prepare("Select * from Users where Username = :username and Password = :password");
    $statement->bindParam(':username',$username);
    $statement->bindParam(':password',$password);

    $statement->execute();

    foreach($statement as $row){
        if(($row['Username']== $username) && ($row['Password']== $password)){
                        echo "<script>window.location.href='management.php';</script>";
                       exit;
                    }
                    else{
                        echo "There is no user with these credentials. Please try again.";
                    }
      //  header("Location: guestbook.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="stylsheet.css" />
</head>

<body>
    <form method="POST">
        <div class="container">
            <label for="username"><b>Username</b></label>
            <br> <input type="text" placeholder="Enter Username" name="username" required><br>

            <br> <label for="password"><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password" required><br>
            <button type="submit">Login</button>

        </div>
    </form>
</body>

</html>