<?php

session_start();
include('config.php');
?>
<?php

if ($_POST['status_update'] == '1') {
    $blgstatus = array(1 => 'Status marked to pending', 2 => 'Status marked to Approved', 3 => 'Status marked to Rejected', 4 => 'Status marked to Archived');
    $blogStatus = $_POST['blstatus'];
    $blogId = $_POST['blog_id'];

    $query = 'UPDATE blogger SET blog_status=' . $blogStatus . ' WHERE bid=' . $blogId . '';
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo $blgstatus[$blogStatus];
        die;
    } else {
        echo "not updated";
        die;
    }
}
if ($_POST['blog_reason'] == '1') {
    $reject_reason = $_POST['rejection'];
    $blogId = $_POST['blog_id'];
    $othersreason = $_POST['otherreason'];
    // print_r($reject_reason);die;
    $query = 'UPDATE blogger SET blog_status="3",other_reason="' . $othersreason . '", reject_reason="' . $reject_reason . '"  WHERE bid=' . $blogId . '';
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo 'reason updated';
        die;
    } else {
        echo " reason not updated";
        die;
    }
}
?>
    