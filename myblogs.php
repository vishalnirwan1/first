<?php
include('header.php');
include('config.php')
?>


<section class="site-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>My Blogs</h1>
                <a href="editblog.php" style="float: center">Add a blog</a>
                <br>
            </div>
        </div>
        <div class="row blog-entries">
            <!--  <div class="col-md-12 col-lg-8 main-content"> -->
            <form class="searchbox_1" method="post" action="blog_list.php"  onsubmit="return false"> 
                <select id='category' class="search_1" name='category'>
                    <option value=''>Search by blog category</option>
                    <option value='1'> Politics</option>
                    <option value='2'> Entertainment</option>
                    <option value='3'>Sports</option>
                    <option value='4'>Marketing</option>

                </select>                                    <!--onkeyup="myFunction()"--> 
                From: <input type="date" class="search_1" name="from" id='from' value="<?php echo $_POST['from']; ?> ">
                to: <input type="date" class="search_1" name="to" if='to' value="<?php echo $_POST['to']; ?> ">
                <select id='status' class="search_1" name='status'>
                    <option value=''>Search by blog status</option>
                    <option value='1'>Search by Pending blogs</option>
                    <option value='2'>Search by Approved blogs</option>
                    <option value='3'>Search by Rejected blogs</option>

                </select>
                <input type="submit" class="submit_1" name="search1" onclick="search()"  value="search" >
                <br>
            </form>

            <div id='table3'></div>
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

           $(document).ready(function () {
               load_data(1);
               function load_data(page)
               {
                   // console.log(page);
                   $.ajax({
                       type: "POST",
                       url: "my_bloglist.php",
                       data: $('form').serialize() + '&page=' + page,
                       dataType: 'html',
                       success: function (data) {
                           if (data != '')
                           {

                               $('#table3').html(data);
                           }
                       }
                   });
               }
               $(document).on('click', '.pagi', function () {
                   var page = $(this).attr("id");
                   load_data(page);
               });
           });


           function search()
           {
               var category = $('#category').val();
               var status = $('#status').val();
               var from = $('#from').val();
               var to = $('#to').val();
               //console.log(status);
               $.ajax({
                   type: 'POST',
                   url: 'my_bloglist.php',
                   data: {'status': status, 'category': category, 'from': from, 'to': to, 'page': '1'},
                   dataType: 'html',
                   success: function (result)
                   {// console.log(result);
                       if (result != '')
                       {
                           $('#table3').empty();
                           $('#table3').html(result);
                       }

                   }
               });
           }
           function confirmation(bid)
           {
               var r = confirm("are you sure you want to archive this blog?");

               if (r == true)
               {
                   window.location.href = "archive.php?bid=" + bid;
               }
               else
               {
                   window.location.href = "myblogs.php";
               }
           }
</script>         