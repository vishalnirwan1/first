<?php
session_start();
include('config.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Blogger's Site</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">

        <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" type="text/css" href="allblogs.css">
        <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
        <script>

            tinymce.init({
                selector: '#mytextarea',
                plugins: "code image",
                menubar: "file edit view fromat"
            });

        </script>

        <!-- Theme Style -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php
        if (isset($_POST['login_user'])) {
            // print_r($_POST);die;
            $username = $_POST['username'];
            $psw = $_POST['password'];
            $returnArray = [];
            if (empty($username)) {
                $returnArray = ['status' => 'F', 'message' => 'user name is required'];
            }
            if (!empty($username) && empty($psw)) {
                $returnArray = ['status' => 'F', 'message' => 'password is required'];
            }
            if ($returnArray['status'] != 'F') {
                $password = md5($psw);
                $query = "SELECT * FROM info WHERE username='$username' AND psw='$password'";
                $results = mysqli_query($conn, $query);
                $data = mysqli_fetch_assoc($results);

                if (mysqli_num_rows($results) == 1) {
                    $_SESSION['id'] = $data['id'];
                    // $_SESSION['email'] = $data['email'];
                    $_SESSION['username'] = $data['username'];
                    header('location: myprofile.php');
                } else {
                    if (!empty($username) && !empty($psw)) {
                        $_SESSION['error_msg'] = 'Wrong username/password combination';
                        //print_r($_SESSION);die;
                        //  header('location: index.php');
                    }
                }
            } else {
                if ($returnArray['status'] = 'F') {
                    $_SESSION['error_msg'] = $returnArray['message'];
                }
                // header('location: index.php');
            }
        }

        if (isset($_POST['login_admin'])) {
            $username = $_POST['username'];
            $psw = $_POST['password'];
            $returnArray = [];
            if (empty($username)) {
                $returnArray = ['status' => 'F', 'message' => 'user name is required'];
            }
            if (!empty($username) && empty($psw)) {
                $returnArray = ['status' => 'F', 'message' => 'password is required'];
            }
            if ($returnArray['status'] != 'F') {
                $password = md5($psw);
                $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
                $results = mysqli_query($conn, $query);
                $data = mysqli_fetch_assoc($results);

                if (mysqli_num_rows($results) == 1) {
                    $_SESSION['admin_id'] = $data['id'];
                    $_SESSION['admin_name'] = $data['name'];
                    header('location: user_list.php');
                } else {
                    if (!empty($username) && !empty($psw)) {
                        $_SESSION['error_msg'] = 'Wrong username/password combination';
                        //print_r($_SESSION);die;
                        // header('location: admin_login.php');
                    }
                }
            } else {
                if ($returnArray['status'] = 'F') {
                    $_SESSION['error_msg'] = $returnArray['message'];
                }
                //  header('location: admin_login.php');
            }
        }
        ?>

        <div class="wrap">

            <header role="banner">
                <div class="top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-9 social" style="color: white">
                                <a href="https://twittter.com"><span class="fa fa-twitter"></span></a>
                                <a href="https://facebook.com"><span class="fa fa-facebook"></span></a>
                                <a href="https://instagram.com"><span class="fa fa-instagram"></span></a>
                                <a href="https://youtube.com"><span class="fa fa-youtube-play"></span></a>


                            <?php
                                if (isset($_SESSION['username'])) {
                                    echo "Welcome " . $_SESSION['username'];
                                }
                             
                                ?>    

                            </div>

                            <div class="col-3 search-top">
                              <!-- <a href="#"><span class="fa fa-search"></span></a> -->
                                <form action="" class="search-top-form">
                                    <span class="icon fa fa-search"></span>
                                    <input type="text" id="search" placeholder="Type keyword to search...">
                                </form> <br>

                                <div class="search-top-form" >
                                    <?php if (isset($_SESSION['username'])) {
                                        ?>
                                        <a href='logout.php' class="btn btn-primary">Logout</a>

                                    <?php
                                    } else {
                                        ?>
                                        <input type="submit" value="Login/SignUp" class="btn btn-primary" onclick="login()">
                                        <input type="submit" value="Admin Login" class="btn btn-primary" onclick="adminlogin()">
                                    <?php }
                                    ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="container logo-wrap">
                    <div class="row pt-5">
                        <div class="col-12 text-center">
                            <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
                            <h1 class="site-logo"><a href="index.php">Blogger's Site</a></h1>
                        </div>
                    </div>
                </div>

                <nav class="navbar navbar-expand-md  navbar-light bg-light">
                    <div class="container">


                        <div class="collapse navbar-collapse" id="navbarMenu">
                            <ul class="navbar-nav mx-auto">
                                <li class="">
                                    <a class="nav-link " href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="category.php?category=1">POLITICS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="category.php?category=3"> <!--id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" --> Sports</a>
                                    <!--  <div class="dropdown-menu" aria-labelledby="dropdown04">
                                          <a class="dropdown-item" href="category.php?category=3">Cricket</a>
                                          <a class="dropdown-item" href="category.php?category=3">Football</a>
                                          <a class="dropdown-item" href="category.php?category=3">Basketball</a>
  
                                      </div>-->

                                </li>

                                <!--     <li class="nav-item">
                                         <a class="nav-link" href="category.php?category=5">Life-style</a>
                                     </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="category.php?category=4">Marketing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="category.php?category=2">Entertainment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.php">About</a>
                                </li>
                                <?php if (isset($_SESSION['username'])) {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="myprofile.php">My Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="myblogs.php">My Blogs</a>
                                    </li>
                                <?php
                                } else {
                                    ?>
                                </ul>
                                <?php } ?>


                        </div>
                    </div>
                </nav>
            </header>

            <div id="login" class="modal" style="display:none"> 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-title" style='color:blue'>Sign In</div> 
                            <div class="error"><?php
                                echo isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : '';
                                unset($_SESSION['error_msg']);
                                ?></div>
                            <form class="modal-content animate" action="" method='post'>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="name">UserName</label> <span class="error">*</span> <br>
                                            <input type="text" name="username" class="form-control" required>
                                        </div>


                                        <div class="col-md-12 form-group">
                                            <label for="name">Password</label> <span class="error">*</span> <br>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <input type="submit" value="Login"  name="login_user" class="btn btn-primary">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                Not a Member Yet?  
                                                <a href="#" onClick="$('#login').hide();
                                                        $('#signup').show()">
                                                    Sign Up Here
                                                </a>
                                            </div>
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                Are you an Admin?  
                                                <a href="#" onClick="$('#login').hide();
                                                        $('#adminlogin').show()">
                                                    Sign in Here!
                                                </a>
                                            </div>
                                        </div>
                                    </div>    
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="signup" class="modal" style="display:none"> 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-title" style='color:blue'>Sign Up</div>

                            <form class="modal-content animate" action="">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label> First name:</label> <span class="error">*</span> <br>
                                            <input type="text" name="firstname">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Last name:</label> <span class="error">*</span><br>
                                            <input type="text" name="lastname" >
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>E-mail:</label> <span class="error">*</span> <br>
                                            <input type="text" name="email" >
                                        </div>

                                        <div class="col-md-12 form-group">
                                            Gender: <span class="error">*</span> <br>
                                            <input type="radio" name="gender" value="male" checked> Male<br>
                                            <input type="radio" name="gender" value="female"> Female<br>
                                            <input type="radio" name="gender" value="other"> Other 
                                        </div>

                                        <div class="col-md-12 form-group">
                                            Interested in:<br>
                                            <input type="checkbox" name= 'interest[]' value="sports"> sports <br>
                                            <input type="checkbox" name='interest[]' value="politics"> politics <br>
                                            <input type="checkbox" name='interest[]' value="geography"> geography <br>
                                            <input type="checkbox" name='interest[]' value="farming"> farming<br>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="name">UserName</label> <span class="error">*</span> <br>
                                            <input type="text" name="username" class="form-control" required>
                                        </div>


                                        <div class="col-md-12 form-group">
                                            <label for="name">Password</label> <span class="error">*</span> <br>
                                            <input type="text" name="password" class="form-control" required>
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <input type="submit" value="Sign Up"  name="submit" class="btn btn-primary">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                Already a Member?
                                                <a href="#" onClick="$('#signup').hide();
                                                        $('#login').show()">
                                                    Sign In Here
                                                </a>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="adminlogin" class="modal" style="display:none"> 
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-title" style='color:blue'>Admin Login</div>
                            <div class="error"><?php
                                echo isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : '';
                                unset($_SESSION['error_msg']);
                                ?></div>
                            <form class="modal-content animate" action="" method='post'>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="name">UserName</label> <span class="error">*</span> <br>
                                            <input type="text" name="username" class="form-control" required>
                                        </div>


                                        <div class="col-md-12 form-group">
                                            <label for="name">Password</label> <span class="error">*</span> <br>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <input type="submit" value="Login"  name="login_admin" class="btn btn-primary">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                Sign in as User?  
                                                <a href="#" onClick="$('#adminlogin').hide();
                                                        $('#login').show()">
                                                    Sign in
                                                </a>
                                            </div>
                                        </div>
                                    </div>    
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <script>
                /*   $("#navbarMenu .navbar-nav a").on("click", function () {
                 $("#navbarMenu .navbar-nav").find("li.active").removeClass("active");
                 $(this).parent('li')addClass("active");
                 }); */
                function  login()
                {
                    $("#login").modal();
                }
                function adminlogin()
                {
                    $("#adminlogin").modal();
                }

            </script>