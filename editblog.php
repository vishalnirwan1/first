<?php
include('header.php');

$bid = $_GET['bid'];
// print_r($bid);die;
$sql = "SELECT * from blogger LEFT JOIN category ON category.category_id = blogger.category_id where blogger.bid='" . $bid . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//echo '<pre>';print_r($row);die;
$query = "SELECT GROUP_CONCAT(category_id SEPARATOR ',') as c_id ,GROUP_CONCAT(category_name SEPARATOR ',') as c_name FROM category";

$result1 = mysqli_query($conn, $query);
$row1 = mysqli_fetch_assoc($result1);
$diff_id = explode(",", $row1['c_id']);
$diff_name = explode(",", $row1['c_name']);
//print_r($diff_name);die;
$err = array(1 => 'title already exists', 2 => 'the blog already exists. please provide with some different content', 3 => 'Blog updated successfully!!!!!', 4 => 'New blog created');
?>
<div class='error'> <?php
    if ($_GET['type']) {
        echo $err[$_GET['type']];
    }
    ?>
</div>
<section class="site-section">
    <div class="container">
        <div class="row mb-4">

            <div class="row blog-entries">
                <div class="col-md-12 col-lg-8 main-content">
                    <?php
                    if ($bid != ' ') {
                        ?>

                        <form name="blog" action="" method="post" enctype="multipart/form-data">

                            <fieldset style="background-color:darkseagreen" >
                                <div class="blog1">
                                    <label style="color:black">Choose your category : </label> <br>
                                    <select name='ctgry'>
                                        <option value=''>Choose Your Category</option>
                                        <?php
                                        foreach (array_combine($diff_id, $diff_name) as $diff_id => $diff_name) {
                                            ?>
                                            <option value="<?= $diff_id ?>" <?php
                                            if ($diff_id == $row['category_id']) {
                                                echo 'selected=selected';
                                            }
                                            ?>><?= $diff_name ?> </option>
                                                <?php } ?>   
                                    </select> <br>
                                    <label style="color:black">Title :</label> <br>
                                    <textarea name="title" rows="2" cols="60" title="can't be empty before submitting"  required><?php echo $row['title']; ?></textarea>
                                    <br>
                                    <img src="<?php echo $row["picture"] ?>" height='100' width='150' id="toshow">
                                    <p><strong style="color:black">Upload image : </strong>  
                                        <input type="file" name="uploadfile" value="" onchange="display(this)"></p>
                                    <label style="color:black">Your blog goes here....</label> <br>
                                    <textarea id="mytextarea" name="msg" title="can't be empty before submitting" required><?php echo $row['msg']; ?> </textarea>
                                    <br>
                                    <label style="color:black">#hashtags</label> <br>
                                    <textarea name="tags"  rows="2" cols="40" title="can't be empty before submitting"  required><?php echo $row['tags']; ?></textarea> <br>
                                    <p><input type="submit" class="bbtn" name="save_blog" value="Save"></p>
                                </div>
                            </fieldset>
                        </form>
                        <?php
                        if (isset($_POST['save_blog'])) {
                            //  print_r($_GET);die;
                            $title = $_POST['title'];
                            $msg = $_POST['msg'];
                            $tags = $_POST['tags'];
                            $category = $_POST['ctgry'];
                            $id = $_SESSION['id'];

                            //   echo '<pre>';  print_r($_FILES);die;
                            $filename = $_FILES["uploadfile"]["name"];
                            $tempname = $_FILES["uploadfile"]["tmp_name"];
                            $folder = "uploads/" . $filename;
                            //    $folder1="localhost/blogging/blogging/uploads" . $filename;
                            ///  print_r($folder);die;
                            $extension = pathinfo($filename, PATHINFO_EXTENSION);
                            $ext = array('jpg', 'jpeg', 'png');

                            if (!in_array($extension, $ext) && isset($tempname) && $tempname != '') {
                                echo "invalid image format";
                                return false;
                                //  echo '<p style="color:red">'.$status.'</p>';
                            } else {
                                if (isset($tempname) && $tempname != '') {
                                    move_uploaded_file($tempname, $folder);
                                    //  copy($folder,$folder1);
                                }
                            }
                            $img = '';
                            if (in_array($extension, $ext) && isset($tempname) && $tempname != '') {
                                $img = ",picture='$folder'";
                            }

                            $check_query = "SELECT * FROM blogger WHERE (title='$title' OR msg='$msg')AND NOT bid='$bid' LIMIT 1";
                            $result = mysqli_query($conn, $check_query);

                            $user = mysqli_fetch_assoc($result);

                            if ($user) {
                                if ($user['title'] === $title) {

                                    header("location:editblog.php?type=1");
                                }
                                if ($user['msg'] === $msg) {
                                    header("location:editblog.php?type=2");
                                }
                            } else {


                                if (isset($bid) && $bid != '') {
                                    $update = "UPDATE blogger set title='$title'" . $img . ", msg='$msg',tags='$tags',category_id='$category' WHERE bid='$bid'";
                                    mysqli_query($conn, $update) or die(mysqli_error());
                                    //echo 'ddff';
                                    header("location:editblog.php?type=3&bid=" . $bid);
                                } else {
                                    $sql = "Insert into blogger(id,title,msg,tags,blog_status,category_id)values('$id','$title','$msg','$tags','1','$category')";

                                    $result = $conn->query($sql);
                                    $last_id = mysqli_insert_id($conn);
                                    //  echo 'sdfsd';print_r($last_id);die;
                                    header("location:editblog.php?type=4&bid=" . $last_id);
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-md-12 col-lg-4 sidebar">

                    <!-- END sidebar-box -->

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
<script>
                    function display(dp)
                    {
                        if (dp.files && dp.files[0]) {
                            var read = new FileReader();

                            read.onload = function (e) {
                                $('#toshow').attr('src', e.target.result);
                            }

                            read.readAsDataURL(dp.files[0]);
                        }
                    }
</script>
</body>
</html>
