<?php
include('config.php');
include('header.php');

//$category = array(10 => 'Politics', 11 => 'Entertainment', 12 => 'Sports', 13 => 'Marketing');
$blog_id = $_GET['bid'];
// print_r($_GET);die;

$query = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id LEFT JOIN category ON category.category_id = blogger.category_id WHERE blogger.bid='$blog_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$category1 = $row['category_id'];

$query1 = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id LEFT JOIN category ON category.category_id = blogger.category_id WHERE blogger.blog_status=2 AND blogger.category_id='$category1' AND NOT blogger.bid='$blog_id' LIMIT 3";
$result1 = mysqli_query($conn, $query1);

$query_comm = "SELECT COUNT(c_id) as no_of_comm FROM comments as c INNER JOIN blogger as b ON c.bid=b.bid WHERE b.bid=$blog_id AND c.comm_status=1 GROUP BY b.bid";
$result2 = mysqli_query($conn, $query_comm);
$row3 = mysqli_fetch_assoc($result2);

$update_comm = "UPDATE blogger SET no_of_comments =" . $row3['no_of_comm'] . " WHERE bid='$blog_id'";
$result4 = mysqli_query($conn, $update_comm);
?>
<!-- END header -->

<section class="site-section py-lg">
    <div class="container">

        <div class="row blog-entries element-animate">

            <div class="col-md-12 col-lg-8 main-content">
                <img src="<?= $row['picture']; ?>" alt="Image" class="img-fluid mb-5">
                <div class="post-meta">
                    <span class="author mr-2"><img src="<?php echo $row["pic"] ?>" alt="Colorlib" class="mr-2"> <?= $row['firstname'] . " " . $row['lastname'] ?></span>&bullet;
                    <span class="mr-2"><?= $row['created_date']; ?></span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments "></span> <?= $row3['no_of_comm'] ?> </span>
                </div>
                <h1 class="mb-4"><?= $row['title']; ?></h1>
                <a class="category mb-5" href="#"><?= $row['tags']; ?></a> 

                <div class="post-content-body">
                    <p><?= $row['msg']; ?></p>

                </div>


                <div class="pt-5">
                    <p>Categories:  <a href="category.php?category=<?= $row['category_id']; ?>"><?= $row['category_name']; ?></a> Tags: <a href="category.php?category=<?= $row['category_id']; ?>"><?= $row['tags']; ?></a></p>
                </div>


                <div class="pt-5">
                    <h3 class="mb-5"> Comments</h3>
                    <div class="comment-list">

                        <div class="comment">

                            <div class="comment-body">
                                <div id="display_comment"></div>

                            </div>
                        </div>  
                    </div>
                    <!-- END comment-list -->

                    <div class="comment-form-wrap pt-5">
                        <h3 class="mb-5">Leave a comment</h3>
                        <span id="comment_message"></span>

                        <form action="" class="p-5 bg-light" method="post" onsubmit="return false" id='form_comment'>
                            <div class="form-group">
                                <input type='hidden' name='bid' id='bid' value='<?= $blog_id ?>'>
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="comm" id="message" cols="20" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" name='comment' class="btn btn-primary" onclick="add_comment()">
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">

                <!-- END sidebar-box -->
                <div class="sidebar-box">
                    <div class="bio text-center">
                        <img src="<?php echo $row["pic"] ?>" alt="Image Placeholder" class="img-fluid">
                        <div class="bio-body">
                            <h2><?= $row['firstname'] . " " . $row['lastname'] ?></h2>
                            <p>Hey!! I am one of the blogger on the site. I have written many blogs here and have an immense love for writing. Thank you!!</p>
                           <!-- <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p> -->
                            <p class="social">
                                <a href="https://facebook.com" class="p-2"><span class="fa fa-facebook"></span></a>
                                <a href="https://twitter.com" class="p-2"><span class="fa fa-twitter"></span></a>
                                <a href="https://instagram.com" class="p-2"><span class="fa fa-instagram"></span></a>
                                <a href="https://youtube.com" class="p-2"><span class="fa fa-youtube-play"></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END sidebar-box -->  

                <?php
                include('sidebar.php');
                ?>
            </div>
            <!-- END sidebar -->

        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-3 ">Related Post</h2>
            </div>
        </div>
        <div class="row">

            <?php
            while ($row1 = mysqli_fetch_assoc($result1)) {
                ?>
                <div class="col-md-6 col-lg-4">
                    <a href="blog-single.php?bid=<?= $row1['bid']; ?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url('<?= $row1['picture']; ?>'); ">
                        <div class="text">
                            <div class="post-meta">
                                <span class="category"><?= $row1['category_name']; ?></span>
                                <span class="mr-2"><?= $row1['created_date']; ?> </span> &bullet;
                                <span class="ml-2"><span class="fa fa-comments"></span> <?= $row['no_of_comments'] ?></span>
                            </div>
                            <h3><?= $row1['title']; ?></h3>
                        </div>
                    </a>
                </div>
            <?php }
            ?>

        </div>
    </div>


</section>
<!-- END section -->

<?php
include('footer.php');
?>
<!-- END footer -->

</div>

<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery-migrate-3.0.0.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>


<script src="js/main.js"></script>

<script>
                                    $(document).ready(function () {
                                        load_comment();




                                    });
                                    function load_comment()
                                    {
                                        var blog_id = $('#bid').val();
                                        $.ajax({
                                            url: "fetch_comment.php",
                                            method: "POST",
                                            data: {'blogId': blog_id},
                                            dataType: 'html',
                                            success: function (data)
                                            {
                                                if (data != '')
                                                {

                                                    $('#display_comment').html(data);
                                                }
                                            }
                                        });
                                    }
                                    function add_comment()
                                    {
                                        // console.log('fdfdfdfd');
                                        var data1 = $('#form_comment').serialize();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'addcomment.php',
                                            data: data1,
                                            dataType: 'html',
                                            success: function (result) {
                                                if (result != '')
                                                {
                                                    $('#form_comment')[0].reset();

                                                    $('#comment_message').html(result);
                                                    load_comment();
                                                }
                                            }
                                        });
                                    }





</script>
</body>
</html>