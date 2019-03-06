<?php
include('header.php');
include('config.php');

$blgstatus = array(0 => 'Archived', 1 => 'pending', 2 => 'Approved and Active', 3 => 'Rejected');
//$category = array(10 => 'Politics', 11 => 'Entertainment', 12 => 'Sports', 13 => 'Marketing');

$query = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id LEFT JOIN category ON category.category_id = blogger.category_id WHERE blogger.blog_status=2 ORDER BY blogger.created_date desc LIMIT 4";
$result = mysqli_query($conn, $query);
?>
<!-- END header -->


<section class="site-section pt-5">
    <div class="container">

        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">

                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-4">Hi There! I'm Vishal Nirwan</h2>
                        <p class="mb-5"><img src="images/vishal.jpg" width="300px" alt="Image placeholder" class="img-fluid"></p>
                        <p>This site has been developed by Vishal Nirwan on February 2016 and is being used for bloggging by the users. People can read and post any kind of blogs within the category on the site.</p>
                        <p>People find it very easy to engage themselves on our site as the data they look for is easily available on our site without much hustle and people are very satisfied with what we do in this field. When we ask people about the complexity of the side there is only positivity from their end and that is what encourages us.</p>
                        <p>We try to seek what's there on a person's mind is shared among different users around the globe</p>
                        <p> THANK YOU</p>
                    </div>
                </div>

                <div class="row mb-5 mt-5">
                    <div class="col-md-12 mb-5">
                        <h2>My Latest Posts</h2>
                    </div>
                    <div class="col-md-12">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                            <div class="post-entry-horzontal">
                                <a href="blog-single.php?bid=<?= $row['bid']; ?>">
                                    <div class="image" style="background-image: url('<?php echo $row["picture"] ?>');"></div>
                                    <span class="text">
                                        <div class="post-meta">
                                            <span class="author mr-2"><img src="<?php echo $row["pic"] ?>"> <?= $row['firstname'] . " " . $row['lastname'] ?>b</span>&bullet;
                                            <span class="mr-2"><?= $row['created_date']; ?></span> &bullet;
                                            <span class="mr-2"><?= $row['category_name']; ?></span> &bullet;
                                            <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                        </div>
                                        <h2><?= $row['title']; ?></h2>
                                    </span>
                                </a>
                            </div>
                            <?php
                        }
                        ?>


                    </div>
                </div>

                <!--    <div class="row">
                      <div class="col-md-12 text-center">
                        <nav aria-label="Page navigation" class="text-center">
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
                    </div> -->



            </div>

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">
                <!--   <div class="sidebar-box search-form-wrap">
                    <form action="#" class="search-form">
                      <div class="form-group">
                        <span class="icon fa fa-search"></span>
                        <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                      </div>
                    </form>
                  </div> -->


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
</php>