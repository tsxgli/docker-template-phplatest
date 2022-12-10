<?php
$name = $_GET["name"];

$birthdate= $_GET["birthdate"];
$diff =yearsDifference($birthdate,date_create('now'));

echo $diff;
?>