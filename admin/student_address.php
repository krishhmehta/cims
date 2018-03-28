<?php
    include("connection.php");   
//    if(isset($_REQUEST['val'])){
//        echo $_REQUEST['val'];exit();
//    }
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <center>
        <h2><a href="dashboard.php">back</a></h2>
        <form id="form-search" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="studadd" value="studentadd">
            <h2>Student Address</h2>
            <div class="container">
                <?php $studval=$_REQUEST['val']; ?>
                <input type="hidden" name="studentid" value="<?php echo $studval; ?>">
                 <label for="user"><b>permanent_address</b></label><br>
                 <textarea name="permanent_address" id="permanent_address"></textarea>
              <br>   <br>

              <label for="user"><b>present_address</b></label><br>
              <textarea name="present_address" id="present_address"></textarea>
              <br><br>
              <label for="pass"><b>Country</b></label><br>
              <select name="country" id="country" required="">
                    <option value="0" disabled="" selected="">Select country</option>
                    <?php $query= mysqli_query($conn, "select * from cims_countries");

                     while($res=mysqli_fetch_assoc($query)){?>
                    <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                    <?php } ?>
                </select>
              <br><br>
              <label for="mobile"><b>State</b></label><br>
                <select name="state" id="state" required="">
                    <option value="" >Select state first</option>
                </select>
              <br><br>
              <label for="mobile"><b>City</b></label><br>
              <select name="city" id="city" required="">
                    <option value="" >Select city first</option>
              </select><br>
               <label for="user"><b>zipcode</b></label><br>  
               <input type="text" name="zipcode" id="zipcode" >
              <br><br><br>              
              <input type="button" id="button" value="add"><br>             
<!--            <input type="button" id="button" value="add">-->
            </div>            
        </form><br>
        <div id="result">
           
        </div>
    </center>
    </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#button").click(function(){
//            var cource=$("#cource").val();alert(cource);exit();
            var data = $("#form-search").serialize();
            if(data==''){
                alert('fill all data');
            }else{
                $.ajax({
                    data:data,
                    type:"post",
                    url:"ajaxdata.php",
                    success:function(msg){
                        $('#result').html(msg);
                    },
                    error:function(e){
                        alert("ERROR: " + e.status + " " + e.statusText);
                    }
                });
            }
        });
        
        $("#country").on('change',function(){
            var country_id = $(this).val();
            if(country_id){
                $.ajax({
                    data:{country_id:country_id},
                    type:"post",
                    url:"ajaxdata.php",
                    success:function(msg){
                        $('#state').html(msg);
                    },
                    error:function(e){
                        alert("ERROR: " + e.status + " " + e.statusText);
                    }
                });
            }else{
                $("#state").html('<option value="">Select state first</option>');
            }
        });
        
        $("#state").on('change',function(){
            var state_id = $(this).val();
            if(state_id){
                $.ajax({
                    data:{state_id:state_id},
                    type:"post",
                    url:"ajaxdata.php",
                    success:function(msg){
                        $('#city').html(msg);
                    },
                    error:function(e){
                        alert("ERROR: " + e.status + " " + e.statusText);
                    }
                });
            }else{
                $("#city").html('<option value="">Select city first</option>');
            }
        });
        
    });
    
</script>  