<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){        
        if(isset($_REQUEST['did'])){
            $class_teacher_id = $_REQUEST['did'];
            $query=mysqli_query($conn,"delete from cims_class_teacher where class_teacher_id=$class_teacher_id");
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
        <h2>Class teacher</h2><br>
        <h2><a href="dashboard.php">back</a></h2>
           
        <form id="form-search" method="post">
            <input type="hidden" name="classteacherval" value="classteacher">
            <table>
                <tr>
                    <td>select cource</td><td><select name="cource" id="cource" required="">
                            <option value="0" disabled="" selected="">Select cource</option>
                            <?php $query= mysqli_query($conn, "select * from cims_cources where status='Active'");

                             while($res=mysqli_fetch_assoc($query)){?>
                            <option value="<?php echo $res['cource_id']; ?>"><?php echo $res['cource_code'].' - '.$res['cource_name']; ?></option>
                            <?php } ?>
                        </select></td></tr>                
                <tr><td>select batch</td>
                    <td>
                        <select name="batch" id="batch" required="">
                            <option value="" >Select cource first</option>
                        </select>
                    </td>
                </tr>
                <tr><td>Select teacher</td>
                    <td><select name="teacherid" id="teacherid" required="">
                            <option value="" disabled="" selected="">Select Teacher</option>
                            <?php $query= mysqli_query($conn, "select * from cims_teacher where status='Active'");

                             while($res=mysqli_fetch_assoc($query)){?>
                            <option value="<?php echo $res['teacher_id']; ?>"><?php echo $res['name']; ?></option>
                            <?php } ?>
                        </select></td>
                </tr>                
            </table> 
            <input type="button" id="button" value="add">
        </form><br>
        <div id="result">
            <table border="1">
            <tr>
                <td>course</td>
                <td>Batch</td>
                <td>Teacher</td>                
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_class_teacher");
                while($res=mysqli_fetch_assoc($query)){
                    $batch_time_id=$res['batch_time_id'];   $cource_id=$res['cource_id'];
                    $query1=mysqli_query($conn,"select c.cource_id,c.cource_name,b.batch_time_id,b.time from cims_batches b ,cims_cources c where b.batch_time_id='$batch_time_id' and c.cource_id='$cource_id'");
                    $res1= mysqli_fetch_assoc($query1);                   // print_r($res1);exit();
            ?>
                <tr>
                    <td><?php echo $res1['cource_name']; ?></td>
                    <td><?php echo $res1['time']; ?></td>
                    <td><?php $teacherid=$res['faculty_id']; $teacher_query=mysqli_query($conn,"select * from cims_teacher where teacher_id=$teacherid"); 
                                $tres1= mysqli_fetch_assoc($teacher_query);
                                echo $tres1['name']; ?>
                    </td>                   
                    <td>
                        <a href="class_teacher_edit.php?eid=<?php echo $res['class_teacher_id'] ?>">Edit</a>
                        <a href="class_teacher.php?did=<?php echo $res['class_teacher_id'] ?>">Delete</a>
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
        
        $("#cource").on('change',function(){
            var cource_id = $(this).val();
            if(cource_id){
                $.ajax({
                    data:{cource_id:cource_id},
                    type:"post",
                    url:"ajaxdata.php",
                    success:function(msg){
                        $('#batch').html(msg);
                    },
                    error:function(e){
                        alert("ERROR: " + e.status + " " + e.statusText);
                    }
                });
            }else{
                $("#batch").html('<option value="">Select cource first</option>');
            }
        });
    });
    
</script>    
