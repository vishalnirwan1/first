<?php

include('config.php');

$id = $_POST['id'];
if (isset($_POST['save'])) {
    //print_r($_POST);die;
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    //$address = $_POST['address'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];

    //  print_r($username);die;
//echo '<pre>';  print_r($_FILES);die;
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $pic_size=$_FILES["uploadfile"]["size"];
    $folder = "uploads/" . $filename;
    // $folder1="localhost/blogging/blogging/uploads/" . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
   // print_r($extension);die;
    //echo '<pre>';  print_r($_FILES);die;
    $ext = array('jpg', 'jpeg', 'png');

    if (!in_array($extension, $ext) && isset($tempname) && $tempname != '') {
        echo "invalid image format";
        return false;
        
    } else {
        if (isset($tempname) && $tempname != '') {
            move_uploaded_file($tempname, $folder);
            //copy($folder,$folder1);
        }
        include_once('resize.php');
        $target_file=$folder;
        $resized_file="uploads/thumbnails/resized_".$filename;
        $wmax=200;
        $hmax=150;
        image_resize($target_file,$resized_file,$wmax,$hmax,$extension);
      
    }


    $check_query = "SELECT * FROM info WHERE (username='$username' OR email='$email')AND NOT id='$id' LIMIT 1";
    $result = mysqli_query($conn, $check_query);

    $user = mysqli_fetch_assoc($result);

    if ($user) {          // echo $user;die;
        if ($user['username'] === $username) {

            header("location:myprofile.php?type=1");

            // echo '<p style="color:red">'.$status.'</p>';
        }
        if ($user['email'] === $email) {
            header("location:myprofile.php?type=2");
            //echo '<p style="color:red">'.$status.'</p>';
        }
    } else {
        $img = '';
        if (in_array($extension, $ext) && isset($tempname) && $tempname != '') {
            $img = ",pic='$folder'";
        }

        $update = "UPDATE info set firstname='$firstname', lastname='$lastname',gender='$gender', email='$email',phone='$phone', username='$username'" . $img . " where id='$id'";
        mysqli_query($conn, $update) or die(mysqli_error());
        header("location:myprofile.php?type=3");
        /*  $tocheck = "SELECT * from address WHERE user_id='$id'";
          $result = mysqli_query($conn, $tocheck) or die(mysqli_error());
          if ($result) {
          $updat1 = "UPDATE address set status='0' WHERE user_id='$id'";
          mysqli_query($conn, $updat1) or die(mysqli_error());
          foreach ($address as $value) {
          //print_r($value);
          $insert1 = "INSERT into address(user_id,addr,status)values('$id','$value','1')";
          mysqli_query($conn, $insert1) or die(mysqli_error());
          }
          header("location:myprofile.php?type=3");
          } else {
          $insert = "INSERT into address(user_id,addr,status)values('$id','$address','1') ";
          mysqli_query($conn, $insert) or die(mysqli_error());
          }
          header("location:myprofile.php?type=3"); */
    }
}
?>