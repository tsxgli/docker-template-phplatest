<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="stylsheet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <h1> Write something in our guestbook!</h1>

    <form method="POST">
        <div class=" form-field">
            <label>Name: </label>
            <input type="text" name="name" />
        </div>
        <div class="form-field">
            <label>Message:</label>
            <textarea name="message"></textarea>
        </div>
        <div class=" form-field">
            <label>&nbsp; </label>
            <input type="submit" name="Send" />
        </div>
    </form>



    <?php
require_once("config.php");
try {
    $connection= new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
}catch(PDOException $e){
echo $e->getMessage();
}
// FORM 1
 



//GET THE DATA FROM THE INPUT FIELDS
    if(isset($_POST['Send']))
    {
        $name=htmlspecialchars($_POST["name"]);
        $message=htmlspecialchars($_POST["message"]);
        $email= "email@email.com";
        $ip_address=$_SERVER['REMOTE_ADDR'];

        $query = "INSERT INTO Posts (posted_at, name, email, message, ip_address)
            VALUES (now(), :name, :email, :message, :ip_address)";

    $step = $connection->prepare($query);
    $step->bindParam(':name',$name);
    $step->bindParam(':email',$email);
    $step->bindParam(':message', $message);
    $step->bindParam(':ip_address', $ip_address);

    $step->execute();
    }

//show all messages in post
    $result=$connection-> query("SELECT * FROM Posts");
 
//DISPLAY MESSAGES
echo "<h1>$db_name</h1>";

echo '
<table class="table">
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Message</th>
  <th>Date posted</th>
  <th>Edit or Delete</th>
  <tr> 
  ';

foreach($result as $row){
    $id = $row["id"];
    $emailAddress = $row["email"];
    $postedAt = $row["posted_at"];
    $message = $row["message"];
    $fullName = $row["name"];

echo "
<td>$id</td> 
<td>$fullName</td> 
<td>$message</td> 
<td>$postedAt</td> 
<td> 
<a class='btn btn-primary' href='edit.php?id=$row[id]'>Edit</a>
<a class='btn btn-danger' href='delete.php?id=$row[id]'>Delete</a>
</td> 
<td>

</td>
</tr>
";
}

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>