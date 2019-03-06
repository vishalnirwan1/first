<?php
ini_set('display_errors', 1);


include('header2.php');
?>

<div class="al">

    <h2 style="color:blue">LIST OF BLOGS</h2> 
    <br>
    <div id="msg">   </div>
    <form method="post" action="allblogs.php" onsubmit="return false" id="form1"> 
        <input type="text" class="search_1" id="title" name="title" placeholder="Search with title...." >
        <input type="text" class="search_1" id="name" name="name" placeholder="Search with blogger's name.....">
        From: <input type="date" class="search_1" id="from" name="from" value="<?php echo $_POST['from']; ?> ">
        to: <input type="date" class="search_1" id="to" name="to" value="<?php echo $_POST['to']; ?> ">
        <select id='blog_status' class="search_1" name='blogstatus'>
            <option value=''>Search by blog status</option>
            <option value='1'>Search by pending blogs</option>
            <option value='2'>Search by approved blogs</option>
            <option value='3'>Search by rejected blogs</option>

        </select>

        <input type="submit" class="submit_1" name="submit" onclick="search()" value="search">
    </form>
    <!--<form method="post" id="form2" onsubmit="false" action="">-->

    <button type="submit" class="btn btn-info" name="export" onclick="exportfile()">Export CSV</button>
    <!--</form> <br>--> 

    <div class="container">
        <div class="table-responsive" id="table1"></div>

    </div>
</div>


<?php /* if ($next <= $totalpages && $totalpages >= 2) {
  ?>  <li class="page-item"><a class="page-link" href="allblogs.php?page=<?php echo $next ?>" style="text-decoration:none">Next</a> </li><?php
  }
  for ($b = $totalpages; $b >=1; $b--) {
  ?> <li class="page-item"><a class="page-link" href="allblogs.php?page=<?php echo $b ?>" style="text-decoration:none"><?php echo $b . " "; ?></a></li> <?php
  }
  if ($prev >= 1) {
  ?>  <li class="page-item"><a class="page-link" href="allblogs.php?page=<?php echo $prev ?>" style="text-decoration:none">Prev</a></li> <?php
  }

 */ ?>




<div id="modal1" class="modal fade" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Choose your reason here....</h4>
                <div id="reason"></div>

                <div id="showarea1"  style="display:none;"> <textarea id="showarea" name="reject" value=" others ">  </textarea> </div>    
<!-- <input   type="text" id="reject_reason" name="reject_reason" value=""> -->
                <input   type="hidden" id="blog_id" value="">

                <button onclick="update_reason()" type="button" name="btn-modal">Submit</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        load_data(1);
        function load_data(page)
        {
            //console.log(page);
            $.ajax({
                type: "POST",
                url: "table.php",
                data: $('#form1').serialize() + '&page=' + page,
                dataType: 'html',
                success: function (data) {
                    if (data != '')
                    {

                        $('#table1').html(data);
                    }
                }
            });
        }
        $(document).on('click', '.pagination', function () {
            var page = $(this).attr("id");
            load_data(page);
        });
    });
    function search()
    {
        var title = $('#title').val();
        var name = $('#name').val();
        var from = $('#from').val();
        var to = $('#to').val();
        var blogStatus = $('#blog_status').val();

        $.ajax({
            type: 'POST',
            url: 'table.php',
            data: {'title': title, 'name': name, 'from': from, 'to': to, 'blogstatus': blogStatus, 'page': '1'},
            dataType: 'html',
            success: function (result)
            {
                if (result != '')
                {
                    $('#table1').empty();
                    $('#table1').html(result);
                }

            }
        });
    }
    function exportfile()
    {
        // alert($('#form1').serialize());
        window.location.href = "export.php?" + $('#form1').serialize();
        return false;

//         $.ajax({
//                type: "POST",
//                url: "export.php",
//                data: $('#form1').serialize(),
//                dataType: 'html',
//                success: function (data) {
//                 //console.log(data);
//                    if (data != '')
//                    {
//                        
//                       alert("file downloaded"); 
//                    }
//                }
//            });
    }
    function changeRating(blogId)
    {
        var blogRating = $('#blog_rating_' + blogId).val();
        $.ajax({
            type: 'POST',
            url: 'update_brating.php',
            data: {'blrating': blogRating, 'blog_id': blogId},
            dataType: 'text',
            success: function (result) {
                if (result != '')
                {
                    alert(result);
                }
            }
        });

    }

    function changeStatus(blogId) {
        var blogStatus = $('#blog_status_' + blogId).val();

        //  $(.rejection1).jQuery.inArray();
        if (blogStatus == '3')
        {
            $(".modal").modal();
            $("#blog_id").val(blogId);
            // $("#rejection").val();
            // $("#reject_reason").val('');
            $.ajax({
                type: 'POST',
                url: 'reason.php',
                data: {'blog_id': blogId},
                dataType: 'html',
                success: function (result) {
                    if (result != '')
                    {
                        $('#reason').html(result);
                    }
                }
            });
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: 'update_bstatus.php',
                data: {'blstatus': blogStatus, 'blog_id': blogId, 'status_update': '1'},
                dataType: 'text',
                success: function (result) {
                    if (result != '')
                    {
                        alert(result);
                    }
                }
            });
        }
        // saveData.error(function() { alert("Something went wrong"); });
    }
    ;

    function update_reason()
    {
        var blogId = $("#blog_id").val();
        var reject_reason = [];
        var rejectString = '';
        $('input[type="checkbox"]:checked').each(function (i) {
            reject_reason[i] = $(this).val();

        });
        var others_reason = $("#showarea").val();
        rejectString = reject_reason.toString();
        ///console.log(rejectString);
        $.ajax({
            type: 'POST',
            url: 'update_bstatus.php',
            data: {'blog_id': blogId, 'blog_reason': '1', 'rejection': rejectString, 'otherreason': others_reason},
            dataType: 'text',
            success: function (result) {
                if (result != '')
                {
                    alert('reason updated');
                    $('.modal').modal('hide');
                }
            }

        });
    }
    function test()
    {
        console.log($("input.rejection1").is(":checked"));
        if ($("input.rejection1").is(":checked") == true) {
            $("#showarea1").show();
        }
        else {
            $("#showarea1").hide();
        }
    }


    /*  $('.rejection').click(function(e){
     if (e.target.checked) {
     localStorage.checked = true;
     } 
     else {
     localStorage.checked = false;
     }
     })
     
     $(document).ready(function() {
     
     document.querySelector('.rejection').checked = localStorage.checked 
     
     }); */

</script>
