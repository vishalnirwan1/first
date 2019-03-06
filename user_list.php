<?php
include('header2.php');
include('config.php');
session_start();
?>

<h2 style="color:blue">LIST OF USERS </h2> 

<form class="searchbox_1" method="post" action="user_list.php"  onsubmit="return false"> 
    <input type="text" class="search_1" name="name"  id='name' placeholder="Search with firstname...."> <!--onkeyup="myFunction()"--> 
    <input type="text" class="search_1" name="phone" id='phone' placeholder="Search with phone no.....">
    From: <input type="date" class="search_1" name="from" id='from' value="<?php echo $_POST['from']; ?> ">
    to: <input type="date" class="search_1" name="to" if='to' value="<?php echo $_POST['to']; ?> ">
    <input type="submit" class="submit_1" name="search1" onclick="searchqq()"  value="search" >
    <br>
</form>

<div class="container">
    <div class="table-responsive" id="table2"></div>

</div>
<script>
    /*function myFunction() {
     var input, filter, table, tr, td, i, txtValue;
     input = document.getElementById("search1");
     filter = input.value.toUpperCase();
     table = document.getElementById("t1");
     tr = table.getElementsByTagName("tr");
     for (i = 0; i < tr.length; i++) {
     td = tr[i].getElementsByTagName("td")[6];
     if (td) {
     txtValue = td.textContent || td.innerText;
     if (txtValue.toUpperCase().indexOf(filter) > -1) {
     tr[i].style.display = "";
     } else {
     tr[i].style.display = "none";
     }
     }       
     }
     }*/
    $(document).ready(function () {
        load_data(1);
        function load_data(page)
        {
            //console.log(page);
            $.ajax({
                type: "POST",
                url: "listing.php",
                data: $('form').serialize() + '&page=' + page,
                dataType: 'html',
                success: function (data) {
                    if (data != '')
                    {

                        $('#table2').html(data);
                    }
                }
            });
        }
        $(document).on('click', '.pagination', function () {
            var page = $(this).attr("id");
            load_data(page);
        });
    });

    function searchqq()
    {
        var name = $('#name').val();
        var phone = $('#phone').val();
        var from = $('#from').val();
        var to = $('#to').val();
        //console.log(phone);
        $.ajax({
            type: 'POST',
            url: 'listing.php',
            data: {'phone': phone, 'name': name, 'from': from, 'to': to, 'page': '1'},
            dataType: 'html',
            success: function (result)
            { //console.log(result);
                if (result != '')
                {
                    $('#table2').empty();
                    $('#table2').html(result);
                }

            }
        });
    }


    function confirmation(id)
    {
        var r = confirm("are you sure you want to delete this record?");

        if (r == true)
        {
            window.location.href = "delete.php?id=" + id;
        }
        else
        {
            window.location.href = "user_list.php";
        }
    }
</script>

