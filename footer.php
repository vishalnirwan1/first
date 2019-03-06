<?php
include('config.php');
//$category = array(10 => 'Politics', 11 => 'Entertainment', 12 => 'Sports', 13 => 'Marketing');

$query = "SELECT * FROM blogger LEFT JOIN info ON blogger.id=info.id LEFT JOIN category ON category.category_id = blogger.category_id WHERE blogger.blog_status=2 ORDER BY blogger.created_date LIMIT 3";
$result = mysqli_query($conn, $query);
?>

<footer class="site-footer">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <h3>About Us</h3>
                <p class="mb-4">
                    <img src="images/vishal.jpg" alt="Image placeholder" class="img-fluid">
                </p>

                <p>This site has been developed by Vishal Nirwan on February 2016 and is being used for bloggging by the users. People can read and post any kind of blogs within the category on the site. THANK YOU <a href="about.php">Read More</a></p>
            </div>
            <div class="col-md-6 ml-auto">
                <div class="row">
                    <div class="col-md-7">
                        <h3>FEATURED POSTS : </h3>
                        <div class="post-entry-sidebar">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <ul>
                                    <li>
                                        <a href="blog-single.php?bid=<?= $row['bid']; ?>">
                                            <img src="<?= $row['picture']; ?>" alt="Image placeholder" class="mr-4">
                                            <div class="text">
                                                <h4><?= $row['title']; ?> </h4>
                                                <div class="post-meta">
                                                    <span class="author mr-2"> <?= $row['firstname'] . " " . $row['lastname'] ?></span>&bullet;
                                                    <span class="mr-2"><?= $row['created_date']; ?> </span> &bullet;
                                                    <span class="mr-2"><?= $row['category_name']; ?></span> &bullet;
                                                    <span class="ml-2"><span class="fa fa-comments"></span> <?= $row['no_of_comments'] ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!--       <li>
                                             <a href="">
                                               <img src="images/politics2.jpeg" alt="Image placeholder" class="mr-4">
                                               <div class="text">
                                                 <h4>All About Politics</h4>
                                                 <div class="post-meta">
                                                   <span class="mr-2">March 15, 2018 </span> &bullet;
                                                   <span class="ml-2"><span class="fa fa-comments"></span> 1</span>
                                                 </div>
                                               </div>
                                             </a>
                                           </li>
                                           <li>
                                             <a href="">
                                               <img src="images/img_10.jpg" alt="Image placeholder" class="mr-4">
                                               <div class="text">
                                                 <h4>All About Life-Style</h4>
                                                 <div class="post-meta">
                                                   <span class="mr-2">March 15, 2018 </span> &bullet;
                                                   <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                                 </div>
                                               </div>
                                             </a>
                                           </li>   -->
                                </ul>
    <?php
}
?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-4">

                        <div class="mb-5">
                            <h3>Quick Links</h3>
                            <ul class="list-unstyled">
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="category.php?category=1">Politics</a></li>
                                <li><a href="category.php?category=3">Sports</a></li>
                                <li><a href="contact.php">Contact Us</a></li>

                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3>Social</h3>
                            <ul class="list-unstyled footer-social">
                                <li><a href="https://twitter.com"><span class="fa fa-twitter"></span> Twitter</a></li>
                                <li><a href="https://facebook.com"><span class="fa fa-facebook"></span> Facebook</a></li>
                                <li><a href="https://instagram.com"><span class="fa fa-instagram"></span> Instagram</a></li>
                                <li><a href="https://youtube.com"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="small">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This Website is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="about.php" target="_blank" >Vishal Nirwan</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>