<?php

session_start();
include('config.php');

$id = $_REQUEST['id'];
$query = "UPDATE info set status='0' WHERE id=$id";
$result = mysqli_query($conn, $query) or die(mysqli_error());
//print_r($result);die;
header("Location: user_list.php");
?>