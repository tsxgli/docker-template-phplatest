<link rel="stylesheet" type="text/css" href="stylsheet.css"/>
<?php

require_once("config.php");
try {
    $connection= new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
}catch(PDOException $e){
echo $e->getMessage();
}

$result=$connection-> query("SELECT * FROM Posts");

echo "<h1>$db_name</h1>";

foreach($result as $row){
  echo "<div>";
    echo"<p>";
    echo "<h2>".$row['name']. "</h2>";
    echo  "<br>".$row['message'];
    echo " <br>"."Posted at ". $row['posted_at'];
    echo"</p>\n";
   echo "</div>";

}
