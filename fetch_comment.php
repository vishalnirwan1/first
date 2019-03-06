<?php

include('config.php');
$blog_id = $_POST['blogId'];

$query1 = "SELECT * FROM comments WHERE bid='$blog_id' AND comm_status=1 ORDER BY posted_date desc";

$result1 = mysqli_query($conn, $query1);

while ($row1 = mysqli_fetch_assoc($result1)) {
//print_r($row1);die;
    echo '<h3>' . $row1["comment"] . '</h3>
     <div class="meta">' . $row1["posted_date"] . '</div>
     <p>' . $row1["name"] . ' </p>';
}
?>