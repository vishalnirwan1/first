<?php
include('config.php');
include('header.php');
$blgstatus = array(0 => 'Archived', 1 => 'pending', 2 => 'Approved and Active', 3 => 'Rejected');


$query = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id LEFT JOIN category ON category.category_id = blogger.category_id WHERE blogger.blog_status=2 ORDER BY blogger.created_date desc LIMIT 8";
$result = mysqli_query($conn, $query);

$query1 = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id LEFT JOIN category ON category.category_id = blogger.category_id WHERE blogger.blog_status=2 AND blogger.rating < 5 ORDER BY blogger.rating desc LIMIT 3";
$result1 = mysqli_query($conn, $query1);
?>
<!-- END header -->

<section class="site-section pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="owl-carousel owl-theme home-slider">
                    <?php
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        ?>
                        <div>
                            <a href="blog-single.php?bid=<?= $row1['bid']; ?>" class="a-block d-flex align-items-center height-lg" style="background-image: url('<?= $row1['picture']; ?>') ">
                                <div class="text half-to-full">
                                    <span class="category mb-5"><?= $row1['category_name']; ?></span>
                                    <div class="post-meta">

                                        <span class="author mr-2"><img src="<?php echo $row1["pic"] ?>" > <?= $row1['firstname'] . " " . $row1['lastname'] ?></span>&bullet;
                                        <span class="mr-2"><?= $row1['created_date']; ?></span> &bullet;
                                        <span class="ml-2"><span class="fa fa-comments"></span> </span>

                                    </div>
                                    <h3><?= $row1['title']; ?></h3>
                                    <!--<p><?= $row1['msg']; ?></p> -->
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>

    </div>


</section>
<!-- END section -->

<section class="site-section py-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4">Latest Posts</h2>
            </div>
        </div>
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">

                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-6">
                            <a href="blog-single.php?bid=<?= $row['bid']; ?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
                                <img src="<?= $row['picture']; ?>" alt="Image placeholder">
                                <div class="blog-content-body">
                                    <div class="post-meta">
                                        <span class="author mr-2"> <img src="<?php echo $row["pic"] ?>" > <?= $row['firstname'] . " " . $row['lastname'] ?></span>&bullet;
                                        <span class="mr-2"> <?= $row['created_date']; ?></span> &bullet;
                                        <span class="mr-2"><?= $row['category_name']; ?></span> &bullet;
                                        <span class="ml-2"><span class="fa fa-comments "></span> <?= $row['no_of_comments'] ?> </span>
                                    </div>
                                    <h2><?= $row['title']; ?></h2>
                                </div>
                            </a>
                        </div>

<?php } ?>


                    <!--
                       
                     </div>
       
                     
                         
                           <ul class="pagination">
                             <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
                             <li class="page-item"><a class="page-link" href="#">1</a></li>
                             <li class="page-item"><a class="page-link" href="#">2</a></li>
                             <li class="page-item"><a class="page-link" href="#">3</a></li>
                             <li class="page-item"><a class="page-link" href="#">4</a></li>
                             <li class="page-item"><a class="page-link" href="#">5</a></li>
                             <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                           </ul>
                         </nav>
                       </div>
                     </div>
                    -->






                </div>

            </div>

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">

                <!-- END sidebar-box -->
                <div class="sidebar-box">
                    <div class="bio text-center">
                        <img src="uploads/IMG_20171210_155426_851.jpg" alt="Image Placeholder" class="img-fluid">
                        <div class="bio-body">
                            <h2>Vikrant Balyan</h2>
                            <p>Hey!! I am one of the blogger on the site. I have written many blogs here and have an immense love for writing. Thank you!!</p>
                         <!--   <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p> -->
                            <p class="social">
                                <a href="https://facebook.com" class="p-2"><span class="fa fa-facebook"></span></a>
                                <a href="https://twittter.com" class="p-2"><span class="fa fa-twitter"></span></a>
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
<script>
    /*  $(document).ready(function () {
     load_data(1);
     function load_data(page)
     {
     //console.log(page);
     $.ajax({
     type: "POST",
     url: "latestposthome.php",
     data: {'page': page},
     dataType: 'html',
     success: function (data) {
     if (data != '')
     {
         
     $('#homeposts').html(data);
     }
     }
     });
     }
     $(document).on('click', '.pagination', function () {
     var page = $(this).attr("id");
     load_data(page);
     });
     }); */

</script>
</body>
</html>