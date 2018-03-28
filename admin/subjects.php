<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){
        if(isset($_REQUEST['did'])){
            $subject_id= $_REQUEST['did'];
            $query=mysqli_query($conn,"delete from cims_subjects where subject_id=$subject_id");
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
        <h2>Subject</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="subval" value="subject">
            <table>
                <tr>
                    <td>select cource</td><td><select name="courceid" id="courceid">
                                                <option value="" disabled="" selected="">Select cource</option>
                                                <?php $query= mysqli_query($conn, "select * from cims_cources");

                                                    while($res=mysqli_fetch_assoc($query)){?>
                                                <option value="<?php echo $res['cource_id']; ?>"><?php echo $res['cource_name']; ?></option>
                                                <?php } ?>
                        </select></td></tr>
                <tr><td>Sub name</td><td><input type="text" name="subject_name" id="subject_name"> </td></tr>
            </table>            
            <input type="button" id="button" value="add">
        </form>
        <br>
        <div id="result">
            <table border="1">
            <tr>
                <td>cource name</td>
                <td>Subject name</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_subjects");
                while($res=mysqli_fetch_assoc($query)){
                     $cource_id=$res['cource_id'];
                    $query1=mysqli_query($conn,"select * from cims_cources where cource_id='$cource_id'");
                    $res1= mysqli_fetch_assoc($query1);    
            ?>
                <tr>
                    <td><?php echo $res1['cource_name']; ?></td>
                    <td><?php echo $res['subject_name']; ?></td>
                    <td><a href="subjects_edit.php?eid=<?php echo $res['subject_id'] ?>">Edit</a>
                        <a href="subjects.php?did=<?php echo $res['subject_id'] ?>">Delete</a></td>
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
