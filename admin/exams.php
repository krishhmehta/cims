<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){        
        if(isset($_REQUEST['did'])){
            $exam_id= $_REQUEST['did'];
            $query=mysqli_query($conn,"delete from cims_exams where exam_id=$exam_id");
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
        <h2>Exam</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="examval" value="exam">
            <table>
                
                <tr><td>exam_name</td><td><input type="text" name="exam_name" id="exam_name"> </td></tr>
            </table>            
            <input type="button" id="button" value="add">
        </form>
        <br>
        <div id="result">
            <table border="1">
            <tr>
                <td>exam_name</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_exams");
                while($res=mysqli_fetch_assoc($query)){                      
            ?>
                <tr>
                    <td><?php echo $res['exam_name']; ?></td>                    
                    <td>
                        <a href="exams_edit.php?eid=<?php echo $res['exam_id'] ?>">Edit</a>
                        <a href="exams.php?did=<?php echo $res['exam_id'] ?>">Delete</a>
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
