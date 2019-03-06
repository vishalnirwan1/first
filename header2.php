<?php
session_start();
include('config.php');
if (!isset($_SESSION['admin_id'])) {
    header('location:index.php');
    die;
    //echo 'hello';die;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Records</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="header2.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
        <script>

            tinymce.init({
                selector: '#mytext',
                plugins: "code image",
                menubar: "file edit view fromat"


            });
        </script>

    </head>
    <body>
        <div>
            <ul id="menu">
                <li>
                    <a href="logout.php">Logout</a>

                    <ul id='nested'>
                        <li style='font-size:20px'>
                            Welcome Admin
                        </li>
                    </ul>
                </li>
                <li class='selected'>
                    <a href="user_list.php">Manage Users</a>

                </li>
                <li class="selected">
                    <a href="allblogs.php">Manage Blogs</a>
                </li>

            </ul>
        </div>