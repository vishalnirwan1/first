<?php
include('config.php');
include('header.php');

$blgstatus = array(0 => 'Archived', 1 => 'pending', 2 => 'Approved and Active', 3 => 'Rejected');

$category1 = $_GET['category'];
$query = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id LEFT JOIN category ON category.category_id = blogger.category_id WHERE blogger.blog_status=2 AND blogger.category_id='$category1'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result)
?>
<!-- END header -->


<section class="site-section pt-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-4">Category: <?= $row['category_name']; ?></h2>
            </div>
        </div>
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="row mb-5 mt-5">

                        <div class="col-md-12">

                            <div class="post-entry-horzontal">
                                <a href="blog-single.php?bid=<?= $row['bid']; ?>">
                                    <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url(<?= $row['picture']; ?>)"></div>
                                    <span class="text">
                                        <div class="post-meta">
                                            <span class="author mr-2"><img src='<?= $row['pic']; ?>' ><?= $row['tags']; ?></span>&bullet;
                                            <span class="mr-2"><?= date('d M y', strtotime($row['created_date'])); ?></span> &bullet;
                                            <span class="mr-2"><?= $row['category_name']; ?></span> &bullet;
                                            <span class="ml-2"><span class="fa fa-comments"></span> <?= $row['no_of_comments'] ?></span>
                                        </div>
                                        <h2><?= $row['title']; ?> </h2>
                                    </span>
                                </a>
                            </div>

                            <!-- END post -->

                        </div>
                    </div>
<?php } ?>

            </div>

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">

                <!-- END sidebar-box -->
                <div class="sidebar-box">
                    <div class="bio text-center">
                        <img src="uploads/pranjal.jpg" alt="Image Placeholder" class="img-fluid">
                        <div class="bio-body">
                            <h2>Pranjal Singh</h2>
                            <p>Hey!! I am one of the blogger on the site. I have written many blogs here and have an immense love for writing. Thank you!!</p>
                         <!--   <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p> -->
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
</body>
</html>