<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){
        if(isset($_REQUEST['actid'])){
            $teacher_id= $_REQUEST['actid'];
            $query=mysqli_query($conn,"update cims_teacher set status='Active' where teacher_id=$teacher_id");
        }
        if(isset($_REQUEST['dactid'])){
            $teacher_id= $_REQUEST['dactid'];
            $query=mysqli_query($conn,"update cims_teacher set status='Deactive' where teacher_id=$teacher_id");
        }
        if(isset($_REQUEST['did'])){
            $teacher_id= $_REQUEST['did'];
            $query=mysqli_query($conn,"delete from cims_teacher where teacher_id=$teacher_id");
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
    <center><h2><a href="dashboard.php">back</a></h2>
        <h2>Teacher</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="teacherval" value="teacher">
            <table>
                
                <tr><td>teacher name</td><td><input type="text" name="name" id="name"> </td></tr>
            </table>            
            <input type="button" id="button" value="add">
        </form>
        <br>
        <div id="result">
            <table border="1">
            <tr>
                <td>Teacher name</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_teacher");
                while($res=mysqli_fetch_assoc($query)){                      
            ?>
                <tr>
                    <td><?php echo $res['name']; ?></td>
                    <td><?php echo $res['status']; ?></td>
                    <td><a href="teacher.php?actid=<?php echo $res['teacher_id'] ?>">Active</a>
                        <a href="teacher.php?dactid=<?php echo $res['teacher_id'] ?>">Deactive</a>
                        <a href="teacher_edit.php?eid=<?php echo $res['teacher_id'] ?>">Edit</a>
                        <a href="teacher.php?did=<?php echo $res['teacher_id'] ?>">Delete</a>
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
            var data = $("#form-search").serialize();        
            if(data==''){
                alert('fill all fields');
            }else{
                $.ajax({
                    data:data,
                    type:"post",
                    url: "ajaxdata.php",                    
                    success: function(r) {//success(result,status,xhr)
                        $("#result").html(r);
                    },
                    error: function(e) {//error(xhr,status,error)
                        alert("ERROR: " + e.status + " " + e.statusText);
                    }
                });
            }
        });
    });
</script>
