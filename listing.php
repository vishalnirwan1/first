<?php
include('config.php');
//print_r($_POST);
?>

<table border="3" id="t1">

    <br>
    <tr>
        <th><strong>ID</strong></th>
        <th><strong>NAME</strong></th>
        <th><strong>PROFILE PIC</strong></th>
        <th><strong>EMAIL ID</strong></th>
        <th><strong>GENDER</strong></th>
        <th><strong>PHONE NO.</strong></th>
        <th><strong>USERNAME</strong></th>
       <!-- <th><strong>USER'S BLOG</strong></th> -->
        <th><strong>DATE</strong></th>
        <th><strong>PROFILE</strong></th>
        <th><strong>DELETE</strong></th>
    </tr>



    <?php
    $where = '';
    if (isset($_POST["page"])) {
        $page = $_POST["page"];
        //print_r($page);die;
    } else {
        $page = 1;
    }


    if (isset($_POST['phone']) && $_POST['phone'] != '') {
        $phone = $_POST['phone'];
        $where .= ' and phone=' . "$phone" . '';
    }
    if (isset($_POST['name']) && $_POST['name'] != '') {
        $fname = $_POST['name'];
        $where .= ' and firstname LIKE "%' . "$fname" . '%"';
    }

    if (isset($_POST['from']) && isset($_POST['to']) && !empty($_POST['from']) && !empty($_POST['to'])) {
        $from_date = $_POST['from'];
        $to_date = $_POST['to'];

        $where.="and creation_date BETWEEN '$from_date' AND '$to_date'";
    }
    if (isset($_POST['from']) && !empty($_POST['from']) && empty($_POST['to'])) {

        $from_date = $_POST['from'];
        $to_date = $_POST['to'];
        $where.="and creation_date  >=  '$from_date'";
    }

    if (isset($_POST['to']) && !empty($_POST['to']) && empty($_POST['from'])) {
        $from_date = $_POST['from'];
        $to_date = $_POST['to'];
        $where.="and creation_date <= '$to_date' ";
    }

    $pagestart = ($page * 3) - 3;
    $where .=" and status='1'";
    $check_query = "Select SQL_CALC_FOUND_ROWS * FROM info WHERE 1=1 " . $where . " LIMIT $pagestart,3";
    //ini_set('display_errors', 1);
    //error_reporting(E_ALL);
    $result = mysqli_query($conn, $check_query);
    $num_rows = 'Select FOUND_ROWS() as count';
    $num = mysqli_query($conn, $num_rows);
    $count = mysqli_fetch_array($num);
//print_r($count['count']);
    $totalpages = ceil($count['count'] / 3);
    /*  $prev = $page - 1;
      $next = $page + 1; */
    while ($row = mysqli_fetch_assoc($result)) {
        $source = $row["creation_date"];
        $date = new DateTime($source);
        ?>
        <tr><td align="center"><?php echo $row["id"] ?></td>
            <td align="center"><?php echo $row["firstname"] . " " . $row["lastname"] ?></td>
            <td align="center"><img src="<?php echo $row["pic"] ?>" height='50' width='50'></td>
            <td align="center"><?php echo $row["email"] ?></td>
            <td align="center"><?php echo $row["gender"] ?></td>
            <td align="center"><?php echo $row["phone"] ?></td>
            <td align="center"><?php echo $row["username"] ?></td>
          <!--  <td align="center">
                <a href="blog_list.php?id=<?php echo $row["id"]; ?>">Blogs</a></td> -->
            <td align="center"><?php echo $date->format('d-m-Y'); ?></td>
            <td align="center">
                <a href="myprofile.php?id=<?php echo $row["id"]; ?>">View</a></td>
            <td align="center">
                <button type="reset" onClick="return confirmation(<?php echo $row["id"]; ?>);" >Delete</button>
            </td>

        </tr>

    <?php } ?>
</table>
<br>
<?php
for ($i = 1; $i <= $totalpages; $i++) {
    ?>
    <span class="pagination" style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='<?= $i ?>'><?= $i ?></span>
<?php }
?>