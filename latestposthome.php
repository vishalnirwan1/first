<?php
include('config.php');


if (isset($_POST["page"])) {
    $page = $_POST["page"];
    //print_r($page);die;
} else {
    $page = 1;
}
$pagestart = ($page * 5) - 5;
$blgstatus = array(0 => 'Archived', 1 => 'pending', 2 => 'Approved and Active', 3 => 'Rejected');
$category = array(10 => 'Politics', 11 => 'Entertainment', 12 => 'Sports', 13 => 'Marketing');

$query = "SELECT SQL_CALC_FOUND_ROWS * FROM blogger LEFT JOIN info ON blogger.id=info.id WHERE blogger.blog_status=2 ORDER BY blogger.created_date desc LIMIT $pagestart,5";

$result = mysqli_query($conn, $query);
$num_rows = 'Select FOUND_ROWS() as count';
$num = mysqli_query($conn, $num_rows);
$count = mysqli_fetch_array($num);
$totalpages = ceil($count['count'] / 5);
//print_r($totalpages);die;


while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-6">
        <a href="blog-single.php?bid=<?= $row['bid']; ?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
            <img src="<?= $row['picture']; ?>" alt="Image placeholder">
            <div class="blog-content-body">
                <div class="post-meta">
                    <span class="author mr-2"> <img src="<?php echo $row["pic"] ?>" > <?= $row['firstname'] . " " . $row['lastname'] ?></span>&bullet;
                    <span class="mr-2"> <?= $row['created_date']; ?></span> &bullet;
                    <span class="mr-2"><?= $category[$row['category']]; ?></span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 2</span>
                </div>
                <h2><?= $row['title']; ?></h2>
            </div>
        </a>
    </div>

<?php } ?>



<?php
for ($i = 1; $i <= $totalpages; $i++) {
    ?>
    <span class="pagination" style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='<?= $i ?>'><?= $i ?></span>
<?php
}

