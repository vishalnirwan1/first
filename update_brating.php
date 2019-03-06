<?php

include('config.php');

$blogRating = $_POST['blrating'];
$blogId = $_POST['blog_id'];

$query = 'UPDATE blogger SET rating=' . $blogRating . ' WHERE bid=' . $blogId . '';
$result = mysqli_query($conn, $query);
if ($result) {
    echo "Rating updated to " . $blogRating;
    die;
} else {
    echo "not updated";
    die;
}