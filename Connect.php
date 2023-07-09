<?php
$host = "localhost";
$user = "Webgebruiker";
$passw = "Lab2022";
$databank = "RobbeGeusens";

$link = mysqli_connect($host, $user, $passw) or die("Server not available");
mysqli_select_db($link, $databank) or die("Database not available");
?>