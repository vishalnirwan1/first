<?php

include('config.php');

//print_r($_POST);die;
$writerName = '';
$msg = '';
$blog_id = $_POST['bid'];

if (empty($_POST["name"])) {
    echo '<p class="text-danger">Name is required</p>';
} else {
    $writerName = $_POST["name"];
}
if (empty($_POST["comm"])) {
    echo '<p class="text-danger">Comment is required</p>';
} else {
    $msg = $_POST["comm"];
}
if ($error == '') {
    $check = "INSERT into comments(bid,name,comment,comm_status)values('$blog_id','$writerName','$msg',1)";
    $data = mysqli_query($conn, $check) or die(mysqli_error($conn));
    echo '<label class="text-success">Comment Added</label>';
    die;
}