
<?php
 if(isset($_POST["firstname"])&& isset($_POST["birthdate"]))
 {
$firstname=$_POST["firstname"];
$birthdate=$_POST["birthdate"];
$age= date_diff(date_create($birthdate),date_create('now'))->y;

echo "Hello $firstname your age is $age";
}else{
?>
    <form method="POST">
        <label for="firstname">First name:</label><br>
        <input type="text" id="firstname" name="firstname" value="John"><br>
        <label for="birthdate">Last name:</label><br>
        <input type="date" id="birthdate" name="birthdate" value="2000-08-12"><br><br>
        <input type="submit" value="Submit">
    </form>
 <?php
}

?>
  