<?php
include('config.php');

$blgstatus = array(0 => 'Archived', 1 => 'pending', 2 => 'Approved and Active', 3 => 'Rejected');
//$category = array(10 => 'Politics', 11 => 'Entertainment', 12 => 'Sports', 13 => 'Marketing');

$query = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id WHERE blogger.blog_status=2 ORDER BY blogger.rating desc LIMIT 3";
$result = mysqli_query($conn, $query);
?>

<div class="sidebar-box">
    <h3 class="heading">Popular Posts</h3>
    <div class="post-entry-sidebar">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            // print_r($row["pic"]);die; 
            ?>
            <ul>
                <li>
                    <a href="blog-single.php?bid=<?= $row['bid']; ?>">
                        <img src="<?= $row['picture']; ?>" alt="Image placeholder" class="mr-4">
                        <div class="text">
                            <h4><?= $row['title']; ?></h4>
                            <div class="post-meta">
                                <span class="mr-2"><?= $row['created_date']; ?></span>
                            </div>
                        </div>
                    </a>
                </li>

            </ul>
<?php }
?>
    </div>
</div>
<!-- END sidebar-box -->

<div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
        <li><a href="category.php?category=1">POLITICS</a></li>
        <li><a href="category.php?category=3">SPORTS </a></li>
        <li><a href="category.php?category=5">Lifestyle </a></li>
        <li><a href="category.php?category=4">MARKETING </a></li>
        <li><a href="category.php?category=2">ENTERTAINMENT </a></li>
    </ul>
</div>
<!-- END sidebar-box -->

<div class="sidebar-box">
    <h3 class="heading">Tags</h3>
    <ul class="tags">

        <li><a href="category.php?category=1">#Politics</a></li>

        <li><a href="category.php?category=5">#Life-style</a></li>
        <li><a href="category.php?category=3">#Sports</a></li>
        <li><a href="category.php?category=4">#Marketing</a></li>
        <li><a href="category.php?category=2">#Entertainment</a></li>
        <li><a href="category.php?category=3">#Cricket</a></li>
        <li><a href="category.php?category=3">#Football</a></li>
        <li><a href="category.php?category=3">#Basketball</a></li>
    </ul>
</div>