<?php
$con = mysqli_connect("localhost","root","","app_db");
$key = $_GET['key'];
$deletequery = "DELETE FROM `user` WHERE `user`.`key` ='$key'";
$query = mysqli_query($con, $deletequery);
header('location:main.php');
?>