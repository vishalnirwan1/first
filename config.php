<?php

$conn = mysqli_connect("localhost", "root", "girnar", "User_management");
if (mysqli_connect_error()) {
    die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
}
?>
