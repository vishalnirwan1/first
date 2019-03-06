<?php
include('config.php');
session_start();
//print_r($_POST);die;
?>

<table border="3" id="t1">

    <br>
    <tr>
        <th><strong>BLOG ID</strong></th>
        <th><strong>CATEGORY</strong></th>
        <th><strong>TITLE</strong></th>
        <th><strong>DATE</strong></th>
        <th><strong>STATUS</strong></th>
        <th><strong>EDIT</strong></th>
        <th><strong>ARCHIVE</strong></th>
    </tr>
    <?php
    $blgstatus = array(0 => 'Archived', 1 => 'pending', 2 => 'Approved and Active', 3 => 'Rejected');
    //   $category = array(10 => 'Politics', 11 => 'Entertainment', 12 => 'Sports', 13 => 'Marketing');


    if ($_GET['id'] != "") {
        $userId = $_GET['id'];
    } else {
        $userId = $_SESSION['id'];
    }
    // print_r($userId);die;

    $where = '';
    if (isset($_POST["page"])) {
        $page = $_POST["page"];
        //print_r($page);die;
    } else {
        $page = 1;
    }

    if (isset($_POST['category']) && $_POST['category'] != '') {
        $category1 = $_POST['category'];

        if ($category1 == 1 && $category1 != "") {
            $where.=" and category.category_id=1";
        }
        if ($category1 == 2 && $category1 != "") {
            $where.=" and category.category_id=2";
        }

        if ($category1 == 3 && $category1 != "") {
            $where.=" and category.category_id=3";
        }
        if ($category1 == 4 && $category1 != "") {
            $where.=" and category.category_id=4";
        }
    }

    if (isset($_POST['from']) && isset($_POST['to']) && !empty($_POST['from']) && !empty($_POST['to'])) {
        $from_date = $_POST['from'];
        $to_date = $_POST['to'];

        $where.="and created_date BETWEEN '$from_date' AND '$to_date'";
    }
    if (isset($_POST['from']) && !empty($_POST['from']) && empty($_POST['to'])) {

        $from_date = $_POST['from'];
        $to_date = $_POST['to'];
        $where.="and created_date  >=  '$from_date'";
    }

    if (isset($_POST['to']) && !empty($_POST['to']) && empty($_POST['from'])) {
        $from_date = $_POST['from'];
        $to_date = $_POST['to'];
        $where.="and created_date <= '$to_date' ";
    }
    if (isset($_POST['status']) && $_POST['status'] != '') {
        $blogStatus = $_POST['status'];
        // print_r($blogStatus);
        if ($blogStatus == 1 && $blogStatus != "") {
            $where.=" and blog_status=1";
        }

        if ($blogStatus == 2 && $blogStatus != "") {
            $where.=" and blog_status=2";
        }
        if ($blogStatus == 3 && $blogStatus != "") {
            $where.=" and blog_status=3";
        }
    }
    $pagestart = ($page * 3) - 3;
    $where .=" and id=" . $userId;

    $check_query = "Select SQL_CALC_FOUND_ROWS * FROM blogger LEFT JOIN category ON category.category_id = blogger.category_id WHERE 1=1 " . $where . " LIMIT $pagestart,3";
    $result = mysqli_query($conn, $check_query);
    $num_rows = 'Select FOUND_ROWS() as count';
    $num = mysqli_query($conn, $num_rows);
    $count = mysqli_fetch_array($num);
//print_r($count['count']);
    $totalpages = ceil($count['count'] / 3);
    while ($row = mysqli_fetch_assoc($result)) {
        $source = $row["created_date"];
        $date = new DateTime($source);
        ?>
        <tr>
            <td align="center"><?php echo $row["bid"] ?></td>
            <td align="center"><?php echo $row["category_name"] ?></td>
            <td align="center"><?php echo $row["title"] ?></td>
            <td align="center"><?php echo $date->format('d-m-Y'); ?></td>
            <td align="center"><?php echo $blgstatus[$row['blog_status']]; ?></td>
            <td align="center">
                <a href="editblog.php?bid=<?php echo $row["bid"]; ?>">Edit</a></td>
            <td align="center">
                <button type="reset" onClick="return confirmation(<?php echo $row["bid"]; ?>);" >Yes</button>
            </td>

        <?php } ?>

</table>
<br>
<?php
for ($i = 1; $i <= $totalpages; $i++) {
    ?>
    <span class="pagi" style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='<?= $i ?>'><?= $i ?></span>
<?php }
?>  



