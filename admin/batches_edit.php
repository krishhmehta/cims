<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){       
        if(isset($_REQUEST['eid'])){
            $batch_time_id= $_REQUEST['eid'];
            $equery=mysqli_query($conn,"select * from cims_batches where batch_time_id=$batch_time_id");
            $eres= mysqli_fetch_assoc($equery);
        }
        
        if(isset($_REQUEST['update'])=='edit'){
            $batch_time_id= $_REQUEST['eid'];
            extract($_POST);
            $yearduration=$_POST['yearduration'];
            $monduration=$_POST['monduration'];
            $duration=$yearduration.'.'.$monduration;
            //echo $fees;exit();
            $query=mysqli_query($conn,"update cims_batches set cource_id='$courceid',time='$time',session='$session',total_seat='$total_seat',startdate='$startdate',enddate='$enddate',duration='$duration',fees='$fees' where batch_time_id=$batch_time_id")or die('error.!');
            if($query){
                echo "<script> window.location.href='batches.php'; alert('update sucessfully');</script>";
                //header('Location:cources.php');
            }
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
        <form id="form-search" method="post" action="">
            <input type="hidden" name="batchval" value="batch">
            <table>
                <tr>
                    <td>select cource</td><td><select name="courceid" id="courceid">
                                                <option value="" disabled="" selected="">Select cource</option>
                                                <?php $query= mysqli_query($conn, "select * from cims_cources where status='Active'");
                                                      while($res=mysqli_fetch_assoc($query)){?>
                                                <option <?php if($eres['cource_id']== $res['cource_id']) { ?>selected=""<?php } ?> value="<?php echo $res['cource_id']; ?>"><?php echo $res['cource_code'].'  '.$res['cource_name']; ?></option>
                                                <?php } ?>
                        </select></td></tr>
                <tr><td>time</td><td><input type="time" name="time" id="time" value="<?php echo $eres['time']; ?>" required=""> </td></tr>
                 <tr>   <td>session</td>
                     <td><select name="session" id="session" required="">
                                <option <?php if($eres['session']== 'Morning') { ?>selected=""<?php } ?> value="Morning">Morning</option>
                                <option <?php if($eres['session']== 'Afternoon') { ?>selected=""<?php } ?> value="Afternoon">Afternoon</option>
                                <option <?php if($eres['session']== 'Evening') { ?>selected=""<?php } ?> value="Evening">Evening</option>
                         </select></td>
                 </tr>
                 <tr>    <td>total_seat</td><td><input type="text" name="total_seat" id="total_seat" value="<?php echo $eres['total_seat']; ?>" required=""></td></tr>
                 <tr>   <td>startdate</td><td><input type="date" name="startdate" id="startdate" value="<?php echo $eres['startdate']; ?>" required=""></td></tr>
                 <tr>   <td>enddate</td><td><input type="date" name="enddate" id="enddate" value="<?php echo $eres['enddate']; ?>" required=""></td></tr>
                 <tr><?php $durations=$eres['duration']; 
                           $dur = explode('.', $durations);
                     ?>
                     <td>duration </td>
                     <td>year<input type="text" name="yearduration" id="yearduration" value="<?php echo $dur[0];?>" required="">
                         month<input type="text" name="monduration" id="monduration" value="<?php echo $dur[1];?>" required=""></td>
                 </tr>
                 <tr>    <td>fees</td><td><input type="text" name="fees" id="fees" value="<?php echo $eres['fees']; ?>" required=""></td></tr>
                 <tr><td>Click to add</td><td></td></tr>
            </table> 
            <input type="submit" id="button" name="update" value="edit"> 
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
