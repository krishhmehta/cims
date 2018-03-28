<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){
        if(isset($_REQUEST['actid'])){
            $batch_time_id= $_REQUEST['actid'];
            $query=mysqli_query($conn,"update cims_batches set status='Active' where batch_time_id=$batch_time_id");
        }
        if(isset($_REQUEST['dactid'])){
            $batch_time_id= $_REQUEST['dactid'];
            $query=mysqli_query($conn,"update cims_batches set status='Deactive' where batch_time_id=$batch_time_id");
        }
        if(isset($_REQUEST['did'])){
            $batch_time_id= $_REQUEST['did'];
            $query=mysqli_query($conn,"delete from cims_batches where batch_time_id=$batch_time_id");
        }        
    }
    
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
        <h2>Batch</h2>        
        <form id="form-search" method="post">
            <input type="hidden" name="batchval" value="batch">
            <table>
                <tr>
                    <td>select cource</td><td><select name="courceid" id="courceid">
                                                <option value="" disabled="" selected="">Select cource</option>
                                                <?php $query= mysqli_query($conn, "select * from cims_cources where status='Active'");

                                                    while($res=mysqli_fetch_assoc($query)){?>
                                                <option value="<?php echo $res['cource_id']; ?>"><?php echo $res['cource_code'].'  '.$res['cource_name']; ?></option>
                                                <?php } ?>
                        </select></td></tr>
                <tr><td>time</td><td><input type="time" name="time" id="time"> </td></tr>
                 <tr>   <td>session</td>
                     <td><select name="session" id="session" >
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                                <option value="Evening">Evening</option>
                         </select></td>
                 </tr>
                 <tr>    <td>total_seat</td><td><input type="text" name="total_seat" id="total_seat"></td></tr>
                 <tr>   <td>startdate</td><td><input type="date" name="startdate" id="startdate"></td></tr>
                 <tr>   <td>enddate</td><td><input type="date" name="enddate" id="enddate"></td></tr>
                 <tr>    <td>duration</td><td>year<input type="text" name="yearduration" id="yearduration" value="0">
                         month<input type="text" name="monduration" id="monduration" value="0"></td></tr>
                 <tr>    <td>fees</td><td><input type="text" name="fees" id="fees"></td></tr>
                 <tr><td>Click to add</td><td></td></tr>
            </table> 
            <input type="button" id="button" value="add">
        </form><br>
        <div id="result">
            <table border="1">
            <tr>
                <td>course</td>
                <td>time</td>
                <td>session</td>
                <td>total_seat</td>
                <td>startdate</td>
                <td>enddate</td>
                <td>duration</td>
                <td>fees</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_batches");
                while($res=mysqli_fetch_assoc($query)){
                    $cource_id=$res['cource_id'];
                    $query1=mysqli_query($conn,"select * from cims_cources where cource_id='$cource_id'");
                    $res1= mysqli_fetch_assoc($query1);                   // print_r($res1);exit();
            ?>
                <tr>
                    <td><?php echo $res1['cource_name']; ?></td>
                    <td><?php echo $res['time']; ?></td>
                    <td><?php echo $res['session']; ?></td>
                    <td><?php echo $res['total_seat']; ?></td>
                    <td><?php echo $res['startdate']; ?></td>
                    <td><?php echo $res['enddate']; ?></td>
                    <td><?php echo $res['duration']; ?></td>
                    <td><?php echo $res['fees']; ?></td>
                    <td><?php echo $res['status']; ?></td>
                    <td><a href="batches.php?actid=<?php echo $res['batch_time_id'] ?>">Active</a>
                        <a href="batches.php?dactid=<?php echo $res['batch_time_id'] ?>">Deactive</a>
                        <a href="batches_edit.php?eid=<?php echo $res['batch_time_id'] ?>">Edit</a>
                        <a href="batches.php?did=<?php echo $res['batch_time_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
        </div>        
    </center>
    </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
         $("#button").click(function(){
            //var cource=$("#total_seat").val();
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
    });
</script>    
