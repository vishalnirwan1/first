<?php
include('config.php');
//print_r($_POST);
?>               
<table border="3" id="t1" >

    <br>
    <tr>
        <th><strong>ID</strong></th>
        <th><strong>CATEGORY</strong></th>
        <th><strong>TITLE</strong></th>
        <th><strong>CREDITS</strong></th>
        <th><strong>DATE</strong></th>
        <th><strong>CONTENT</strong></th>
        <th><strong>BLOG STATUS</strong></th>
        <th><strong>BLOG RATING</strong></th>
    </tr>
    <?php
    $where = '';
    if (isset($_POST["page"])) {
        $page = $_POST["page"];
        //print_r($page);die;
    } else {
        $page = 1;
    }

    if (isset($_POST['title']) && $_POST['title'] != '') {
        $title1 = $_POST['title'];
        $where .= ' and b.title LIKE "%' . "$title1" . '%"';
    }
    if (isset($_POST['name']) && $_POST['name'] != '') {
        $fname = $_POST['name'];
        $where .= ' and i.firstname LIKE "%' . "$fname" . '%"';
    }
    if (isset($_POST['from']) && isset($_POST['to']) && !empty($_POST['from']) && !empty($_POST['to'])) {
        $from_date = $_POST['from'];
        $to_date = $_POST['to'];

        $where.="and b.created_date BETWEEN '$from_date' AND '$to_date'";
    }
    if (isset($_POST['from']) && !empty($_POST['from']) && empty($_POST['to'])) {

        $from_date = $_POST['from'];
        $to_date = $_POST['to'];
        $where.="and b.created_date  >=  '$from_date'";
    }

    if (isset($_POST['to']) && !empty($_POST['to']) && empty($_POST['from'])) {
        $from_date = $_POST['from'];
        $to_date = $_POST['to'];
        $where.="and b.created_date <= '$to_date' ";
    }
    if (isset($_POST['blogstatus']) && $_POST['blogstatus'] != '') {
        $blogStatus = $_POST['blogstatus'];

        if ($blogStatus == 1 && $blogStatus != "") {
            $where.=" and b.blog_status=1";
        }

        if ($blogStatus == 2 && $blogStatus != "") {
            $where.=" and b.blog_status=2";
        }
        if ($blogStatus == 3 && $blogStatus != "") {
            $where.=" and b.blog_status=3";
        }
    }

    $pagestart = ($page * 3) - 3;


    $blgstatus = array(1 => 'pending', 2 => 'Approved', 3 => 'Reject', 4 => 'Archived');
    // $category = array(10 => 'Politics', 11 => 'Entertainment', 12 => 'Sports', 13 => 'Marketing');

    $query = "Select SQL_CALC_FOUND_ROWS b.bid, b.reject_reason, i.firstname, b.title, b.created_date, b.blog_status, b.rating, category.category_name FROM blogger as b INNER JOIN info as i ON i.id=b.id INNER JOIN category ON category.category_id = b.category_id" . $where . " ORDER BY b.created_date DESC LIMIT $pagestart,3";

    $result = mysqli_query($conn, $query);
    $num_rows = 'Select FOUND_ROWS() as count';
    $num = mysqli_query($conn, $num_rows);
    $count = mysqli_fetch_array($num);
    // print_r($count['count']);die;
    $totalpages = ceil($count['count'] / 3);

    //  $prev = $page - 1;
    //  $next = $page + 1;
    while ($row = mysqli_fetch_assoc($result)) {


        $blogId = $row["bid"];
        $source = '';
        //$date = new DateTime($source);
        ?>
        <tr>
            <td align="center"><?php echo $row["bid"] ?></td>
            <td align="center"><?php echo $row["category_name"] ?></td>
            <td align="center"><?php echo $row["title"] ?></td>
            <td align="center"><?php echo $row["firstname"] ?></td>

            <td align="center"><?php echo date('d M y', strtotime($row["created_date"])); //$date->format('d-m-Y');     ?></td>
            <td align="center">
                <a href="blog-single.php?bid=<?php echo $row["bid"]; ?>">View</a></td>
            <td align="center"><select class="search_1" id='blog_status_<?= $row["bid"] ?>' name='blog_status' onchange="changeStatus('<?= $blogId ?>')">
                    <option value="" >select blog status</option>
                    <?php
                    foreach ($blgstatus as $key => $value) {
                        ?>
                        <option value="<?= $key ?>" <?php
                        if ($key == $row['blog_status']) {
                            echo 'selected=selected';
                        }
                        ?>><?= $value ?> </option>

                    <?php } ?>         
                </select>
            </td>
            <td align="center"><select class="search_1" id='blog_rating_<?= $row["bid"] ?>' name='blog_rating' onchange="changeRating('<?= $blogId ?>')">
                    <option value="" >Give Rating</option>
                    <?php
                    // echo '<pre>';print_r($row);
                    for ($rating = 1; $rating <= 5; $rating++) {
                        ?>
                        <option value="<?= $rating ?>" <?php
                if ($rating == $row['rating']) {
                    echo 'selected=selected';
                }
                        ?>><?= $rating ?> </option>

                    <?php } ?>         
                </select>
            </td>
        </tr>
    <?php }
    ?>
</table>
<?php
for ($i = 1; $i <= $totalpages; $i++) {
    ?>
    <span class="pagination" style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='<?= $i ?>'><?= $i ?></span>
<?php }
?>