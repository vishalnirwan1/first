<?php

include('config.php');

$bid = $_GET['bid'];
$query = "UPDATE blogger set blog_status='0' WHERE bid=$bid";
$result = mysqli_query($conn, $query) or die(mysqli_error());
//print_r($result);die;
header("Location: blog_list.php");
?>