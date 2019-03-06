<?php

session_start();


unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['admmin_name']);
unset($_SESSION['admin_id']);

session_destroy();
header('Location: index.php');
?>