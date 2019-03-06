<?php
include('header.php');
$uid = $_SESSION['id'];
if (isset($_GET['id'])) {
    $uid = $_GET['id'];
}


$query = "SELECT * FROM info WHERE id=$uid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>
<div style="color:red">  


    <?php
    $msg = array(1 => 'Username aleready exists', 2 => 'email id already exists. please provide with some different email id', 3 => 'Record updated successfully!!!!!',4=>'image size should be greater than 200 * 200');
    // echo '<pre>';
    //var_dump(in_array($_GET['type'], $msg));die;
    if ($_GET['type']) {
        echo $msg[$_GET['type']];
    }
    ?>
</div>
<!-- END header -->


<section class="site-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>My Profile</h1>
            </div>
        </div>
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">

                <form action="editprofile.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <img src="<?php echo $row["pic"] ?>" height='100' width='100' id="toshow">
                            <label >Upload image:</label>
                            <input type="file" name="uploadfile" value="" onchange="display(this)">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"</p>

                        <div class="col-md-12 form-group">
                            <label >Firstname</label>
                            <input type="text" name="firstname" class="form-control " value="<?= $row['firstname'] ?>">
                        </div>
                        <div class="col-md-12 form-group">
                            <label >Lastname</label>
                            <input type="text" name="lastname" class="form-control " value="<?= $row['lastname'] ?>">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control " value="<?= $row['phone'] ?>">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control " value="<?= $row['email'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Username</label>
                            <input type='text' name="username" id="" class="form-control " value="<?= $row['username'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Gender</label>
                            <input type="text" class="form-control" name="gender" value="<?= $row['gender'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" name='save' class="btn btn-primary" >
                    </div>
                </form>


            </div>

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">

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